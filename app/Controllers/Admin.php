<?php

namespace App\Controllers;

use App\Models\ProductModel;
use App\Models\MenuModel;
use App\Models\PaymentModel;
use App\Models\CategoriesModel;
use App\Models\ReservationModel;
use App\Models\TransaksiModel;
use Myth\Auth\Models\UserModel;
use Myth\Auth\Models\GroupModel;

class Admin extends BaseController
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

    public function index()
    {
        $data = [
            'title' => 'Tenda Hj.Yus',
        ];

        // Get authenticated user data
        $user = service('authentication')->user();

        // Check if the user is an admin
        $groupModel = new GroupModel();
        $isAdmin = false;
        $userGroups = $groupModel->getGroupsForUser($user->id);

        // Iterate through each group to find 'admin' role
        foreach ($userGroups as $group) {
            if ($group['name'] === 'admin') {
                $isAdmin = true;
                break;
            }
        }

        if (!$isAdmin) {
            // Handle the error if the user is not an admin
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Page not found');
        }

        $payments = $this->db->table('payment')
            ->select('payment.id as paymentid, payment.id_payment, payment.reservation_id, payment.transaksi_id, payment.payment_receipt, payment.user_id, payment.total_payment, payment.payment_date,payment.status, reservation.tgl_acara,reservation.lokasi, transaksi.id_transaksi, transaksi.total_harga, transaksi.produk_id,product.nama_produk,product.description,product.photos_filenames,user_produk.nama,user_produk.foto,user_produk.lokasi,user_produk.jenis_kelamin,user_produk.telepon')
            ->join('reservation', 'reservation.id = payment.reservation_id', 'left')
            ->join('transaksi', 'transaksi.id = payment.transaksi_id', 'left')
            ->join('product', 'product.id = transaksi.produk_id', 'left')
            ->join('users as user_produk', 'user_produk.id = product.user_id', 'left')
            ->orderBy('payment.payment_date', 'DESC')
            ->get()
            ->getResultArray();

        $reservation = $this->db->table('reservation')
            ->select('reservation.id as reservationid, reservation.tgl_acara,reservation.user_id,reservation.lokasi,reservation.transaksi_id, transaksi.id_transaksi, transaksi.total_harga, transaksi.produk_id,product_transaksi.nama_produk,product_transaksi.description,product_transaksi.photos_filenames,user_produk.nama,user_produk.foto,user_produk.lokasi,user_produk.jenis_kelamin,user_produk.telepon,users.nama,users.lokasi,users.telepon,users.jenis_kelamin as gender,users.username')
            ->join('transaksi', 'transaksi.id = reservation.transaksi_id', 'left')
            ->join('users', 'users.id = reservation.user_id', 'left')
            ->join('product as product_transaksi', 'product_transaksi.id = transaksi.produk_id', 'left')
            ->join('users as user_produk', 'user_produk.id = product_transaksi.user_id', 'left')
            ->orderBy('reservation.tgl_acara', 'DESC')
            ->get()
            ->getResultArray();


        // Calculate the total payment and total dp separately
        $totalPayment = 0;
        $totalDp = 0;
        $totalPaid = 0;

        foreach ($payments as $payment) {
            $totalPayment += $payment['total_payment'];
            if ($payment['status'] === 'Pembayaran DP') {
                $totalDp += $payment['total_payment'];
            } elseif($payment['status'] === 'PAID') {
                $totalPaid += $payment['total_payment'];
            }
        }

        $data['payments'] = $payments;
        $data['reservation'] = $reservation;
        $data['totalPrice'] = $totalPaid; // melakukan perhitungan total yang membayar lunas berdasarkan status
        $data['totalPayment'] = $totalPayment; // melakukan keselurhan perhitungan total dari yang paid dan dp
        $data['totalDp'] = $totalDp;// melakukan perhitungan berdasarkan dp

        return view('admin/index', $data);
    }

    public function getReservations()
    {
        // Fetch reservation data from the database and format as JSON
        $reservations = $this->reservationModel->getAllReservations(); // Implement this method in your ReservationModel
        $formattedReservations = [];

        foreach ($reservations as $reservation) {
            $formattedReservations[] = [
                'title' => $reservation['nama'], // Event title from users table
                'start' => $reservation['tgl_acara'], // Event start date
                'location' => $reservation['lokasi'], // Event location
            ];
        }

        return $this->response->setJSON($formattedReservations);
    }

    public function showCalendar()
    {
        return view('admin/index'); // Ubah sesuai dengan nama file view dan direktori Anda
    }


}
