<?php

namespace App\Controllers;

use App\Models\ProductModel;
use App\Models\MenuModel;
use App\Models\PaymentModel;
use App\Models\CategoriesModel;
use App\Models\ReservationModel;
use App\Models\TransaksiModel;
use Myth\Auth\Models\UserModel;

class User extends BaseController
{
    protected $db;
    protected $builder;
    protected $productModel;
    protected $menuModel;
    protected $categoriesModel;
    protected $reservationModel;
    protected $transaksiModel;
    protected $userModel;
    protected $paymentModel;
    protected $traModel;

    public function __construct()
    {
        $this->db = \Config\Database::connect();
        $this->builder = $this->db->table('product');
        $this->productModel = new ProductModel();
        $this->paymentModel = new PaymentModel();
        $this->menuModel = new MenuModel();
        $this->reservationModel = new ReservationModel();
        $this->transaksiModel = new TransaksiModel();
        $this->categoriesModel = new CategoriesModel();
        $this->userModel = new UserModel();
    }

    public function transactionHistory()
    {
        $user = $this->userModel->where('id', user_id())->first(); // Mengambil informasi user yang sedang login

        if (!$user) {
            // Handle jika user tidak ditemukan
            return redirect()->to('user/login'); // Sesuaikan dengan URL login Anda
        }

        $userId = $user->id;

        $transactions = $this->db->table('payment')
        ->select('payment.*, reservation.tgl_acara, transaksi.id_transaksi, transaksi.total_harga, produk_id')
        ->join('reservation', 'reservation.id = payment.reservation_id')
        ->join('transaksi', 'transaksi.id = payment.transaksi_id')
        ->where('payment.user_id', $userId)
            ->orderBy('payment.payment_date', 'DESC')
            ->get()
            ->getResultArray();

        $data = [
            'title' => 'Transaction History',
            'transactions' => $transactions,
        ];

        return view('user/transaction_history', $data); // Sesuaikan dengan nama view yang Anda inginkan.
    }

    public function setting()
    {
        $data = [
            'title' => 'Profile',
        ];

        $user = $this->userModel->where('id', user_id())->first();

        if (!$user) {
            return redirect()->to('user/login');
        }

        $userId = $user->id;

        $payments = $this->db->table('payment')
        ->select('payment.id as paymentid, payment.id_payment, payment.reservation_id, payment.transaksi_id, payment.payment_receipt, payment.user_id, payment.total_payment, payment.payment_date,payment.status, reservation.tgl_acara, transaksi.id_transaksi, transaksi.total_harga, transaksi.produk_id,product.nama_produk,product.description,product.photos_filenames')
        ->join('reservation', 'reservation.id = payment.reservation_id', 'left')
        ->join('transaksi', 'transaksi.id = payment.transaksi_id', 'left')
        ->join('product', 'product.id = transaksi.produk_id', 'left')
        ->where('payment.user_id', $userId)
            ->orderBy('payment.payment_date', 'DESC')
            ->get()
            ->getResultArray();

        $data['payments'] = $payments;

        return view('user/setting', $data);
    }


    public function errorpage()
    {
        $data = [
            'title' => 'Hmmm Sepertinya ada yang salah...',
        ];

        return view('home/error-page', $data);
    }

}
