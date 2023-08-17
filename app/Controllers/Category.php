<?php

namespace App\Controllers;

use App\Models\ProductModel;
use App\Models\MenuModel;
use App\Models\CategoriesModel;
use Myth\Auth\Models\UserModel;

class Category extends BaseController
{
    protected $db;
    protected $builder;
    protected $productModel;
    protected $menuModel;
    protected $categoriesModel;
    protected $userModel;

    public function __construct()
    {
        $this->db = \Config\Database::connect();
        $this->builder = $this->db->table('product');
        $this->productModel = new ProductModel();
        $this->menuModel = new MenuModel();
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
            'title' => 'Category',
        ];

        // Get related products with kategori_id = 1
        $categoriesProducts = $this->getCategoriesProducts();

        // Pass the related product data to the view
        $data['categoriesProducts'] = $categoriesProducts;
        
        // Get related products with kategori_id = 2
        $categoriesProductsDC = $this->getCategoriesProductsDC();

        // Pass the related product data to the view
        $data['categoriesProductsDC'] = $categoriesProductsDC;

        // Get related products with kategori_id = 3
        $categoriesProductsNon = $this->getCategoriesProductsNon();

        // Pass the related product data to the view
        $data['categoriesProductsNon'] = $categoriesProductsNon;

        // Pass the product data to the view

        return view('category/index', $data);
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

    private function getCategoriesProducts()
    {
        // Get distinct products with kategori_id = 1
        $this->builder = $this->db->table('product');
        $this->builder->select('product.id as produkid, product.nama_produk,product.kategori_id, product.harga_produk, product.photos_filenames, users.foto, users.lokasi,reviews.rating,reviews.review,reviews.created_at');
        $this->builder->join('kategori', 'kategori.produk_id = product.id', 'left'); // Use 'left' for LEFT JOIN
        $this->builder->join('reviews', 'reviews.item_id = product.id', 'left'); // Use 'left' for LEFT JOIN
        $this->builder->join('users', 'users.id = product.user_id', 'left'); // Use 'left' for LEFT JOIN
        $this->builder->where('product.deleted_at IS NULL');
        $this->builder->where('product.kategori_id', 1); // Filter products with kategori_id = 1
        $this->builder->orderBy('product.id', 'DESC');

        $query = $this->builder->get();
        $products = $query->getResultArray();

        // Store product IDs that have been displayed
        $displayedProductIds = [];

        // Filter out duplicate products
        $filteredProducts = [];
        foreach ($products as $product) {
            $productId = $product['produkid'];
            if (!in_array($productId, $displayedProductIds)) {
                $filteredProducts[] = $product;
                $displayedProductIds[] = $productId;
            }
        }

        return $filteredProducts;
    }

    private function getCategoriesProductsDC()
    {
        // Get distinct products with kategori_id = 2
        $this->builder = $this->db->table('product');
        $this->builder->select('product.id as produkid, product.nama_produk,product.kategori_id, product.harga_produk, product.photos_filenames, users.foto, users.lokasi,reviews.review,reviews.rating,reviews.created_at');
        $this->builder->join('kategori', 'kategori.produk_id = product.id', 'left'); // Use 'left' for LEFT JOIN
        $this->builder->join('users', 'users.id = product.user_id', 'left'); // Use 'left' for LEFT JOIN
        $this->builder->join('reviews', 'reviews.item_id = product.id', 'left'); // Use 'left' for LEFT JOIN
        $this->builder->where('product.deleted_at IS NULL');
        $this->builder->where('product.kategori_id', 2); // Filter products with kategori_id = 2
        $this->builder->orderBy('product.id', 'DESC');

        $query = $this->builder->get();
        $products = $query->getResultArray();

        // Store product IDs that have been displayed
        $displayedProductIds = [];

        // Filter out duplicate products
        $filteredProducts = [];
        foreach ($products as $product) {
            $productId = $product['produkid'];
            if (!in_array($productId, $displayedProductIds)) {
                $filteredProducts[] = $product;
                $displayedProductIds[] = $productId;
            }
        }

        return $filteredProducts;
    }


    private function getCategoriesProductsNon()
    {
        // Get distinct products with kategori_id = 1
        $this->builder = $this->db->table('product');
        $this->builder->select('product.id as produkid, product.nama_produk,product.kategori_id, product.harga_produk, product.photos_filenames, users.foto, users.lokasi,reviews.created_at,reviews.review,reviews.rating');
        $this->builder->join('kategori', 'kategori.produk_id = product.id', 'left'); // Use 'left' for LEFT JOIN
        $this->builder->join('users', 'users.id = product.user_id', 'left'); // Use 'left' for LEFT JOIN
        $this->builder->join('reviews', 'reviews.item_id = product.id', 'left'); // Use 'left' for LEFT JOIN
        $this->builder->where('product.deleted_at IS NULL');
        $this->builder->where('product.kategori_id', 3); // Filter products with kategori_id = 1
        $this->builder->distinct(); // Make sure only distinct products are selected
        $this->builder->orderBy('product.id', 'DESC');

        $query = $this->builder->get();
        $products = $query->getResultArray();

        return $products;
    }

    public function errorpage()
    {
        $data = [
            'title' => 'Hmmm Sepertinya ada yang salah...',
        ];

        return view('home/error-page', $data);
    }

    // Function to get menu options based on produk_id
    protected function getMenuOptions($produk_id)
    {
        $this->builder = $this->db->table('kategori');
        $this->builder->where('produk_id', $produk_id);
        return $this->builder->get()->getResultArray();
    }

    // Function to get related products based on the given produk_id
    private function getRelatedProducts($kategoriId, $currentProductId)
    {
        // Perform a query to fetch related products with the same "kategori_id" randomly and limit to 4 rows
        $this->builder = $this->db->table('product');
        $this->builder->select('product.id as produkid, product.nama_produk, product.description, product.user_id, product.kategori_id, product.harga_produk, product.photos_filenames, product.created_at, product.updated_at, product.deleted_at,categories.nama_categories,kategori.nama_menu,kategori.deskripsi, users.username, users.email, users.nama, users.foto, users.jenis_kelamin, users.telepon, users.lokasi,reviews.created_at,reviews.review,reviews.rating');
        $this->builder->join('categories', 'categories.id = product.kategori_id', 'left'); // Use 'left' for LEFT JOIN
        $this->builder->join('kategori', 'kategori.produk_id = product.id', 'left');
        $this->builder->join('reviews', 'reviews.item_id = product.id', 'left'); // Use 'left' for LEFT JOIN
        $this->builder->join('users', 'users.id = product.user_id', 'left'); // Use 'left' for LEFT JOIN
        $this->builder->where('product.deleted_at IS NULL');
        $this->builder->where('product.id !=', $currentProductId); // Exclude the current product
        $this->builder->where('product.kategori_id', $kategoriId); // Fetch related products with the same "kategori_id"
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

}
