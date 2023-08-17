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

class Reviews extends BaseController
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

    public function save_review($produk_id)
    {
        // Cek apakah form telah disubmit
        if ($this->request->getMethod() == 'post' && $this->request->getVar('submit_review')) {
            // Ambil data dari form
            $rating = $this->request->getVar('rating');
            $reviewText = $this->request->getVar('review');
            $paymentId = $this->request->getVar('payment_id'); // Ambil payment_id dari form

            // Ambil data user yang sedang login
            $user = $this->userModel->where('id', user_id())->first();

            if (!$user) {
                return redirect()->to('auth/login');
            }

            // Ambil user_id dari pengguna yang login
            $userId = $user->id;

            // Simpan data review ke dalam tabel reviews
            $data = [
                'rating' => $rating,
                'review' => $reviewText,
                'user_id' => $userId, // Gunakan user_id dari pengguna yang login
                'payment_id' => $paymentId,
            ];
            $this->reviewsModel->insert($data);

            // Redirect kembali ke halaman detail produk
            return redirect()->to('produk/detail/' . $produk_id);
        }
    }

}
