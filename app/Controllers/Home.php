<?php

namespace App\Controllers;

use App\Models\ProductModel;
use App\Models\MenuModel;
use App\Models\PaymentModel;
use App\Models\TransaksiModel;
use App\Models\ReservationModel;
use App\Models\ReviewsModel;
use App\Models\RepliesModel;
use App\Models\CategoriesModel;
use Myth\Auth\Models\UserModel;


class Home extends BaseController
{
    protected $db;
    protected $builder;
    protected $productModel;
    protected $menuModel;
    protected $reservationModel;
    protected $paymentModel;
    protected $transaksiModel;
    protected $reviewsModel;
    protected $repliesModel;
    protected $categoriesModel;
    protected $userModel;

    public function __construct()
    {
        $this->db = \Config\Database::connect();
        $this->builder = $this->db->table('product');
        $this->productModel = new ProductModel();
        $this->menuModel = new MenuModel();
        $this->reservationModel = new ReservationModel();
        $this->transaksiModel = new TransaksiModel();
        $this->paymentModel = new PaymentModel();
        $this->reviewsModel = new ReviewsModel();
        $this->repliesModel = new RepliesModel();
        $this->categoriesModel = new CategoriesModel();
        $this->userModel = new UserModel();
    }

    /* public function index()
    {
        $data = [
            'title' => 'Wedding Organizer',
        ];

        // Load the KategoriModel
        $kategoriModel = new KategoriModel();

        // Fetch all categories from the database
        $categories = $kategoriModel->findAll();

        // Pass the category data to the view
        $data['categories'] = $categories;

        // Perform the LEFT JOIN with product and kategori tables
        $this->builder = $this->db->table('product');
        $this->builder->select('product.id as produkid, product.nama_produk, product.description, product.user_id, product.kategori_id, product.harga_produk, product.photos_filenames, product.created_at, product.updated_at, product.deleted_at, users.username, users.email, users.nama, users.foto, users.jenis_kelamin, users.telepon, users.lokasi, kategori.id as kategori_id, kategori.nama_menu, kategori.deskripsi as kategori_deskripsi, kategori.isi');
        $this->builder->join('kategori', 'kategori.produk_id = product.id', 'left'); // Use 'left' for LEFT JOIN
        $this->builder->join('users', 'users.id = product.user_id', 'left'); // Use 'left' for LEFT JOIN

        // Get the product data with category information
        $products = $this->builder->get()->getResultArray();

        // Pass the product data to the view
        $data['produk'] = $products;

        return view('home/index', $data);
    } */

    public function index()
    {
        $data = [
            'title' => 'Wedding Organizer',
        ];

        // Perform the LEFT JOIN with product and kategori tables
        $this->builder = $this->db->table('product');
        $this->builder->select('product.id as produkid, product.nama_produk, product.description, product.user_id, product.kategori_id, product.harga_produk, product.photos_filenames, product.created_at, product.updated_at, product.deleted_at, users.username, users.email, users.nama, users.foto, users.jenis_kelamin, users.telepon, users.lokasi');
        /* $this->builder->join('kategori', 'kategori.produk_id = product.id', 'left'); */ // Use 'left' for LEFT JOIN
        $this->builder->join('users', 'users.id = product.user_id', 'left'); // Use 'left' for LEFT JOIN

        // Add condition to check if the data is not soft deleted
        $this->builder->where('product.deleted_at IS NULL');

        // Get the product data with category information and user information
        $products = $this->builder->get()->getResultArray();

        // Calculate the average rating and total reviews for each product
        foreach ($products as &$product) {
            $product['averageRating'] = 0;
            $product['totalReviews'] = 0;

            $reviews = $this->getReview($product['produkid']);

            $totalRating = 0;
            $totalReviews = 0;

            foreach ($reviews as $review) {
                if (isset($review['rating_count'])) {
                    $totalRating += $review['rating'] * $review['rating_count'];
                    $totalReviews += $review['rating_count'];
                }
            }

            if ($totalReviews > 0) {
                $averageRating = $totalRating / $totalReviews;
                $product['averageRating'] = number_format($averageRating, 1);
                $product['totalReviews'] = $totalReviews;
            }
        }

        // Pass the product data to the view
        $data['produk'] = $products;

        return view('home/index', $data);
    }

    public function search()
    {
        $keyword = urldecode($this->request->getVar('q')); // Decode spasi menjadi +

        $title = 'Search Results';
        if (!empty(trim($keyword))) {
            $title .= ' ' . $keyword;
        }

        $data = [
            'title' => $title,
            'keyword' => $keyword,
        ];

        $builder = $this->db->table('product');
        $builder->select('product.id as produkid, product.nama_produk, product.id_produk, product.description, product.user_id, product.kategori_id, product.harga_produk, product.photos_filenames, product.created_at, product.updated_at, product.deleted_at, users.username, users.email, users.nama, users.foto, users.jenis_kelamin, users.telepon, users.lokasi, AVG(reviews.rating) as avg_rating, COUNT(reviews.rating) as total_reviews, categories.nama_categories');
        $builder->join('users', 'users.id = product.user_id', 'left');
        $builder->join('categories', 'categories.id = product.kategori_id', 'left');
        $builder->join('reviews', 'product.id = reviews.item_id', 'left');

        $builder->where('product.deleted_at IS NULL');
        $builder->groupStart();
        $builder->like('product.nama_produk', $keyword);
        $builder->orLike('product.description', $keyword);
        $builder->orLike('users.nama', $keyword);
        $builder->orLike('users.username', $keyword);
        $builder->orLike('product.harga_produk', $keyword);
        $builder->orLike('categories.nama_categories', $keyword);
        $builder->groupEnd();

        // Lakukan pencarian berdasarkan rating
        $ratingKeyword = strtolower($keyword);
        if (strpos($ratingKeyword, 'bintang') !== false && preg_match('/[0-9]+/', $ratingKeyword, $matches)) {
            $ratingValue = (int) $matches[0];
            if ($ratingValue >= 1 && $ratingValue <= 5) {
                $builder->having('avg_rating', $ratingValue);
            }
        }

        $minPrice = $this->request->getVar('min_price');
        $maxPrice = $this->request->getVar('max_price');

        // Periksa apakah parameter min_price dan max_price ada di URL
        if ($minPrice !== null && $maxPrice !== null) {
            $builder->where('product.harga_produk >=', (int) $minPrice);
            $builder->where('product.harga_produk <=', (int) $maxPrice);
        } elseif ($minPrice !== null) {
            $builder->where('product.harga_produk >=', (int) $minPrice);
        } elseif ($maxPrice !== null) {
            $builder->where('product.harga_produk <=', (int) $maxPrice);
        }

        // Periksa apakah parameter category ada di URL
        $selectedCategories = $this->request->getVar('category');
        if (!empty($selectedCategories)) {
            $selectedCategoriesArray = explode(',', $selectedCategories);

            $builder->groupStart();
            foreach ($selectedCategoriesArray as $category) {
                $builder->orLike('categories.nama_categories', $category);
            }
            $builder->groupEnd();

            $data['selectedCategoriesArray'] = $selectedCategoriesArray;
        }

        $builder->groupBy('product.id');
        $builder->orderBy('avg_rating', 'DESC');

        $products = $builder->get()->getResultArray();

        $categories = []; // Array untuk menyimpan informasi kategori

        foreach ($products as $product) {
            $kategoriId = $product['kategori_id'];

            // Inisialisasi kategori jika belum ada
            if (!isset($categories[$kategoriId])) {
                $categories[$kategoriId] = [
                    'nama' => $product['nama_categories'],
                    'jumlah_produk' => 0, // Inisialisasi jumlah produk
                ];
            }

            // Tambahkan jumlah produk untuk kategori ini
            $categories[$kategoriId]['jumlah_produk']++;
        }

        // Pass data kategori ke view
        $data['categories'] = $categories;

        // Filter out the products that have been soft deleted
        $filteredProducts = [];
        foreach ($products as $product) {
            if (!$product['deleted_at']) {
                $filteredProducts[] = $product;
            }
        }

        $data['filteredProducts'] = $filteredProducts;

        // Calculate total results for pagination
        $totalResults = count($filteredProducts);

        $perPage = 12; // Number of results per page
        $totalPages = ceil($totalResults / $perPage);

        // Get the current page number from the URL query or AJAX request
        $page = $this->request->getVar('page') ?? 1;

        // Calculate the offset for the current page
        $offset = ($page - 1) * $perPage;

        // Slice the filtered products array for the current page
        $currentPageProducts = array_slice($filteredProducts, $offset, $perPage);

        $data['currentPage'] = $page;
        $data['totalPages'] = $totalPages;
        $data['currentPageProducts'] = $currentPageProducts;

        // Return JSON response for AJAX request
        if ($this->request->isAJAX()) {
            return $this->response->setJSON($data);
        }

        // Jika kata kunci kosong atau hanya berisi spasi, alihkan ke halaman "tanpa hasil"
        if (empty(trim($keyword))) {
            $data['no_results'] = true; // Tandai bahwa tidak ada hasil pencarian
            if ($this->request->isAJAX()) {
                return $this->response->setJSON($data); // Kembalikan respons JSON jika ini adalah permintaan AJAX
            } else {
                return view('home/no_results', $data); // Tampilkan view khusus jika tidak ada hasil pencarian
            }
        }

        if (empty($filteredProducts)) {
            $data['no_results'] = true;
            if ($this->request->isAJAX()) {
                return $this->response->setJSON($data); // Kembalikan respons JSON jika ini adalah permintaan AJAX
            } else {
                return view('home/no_results', $data);
            }
        } else {
            $data['produk'] = $filteredProducts;
        }

        if (empty($filteredProducts)) {
            $data['no_results'] = true;
            if ($this->request->isAJAX()) {
                return $this->response->setJSON($data); // Kembalikan respons JSON jika ini adalah permintaan AJAX
            } else {
                return view('home/no_results', $data);
            }
        } else {
            $data['produk'] = $filteredProducts;
            return view('home/search', $data);
        }
    }

    public function errorpage()
    {
        $data = [
            'title' => 'Hmmm Sepertinya ada yang salah...',
        ];

        return view('home/error-page', $data);
    }

    // Detail
    public function detail($id = 0)
    {
        $data = [
            'title' => 'Wedding Organizer',
        ];

        // Perform the LEFT JOIN with product, kategori, and users tables
        $this->builder = $this->db->table('product');
        $this->builder->select('product.id as produkid, product.nama_produk, product.description, product.user_id, product.kategori_id, product.harga_produk, product.photos_filenames, product.created_at, product.updated_at, product.deleted_at, kategori.nama_menu, kategori.deskripsi as kategori_deskripsi, kategori.isi, kategori.produk_id, categories.nama_categories, users.username, users.email, users.nama, users.foto, users.jenis_kelamin, users.telepon, users.lokasi');
        $this->builder->join('kategori', 'kategori.produk_id = product.id', 'left'); // Use 'left' for LEFT JOIN
        $this->builder->join('categories', 'categories.id = product.kategori_id', 'left'); // Use 'left' for LEFT JOIN
        $this->builder->join('users', 'users.id = product.user_id', 'left'); // Use 'left' for LEFT JOIN

        // Fetch the product data with user names for the given $id
        $this->builder->where('product.id', $id);
        $this->builder->where('product.deleted_at IS NULL'); // Add this line to filter out soft deleted products
        $product = $this->builder->get()->getRowArray();

        // Check if the product exists
        if (!$product) {
            // Redirect to some error page or show an error message
            return redirect()->to('home/error-page');
        }

        // Pass the product data to the view
        $data['product'] = $product;

        // Fetch the menu options from the kategori table based on the produk_id of the main product
        $menuOptions = $this->getMenuOptions($product['produk_id']);

        // Pass the menu options to the view
        $data['menuOptions'] = $menuOptions;

        // Fetch related products only if the product data is valid
        if (!empty($product['kategori_id'])) {
            // Convert kategori_id to an integer
            $kategori_id = (int)$product['kategori_id'];

            // Fetch related products with the same kategori_id (excluding the current product)
            $relatedProducts = $this->getRelatedProducts($kategori_id, $id);

            // Pass the related product data to the view
            $data['relatedProducts'] = $relatedProducts;
        } else {
            // If the product data is invalid or missing, set an empty array for related products
            $data['relatedProducts'] = [];
        }

        // Fetch the payment data for the given $id
        $payment = $this->getPaymentData($id);

        // Pass the payment data to the view
        $data['payment'] = $payment;

        // Fetch the reviews data for the given product $id
        $reviews = $this->getReview($id);

        // Pass the review data to the view
        $data['reviews'] = $reviews;

        // Check if the user is logged in and if payment data is available
        $user_id = user_id();
        $allow_review = true;

        if (logged_in() && $payment) {
            // Check if the user has made a payment for this transaction
            $userTransaction = $this->db->table('payment')
            ->where('user_id', $user_id)
                ->where('id', $payment['transaksi_id']) // Use 'transaksi_id' from payment data
                ->get()
                ->getRowArray();

            if ($userTransaction) {
                // Check if the user has already reviewed this item
                $has_reviewed = false;
                foreach ($reviews as $review) {
                    if ($review['transaksi_id'] == $payment['transaksi_id']) {
                        $has_reviewed = true;
                        break;
                    }
                }

                // If the user has not reviewed, allow them to review
                $allow_review = !$has_reviewed;
            }
        }

        // Pass the allow_review data to the view
        $data['allow_review'] = $allow_review;


        // Calculate the total rating and total number of reviews
        $totalRating = 0;
        $totalReviews = 0;

        foreach ($reviews as $review) {
            if (isset($review['rating_count'])) {
                $totalRating += $review['rating'] * $review['rating_count'];
                $totalReviews += $review['rating_count'];
            }
        }

        // Calculate the average rating
        $averageRating = $totalReviews > 0 ? $totalRating / $totalReviews : 0;
        $data['averageRating'] = number_format($averageRating, 1);

        // Pass the total number of reviews to the view
        $data['totalReviews'] = $totalReviews;

        //Mengambil data relies
        $replies = $this->getRepliesByReview($id);
        // Pass the review data to the view
        $data['replies'] = $replies;

        return view('home/detail', $data);
    }

    // Function to get payment data for the given $id
    // Function to get payment data for the given user_id
    // Function to get payment data for the logged-in user
    protected function getPaymentData($paymentId)
    {
        $user = $this->userModel->where('id', user_id())->first();

        if (!$user) {
            return null; // Return null or false indicating that user is not logged in
        }

        $userId = $user->id;

        $this->builder = $this->db->table('payment');
        $this->builder->select('payment.id as paymentid,payment.id_payment,payment.payment_date,payment.status,payment.total_payment,payment.user_id,payment.transaksi_id,payment.reservation_id,payment.payment_updated,payment.payment_receipt,transaksi.user_id as transaksi_user_id ,transaksi.id_transaksi,transaksi.menu_id,transaksi.produk_id,transaksi.total_harga,transaksi.tgl_transaksi, product.nama_produk, product.description, product.user_id as produk_user, product.kategori_id, product.harga_produk, product.photos_filenames, product.created_at, product.updated_at, product.deleted_at, kategori.nama_menu, kategori.deskripsi as kategori_deskripsi, kategori.isi,kategori.produk_id,categories.nama_categories, users.username, users.email, users.nama, users.foto, users.jenis_kelamin, users.telepon, users.lokasi');
        $this->builder->join('transaksi', 'transaksi.id = payment.transaksi_id', 'left'); // Use 'left' for LEFT JOIN
        $this->builder->join('reservation', 'reservation.id = payment.reservation_id', 'left'); // Use 'left' for LEFT JOIN
        $this->builder->join('product', 'product.id = transaksi.produk_id', 'left'); // Use 'left' for LEFT JOIN
        $this->builder->join('users', 'users.id = payment.user_id', 'left'); // Use 'left' for LEFT JOIN
        $this->builder->join('kategori', 'kategori.produk_id = product.id', 'left'); // Use 'left' for LEFT JOIN
        $this->builder->join('categories', 'categories.id = product.kategori_id', 'left'); // Use 'left' for LEFT JOIN

        // Fetch the payment data for the logged-in user and specific payment ID
        $this->builder->where('payment.user_id', $userId); // Filter by user ID
        $this->builder->where('payment.id', $paymentId); // Filter by payment ID
        $this->builder->orderBy('payment.payment_date', 'DESC'); // Order by payment date in descending order
        $payment = $this->builder->get()->getRowArray();

        return $payment;
    }

    // Function to get reviews by review_id
    // Function to get reviews by review_id
    /* protected function getReview($id)
    {
        $user_id = user_id(); // Get the current logged-in user's ID

        $this->builder = $this->db->table('reviews');
        $this->builder->select('reviews.id as reviewsid, reviews.user_id, reviews.payment_id, reviews.item_id, reviews.review, reviews.rating, reviews.created_at,payment.transaksi_id,payment.id_payment, users.username, users.nama, users.foto');
        $this->builder->join('users', 'users.id = reviews.user_id', 'left'); // LEFT JOIN with users table
        $this->builder->join('payment', 'payment.id = reviews.payment_id', 'left'); // LEFT JOIN with payment table
        $this->builder->join('transaksi', 'transaksi.id = payment.transaksi_id', 'left'); // LEFT JOIN with payment table
        $this->builder->join('product', 'product.id = reviews.item_id', 'left'); // LEFT JOIN with product table
        $this->builder->where('reviews.deleted_at IS NULL'); // Filter out soft deleted reviews

        // Filter reviews by the specific product ID
        $this->builder->where('reviews.item_id', $id);

        $reviews = $this->builder->get()->getResultArray();

        // Calculate the counts for each rating
        $ratingCounts = [0, 0, 0, 0, 0];
        foreach ($reviews as $review) {
            $rating = (int)$review['rating'];
            if ($rating >= 1 && $rating <= 5) {
                $ratingCounts[$rating - 1]++;
            }
        }

        // Calculate the total number of reviews
        $totalReviews = array_sum($ratingCounts);

        // Add the rating counts and review status to the result array
        $resultReviews = [];
        foreach ($reviews as $review) {
            $rating = (int)$review['rating'];
            if ($rating >= 1 && $rating <= 5) {
                $review['rating_count'] = $ratingCounts[$rating - 1];
                // Calculate the percentage of reviews with this rating
                $review['rating_percentage'] = ($totalReviews > 0) ? ($review['rating_count'] / $totalReviews) * 100 : 0;
            } else {
                $review['rating_count'] = 0;
                $review['rating_percentage'] = 0;
            }

            // Check if the user has already reviewed this item
            $item_id = $review['item_id'];
            $review['has_reviewed'] = false; // Initialize to false for users who are not logged in
            if ($user_id) {
                $reviewedProductIDs = [];
                foreach ($reviews as $review) {
                    $reviewedProductIDs[$review['item_id']] = true;
                }
                $review['has_reviewed'] = isset($reviewedProductIDs[$item_id]);

                // Check if the user has made a payment for this item
                $userPayment = $this->db->table('payment')->where('user_id', $user_id)
                ->where('item_id', $item_id)->get()->getRowArray();

                // If the user has made a payment and hasn't reviewed, allow them to review
                if ($userPayment && !$review['has_reviewed']) {
                    $review['allow_review'] = true;
                } else {
                    $review['allow_review'] = false;
                }
            }

            $resultReviews[] = $review;
        }

        return $resultReviews;
    } */

    protected function getReview($id)
    {
        $user_id = user_id(); // Get the current logged-in user's ID

        $this->builder = $this->db->table('reviews');
        $this->builder->select('reviews.id as reviewsid, reviews.user_id, reviews.payment_id, reviews.item_id, reviews.review, reviews.rating, reviews.created_at, payment.transaksi_id, users.username, users.nama, users.foto');
        $this->builder->join('users', 'users.id = reviews.user_id', 'left');
        $this->builder->join('payment', 'payment.id = reviews.payment_id', 'left');
        $this->builder->join('transaksi', 'transaksi.id = payment.transaksi_id', 'left'); // LEFT JOIN with transaksi table
        $this->builder->join('product', 'product.id = reviews.item_id', 'left');
        $this->builder->where('reviews.deleted_at IS NULL');
        $this->builder->where('reviews.item_id', $id);

        $reviews = $this->builder->get()->getResultArray();

        $ratingCounts = [0, 0, 0, 0, 0];
        foreach ($reviews as $review) {
            $rating = (int)$review['rating'];
            if ($rating >= 1 && $rating <= 5) {
                $ratingCounts[$rating - 1]++;
            }
        }

        $totalReviews = array_sum($ratingCounts);

        $resultReviews = [];
        foreach ($reviews as $review) {
            $rating = (int)$review['rating'];
            if ($rating >= 1 && $rating <= 5) {
                $review['rating_count'] = $ratingCounts[$rating - 1];
                $review['rating_percentage'] = ($totalReviews > 0) ? ($review['rating_count'] / $totalReviews) * 100 : 0;
            } else {
                $review['rating_count'] = 0;
                $review['rating_percentage'] = 0;
            }

            // Check if the user has already reviewed this item
            $transaksi_id = $review['transaksi_id'];
            $review['has_reviewed'] = false; // Initialize to false for users who are not logged in
            if ($user_id) {
                // Check if the user has reviewed this transaction
                $reviewedTransactions = [];
                foreach ($reviews as $r) {
                    $reviewedTransactions[$r['transaksi_id']] = true;
                }
                $review['has_reviewed'] = isset($reviewedTransactions[$transaksi_id]);

                // Check if the user has made a payment for this transaction
                $userTransaction = $this->db->table('payment')
                    ->where('user_id', $user_id)
                    ->where('id', $transaksi_id)
                    ->get()
                    ->getRowArray();

                // If the user has made a payment and hasn't reviewed, allow them to review
                if ($userTransaction && !$review['has_reviewed']) {
                    $review['allow_review'] = true;
                } else {
                    $review['allow_review'] = false;
                }
            }
            
            // Mengambil data replies berdasarkan review_id
            $review['replies'] = $this->getRepliesByReview($review['reviewsid']);
            $resultReviews[] = $review;
        }

        return $resultReviews;
    }

    protected function getRepliesByReview($id)
    {
        $this->builder = $this->db->table('replies');
        $this->builder->select('replies.id as repliesid, replies.user_id, replies.review_id, replies.reply, replies.created_at, users.username, users.nama, users.foto');
        $this->builder->join('users', 'users.id = replies.user_id', 'left'); // LEFT JOIN with users table
        $this->builder->where('replies.review_id', $id);
        $this->builder->where('replies.deleted_at IS NULL'); // Filter out soft deleted replies
        $replies = $this->builder->get()->getResultArray();
        
        
        return $replies;
    }

    /* public function save($review_id)
    {
        // Pastikan pengguna sudah login

        // Tangkap data dari form atau request, seperti user_id, review_id, dan isi balasan
        $user_id = user_id();
        $review_id = $this->request->getPost('review_id');
        $reply = $this->request->getPost('reply');

        // Validasi data jika diperlukan

        // Siapkan data untuk disimpan ke database
        $data = [
            'user_id' => $user_id,
            'review_id' => $review_id, // Ini adalah review yang di-reply
            'reply' => $reply,
            'created_at' => date('Y-m-d H:i:s'),
        ];

        // Simpan data ke database
        $this->db->table('replies')->insert($data);

        // Siapkan respons JSON
        $response = [
            'success' => true,
            'message' => 'Reply successfully submitted.',
            'reply' => [
                'nama' => user()->nama,
                'created_at' => date('l, d F Y', strtotime($data['created_at'])), // Ubah format tanggal di sini
                'reply' => $reply,
                'foto' => user()->foto === 'default.png' ? base_url('images/default.png') : base_url('uploads/' . user()->foto)
            ]
        ];

        // Kirim respons dalam format JSON
        return $this->response->setJSON($response);
    } */

    /* public function save($review_id)
    {
        // Pastikan pengguna sudah login
        if (!logged_in()) {
            return $this->response->setJSON(['success' => false, 'message' => 'Unauthorized']);
        }

        // Memeriksa apakah ada POST data yang diterima
        if ($this->request->getPost()) {
            // Tangkap data dari form atau request, seperti user_id, review_id, dan isi balasan
            $user_id = user_id();
            $reply = $this->request->getPost('reply');

            // Siapkan data untuk disimpan ke database
            $data = [
                'user_id' => $user_id,
                'review_id' => $review_id,
                'reply' => $reply,
                'created_at' => date('Y-m-d H:i:s'),
            ];

            // Simpan data ke database
            $this->db->table('replies')->insert($data);

            // Siapkan respons JSON
            $response = [
                'success' => true,
                'message' => 'Reply successfully submitted.',
                'reply' => [
                    'nama' => user()->nama,
                    'created_at' => date('l, d F Y', strtotime($data['created_at'])),
                    'reply' => $reply,
                    'foto' => user()->foto === 'default.png' ? base_url('images/default.png') : base_url('uploads/' . user()->foto)
                ]
            ];

            // Kirim respons dalam format JSON
            return $this->response->setJSON($response);
        } else {
            return $this->response->setJSON(['success' => false, 'message' => 'Invalid Request']);
        }
    } */

    public function save($review_id)
    {
        // Pastikan pengguna sudah login
        
        if (!logged_in()) {
            return $this->response->setJSON(['success' => false, 'message' => 'Unauthorized']);
        }

        // Memeriksa apakah ada POST data yang diterima
        if ($this->request->getPost()) {
            // Tangkap data dari form atau request, seperti user_id, review_id, dan isi balasan
            $user_id = user_id();
            $reply = $this->request->getPost('reply');

            // Siapkan data untuk disimpan ke database
            $data = [
                'user_id' => $user_id,
                'review_id' => $review_id,
                'reply' => $reply,
                'created_at' => date('Y-m-d H:i:s'),
            ];

            try {
                // Simpan data ke database
                $this->db->table('replies')->insert($data);

                // Siapkan respons JSON
                $response = [
                    'success' => true,
                    'message' => 'Reply successfully submitted.',
                    'reply' => [
                        'nama' => user()->nama,
                        'created_at' => date('l, d F Y', strtotime($data['created_at'])),
                        'reply' => $reply,
                        'foto' => user()->foto === 'default.png' ? base_url('images/default.png') : base_url('uploads/' . user()->foto)
                    ]
                ];

                // Kirim respons dalam format JSON
                return $this->response->setJSON($response);
            } catch (\Exception $e) {
                // Jika terjadi kesalahan, kirim respons JSON dengan status error
                return $this->response->setJSON(['success' => false, 'message' => 'Error while saving reply']);
            }
        } else {
            return $this->response->setJSON(['success' => false, 'message' => 'Invalid Request']);
        }
    }


    public function save_review($paymentId)
    {
        // Check if the user is logged in
        if (!logged_in()) {
            return redirect()->to('home'); // Redirect to home or login page
        }

        // Get the logged-in user's ID
        $userId = user_id();

        // Check if the payment ID is valid and belongs to the logged-in user
        $payment = $this->getPaymentData($paymentId);
        if (!$payment || $payment['user_id'] !== $userId) {
            return redirect()->to('home'); // Redirect to home or error page
        }

        // Get the review data from the form
        $rating = $this->request->getPost('rating');
        $review = $this->request->getPost('review');
        $item_id = $this->request->getPost('item_id'); // Assuming you have an input for item_id

        // Validation: Check if all required fields are provided
        if (empty($rating) || empty($review) || empty($item_id)) {
            return redirect()->back()->withInput()->with('error', 'Please provide all required information.');
        }

        // Validation: Check if the rating is valid (you can add more validation here)
        if (!in_array($rating, [1, 2, 3, 4, 5])) {
            return redirect()->back()->withInput()->with('error', 'Invalid rating value.');
        }

        // Save the review to the database using the ReviewsModel
        $this->reviewsModel->insert([
            'user_id' => $userId,
            'payment_id' => $paymentId,
            'item_id' => $item_id,
            'review' => $review,
            'rating' => $rating,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        // Redirect back to the product detail page with a success message
        return redirect()->back()->with('success', 'Review submitted successfully.');
    }

    // Function to get menu options based on produk_id
    protected function getMenuOptions($produk_id)
    {
        $this->builder = $this->db->table('kategori');
        $this->builder->where('produk_id', $produk_id);
        $this->builder->where('deleted_at');
        return $this->builder->get()->getResultArray();
    }

    private function getRelatedProducts($kategoriId, $currentProductId)
    {
        // Perform a query to fetch related products with the same "kategori_id" randomly and limit to 4 rows
        $this->builder = $this->db->table('product');
        $this->builder->select('product.id as produkid, product.nama_produk, product.description, product.user_id, product.kategori_id, product.harga_produk, product.photos_filenames, product.created_at, product.updated_at, product.deleted_at,categories.nama_categories,kategori.nama_menu,kategori.deskripsi, users.username, users.email, users.nama, users.foto, users.jenis_kelamin, users.telepon, users.lokasi,reviews.review,reviews.rating,reviews.created_at');
        $this->builder->join('categories', 'categories.id = product.kategori_id', 'left'); // Use 'left' for LEFT JOIN
        $this->builder->join('kategori', 'kategori.produk_id = product.id', 'left');
        $this->builder->join('reviews', 'reviews.item_id = product.id', 'left');
        $this->builder->join('users', 'users.id = product.user_id', 'left'); // Use 'left' for LEFT JOIN
        $this->builder->where('product.id !=', $currentProductId); // Exclude the current product
        $this->builder->where('product.kategori_id', $kategoriId); // Fetch related products with the same "kategori_id"
        $this->builder->where('product.deleted_at IS NULL'); // Exclude soft deleted products
        $this->builder->orderBy('RAND()'); // Randomize the order

        // Limit the result to 4 rows
        $this->builder->limit(4);

        // Fetch related products and return the result as an array
        $relatedProducts = $this->builder->get()->getResultArray();
        return $relatedProducts;
    }


    public function custom($id = 0)
    {
        $data = [
            'title' => 'Wedding Organizer',
        ];

        // Load the KategoriModel
        $menuModel = new MenuModel();

        // Fetch all categories from the database
        $categories = $menuModel->findAll();

        // Pass the category data to the view
        $data['categories'] = $categories;

        // Perform the LEFT JOIN with users and kategori tables
        $this->builder = $this->db->table('product');
        $this->builder->select('product.id as produkid, product.id_produk, product.nama_produk, product.description, product.user_id, product.kategori_id, product.harga_produk, product.photos_filenames, product.created_at, product.updated_at, product.deleted_at, users.username, users.email, users.nama, users.foto, users.jenis_kelamin, users.telepon, users.lokasi, kategori.nama_menu, kategori.deskripsi, kategori.isi');
        $this->builder->join('users', 'users.id = product.user_id', 'left'); // Use 'left' for LEFT JOIN
        $this->builder->join('kategori', 'kategori.id = product.kategori_id');

        // Fetch the product data with user names for the given $id
        $this->builder->where('product.id', $id);
        $product = $this->builder->get()->getRowArray();

        // Check if the product exists
        if (!$product) {
            // Redirect to some error page or show an error message
            return redirect()->to('home/error-page');
        }

        // Pass the product data to the view
        $data['product'] = $product;

        // Fetch related products only if the product data is valid
        if (!empty($product['kategori_id']) && !empty($product['id_produk'])) {
            // Convert kategori_id to an integer
            $kategori_id = (int)$product['kategori_id'];

            // Fetch related products with the same category (excluding the current product)
            $relatedProducts = $this->getRelatedProducts($kategori_id, $product['id_produk']);

            // Pass the related product data to the view
            $data['relatedProducts'] = $relatedProducts;
        } else {
            // If the product data is invalid or missing, set an empty array for related products
            $data['relatedProducts'] = [];
        }

        return view('home/custom', $data);
    }

    // Method to fetch related products with the same category
    /* private function getRelatedProducts($kategori_id, $current_product_id)
    {
        // Load the ProductModel (adjust the model name as per your setup)
        $productModel = new ProductModel();

        // Perform the LEFT JOIN with users and kategori tables
        $productModel->select('product.id as produkid, product.id_produk, product.nama_produk, product.harga_produk, product.photos_filenames, kategori.nama_menu,');
        $productModel->join('kategori', 'kategori.id = product.kategori_id');

        // Fetch related products (products with the same category except the current product)
        $productModel->where('product.kategori_id', $kategori_id);
        $productModel->where('product.id_produk !=', $current_product_id);

        // Limit the number of related products (adjust the number as needed)
        $productModel->limit(4);

        // Get the related product data
        $relatedProducts = $productModel->findAll();

        return $relatedProducts;
    } */
}
