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


class About extends BaseController
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
            'title' => 'About Tenda Hj Yus',
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


        return view('about/index', $data);
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
}