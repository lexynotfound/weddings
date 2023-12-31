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


class Search extends BaseController
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

        // Pass the product data to the view
        $data['produk'] = $products;

        return view('search/index', $data);
    }

    public function search()
    {
        $keyword = $this->request->getVar('q'); // Ambil keyword pencarian dari form

        $data = [
            'title' => 'Search Results',
            'keyword' => $keyword,
        ];

        // Lakukan query pencarian ke tabel produk dan gabungkan dengan tabel pengguna
        $this->builder = $this->db->table('product');
        $this->builder->select('product.id as produkid, product.nama_produk, product.description, product.user_id, product.kategori_id, product.harga_produk, product.photos_filenames, product.created_at, product.updated_at, product.deleted_at, users.username, users.email, users.nama, users.foto, users.jenis_kelamin, users.telepon, users.lokasi');
        $this->builder->join('users', 'users.id = product.user_id', 'left');
        $this->builder->like('product.nama_produk', $keyword); // Lakukan pencarian berdasarkan nama produk

        // Add condition to check if the data is not soft deleted
        $this->builder->where('product.deleted_at IS NULL');

        // Get the search results
        $products = $this->builder->get()->getResultArray();

        if (empty($products)) {
            $data['no_results'] = true; // Tandai bahwa tidak ada hasil pencarian
        } else {
            $data['produk'] = $products;
        }

        return view('search', $data);
    }



    public function errorpage()
    {
        $data = [
            'title' => 'Hmmm Sepertinya ada yang salah...',
        ];

        return view('home/error-page', $data);
    }

    /* // Detail
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
        $allow_review = false;

        if (logged_in() && $payment) {
            // Check if the user has made a payment for this transaction
            $userTransaction = $this->db->table('payment')
                ->where('user_id', $user_id)
                ->where('id', $payment['transaksi_id']) // Use 'transaksi_id' from payment data
                ->get()
                ->getRowArray();

            // Check if the user has already reviewed this item
            $has_reviewed = false;
            foreach ($reviews as $review) {
                if ($review['transaksi_id'] == $payment['transaksi_id']) {
                    $has_reviewed = true;
                    break;
                }
            }

            // If the user has made a payment and hasn't reviewed, allow them to review
            $allow_review = ($userTransaction && !$has_reviewed);
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

        return view('home/detail', $data);
    } */

    // Function to get payment data for the given $id
    // Function to get payment data for the given user_id
    // Function to get payment data for the logged-in user
    protected function getPaymentData()
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

        // Fetch the payment data for the logged-in user
        $this->builder->where('payment.user_id', $userId); // Filter by user ID
        $this->builder->orderBy('payment.payment_date', 'DESC'); // Order by payment date in descending order
        $payment = $this->builder->get()->getRowArray();

        return $payment;
    }

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

            $resultReviews[] = $review;
        }

        return $resultReviews;
    }

    protected function getRepliesByReview($review_id)
    {
        $this->builder = $this->db->table('replies');
        $this->builder->select('replies.id, replies.user_id, replies.review_id, replies.reply, replies.created_at, users.username, users.nama, users.foto');
        $this->builder->join('users', 'users.id = replies.user_id', 'left'); // LEFT JOIN with users table
        $this->builder->where('replies.review_id', $review_id);
        $this->builder->where('replies.deleted_at IS NULL'); // Filter out soft deleted replies
        $replies = $this->builder->get()->getResultArray();

        return $replies;
    }

    public function save_review($payment_id)
    {
        // Ambil data dari form
        $rating = $this->request->getVar('rating');
        $reviewText = $this->request->getVar('review');
        $PaymentsID = $this->request->getVar('payment_id');

        // Ambil data user yang sedang login
        $user = $this->userModel->where('id', user_id())->first();

        if (!$user) {
            return redirect()->to('auth/login');
        }

        // Ambil user_id dari pengguna yang login
        $userId = $user->id;

        // Ambil data pembayaran terbaru berdasarkan payment_id
        $paymentModel = new PaymentModel();
        $latestPayment = $paymentModel->where('id', $payment_id)
            ->orderBy('payment_date', 'DESC')
            ->first();

        if (!$latestPayment) {
            return redirect()->to('home/error-page');
        }

        // Ambil data produk terbaru berdasarkan produk_id pada pembayaran terbaru
        $productModel = new ProductModel();
        $latestProduct = $productModel->find($latestPayment['id']);

        if (!$latestProduct || !is_null($latestProduct['deleted_at'])) {
            return redirect()->to('home/error-page');
        }

        // Simpan data ulasan ke dalam tabel reviews
        $reviewsModel = new ReviewsModel();
        $data = [
            'rating' => $rating,
            'review' => $reviewText,
            'user_id' => $userId,
            'payment_id' => $PaymentsID,
            'item_id' => $latestPayment['id'], // Use the latest product ID from the payment
            'created_at' => date('Y-m-d H:i:s'),
        ];

        // Coba lakukan operasi penyimpanan data
        try {
            $reviewsModel->insert($data);

            // Tandai pembayaran sebagai telah direview
            $paymentModel->update($payment_id, ['reviewed_at' => date('Y-m-d H:i:s')]);

            // Redirect kembali ke halaman detail produk
            return redirect()->to('home/detail/' . $latestProduct['id']);
        } catch (\Exception $e) {
            // Tampilkan pesan error atau lakukan penanganan error sesuai kebutuhan
            echo 'Error while saving review: ' . $e->getMessage();
        }
    }
}
