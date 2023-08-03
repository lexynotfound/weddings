<?

namespace App\Controllers;

use App\Models\ProductModel;
use App\Models\ReservationDetailModel;
use App\Models\ReservationModel;
use App\Models\MenuModel;
use App\Models\TransaksiModel;
use Myth\Auth\Models\UserModel;

// Controller untuk mengelola customisasi produk
class Payment extends BaseController
{

    protected $db;
    protected $builder;
    protected $productModel;
    protected $menuModel;
    protected $userModel;
    protected $reservationModel;
    protected $reservationDetailModel;
    protected $transaksiModel;

    public function __construct()
    {
        $this->db = \Config\Database::connect();
        $this->builder = $this->db->table('custome');
        $this->productModel = new ProductModel();
        $this->reservationModel = new ReservationModel();
        $this->reservationDetailModel = new ReservationDetailModel();
        $this->menuModel = new MenuModel();
        $this->userModel = new UserModel();
        $this->transaksiModel = new TransaksiModel();
    }

    // Method untuk menampilkan halaman transaksi
    public function index($id = 0)
    {
        $data = [
            'title' => 'Payment',
        ];

        // Perform the LEFT JOIN with reservation_detail and users tables
        $this->builder = $this->db->table('reservation');
        $this->builder->select('reservation.id as reservationid, reservation.user_id, reservation.reservation_detail_id, reservation.user_id, reservation.tgl_acara,reservation.lokasi,reservation.payment_option,reservation.status,reservation_detail.produk_id,reservation_detail.menu_id,reservation_detail.user_id as reservation_detail_user_id, product.nama_produk, product.description, product.user_id as produk_user_id,product.harga_produk,product.photos_filenames, kategori.nama_menu, kategori.deskripsi, users.username as reservation_username, users.email as reservation_email, users.nama as reservation_nama, users.foto as reservation_foto, users.jenis_kelamin as reservation_gender, users.telepon as reservation_telepon, users.lokasi as reservation_lokasi, product_users.username as product_username,product_users.nama as product_nama,product_users.foto as product_foto,product_users.lokasi as product_lokasi,product_users.foto as product_foto');
        $this->builder->join('reservation_detail', 'reservation_detail.id = reservation.reservation_detail_id', 'left'); // Use 'left' for LEFT JOIN
        $this->builder->join('kategori', 'kategori.id = reservation_detail.menu_id', 'left'); // Use 'left' for LEFT JOIN
        $this->builder->join('product', 'product.id = reservation_detail.produk_id', 'left'); // Use 'left' for LEFT JOIN
        $this->builder->join('users', 'users.id = reservation.user_id', 'left'); // Use 'left' for LEFT JOIN
        $this->builder->join('users as product_users', 'product_users.id = product.user_id', 'left'); // Use 'left' for LEFT JOIN

        // Fetch the reservation data with user names for the given $id
        $this->builder->where('reservation.id', $id);
        $reservation = $this->builder->get()->getRowArray();

        // Check if the reservation exists
        if (!$reservation) {
            // Redirect to some error page or show an error message
            return redirect()->to('reservation/error-page');
        }

        // Pass the reservation data to the view
        $data['reservation'] = $reservation;

        return view('payment/full', $data);
    }

    public function dp($id = 0)
    {
        $data = [
            'title' => 'Payment',
        ];

        // Perform the LEFT JOIN with reservation_detail and users tables
        $this->builder = $this->db->table('reservation');
        $this->builder->select('reservation.id as reservationid, reservation.user_id, reservation.reservation_detail_id, reservation.user_id, reservation.tgl_acara,reservation.lokasi,reservation.payment_option,reservation.status,reservation_detail.produk_id,reservation_detail.menu_id,reservation_detail.user_id as reservation_detail_user_id, product.nama_produk, product.description, product.user_id as produk_user_id,product.harga_produk,product.photos_filenames, kategori.nama_menu, kategori.deskripsi, users.username as reservation_username, users.email as reservation_email, users.nama as reservation_nama, users.foto as reservation_foto, users.jenis_kelamin as reservation_gender, users.telepon as reservation_telepon, users.lokasi as reservation_lokasi, product_users.username as product_username,product_users.nama as product_nama,product_users.foto as product_foto,product_users.lokasi as product_lokasi,product_users.foto as product_foto');
        $this->builder->join('reservation_detail', 'reservation_detail.id = reservation.reservation_detail_id', 'left'); // Use 'left' for LEFT JOIN
        $this->builder->join('kategori', 'kategori.id = reservation_detail.menu_id', 'left'); // Use 'left' for LEFT JOIN
        $this->builder->join('product', 'product.id = reservation_detail.produk_id', 'left'); // Use 'left' for LEFT JOIN
        $this->builder->join('users', 'users.id = reservation.user_id', 'left'); // Use 'left' for LEFT JOIN
        $this->builder->join('users as product_users', 'product_users.id = product.user_id', 'left'); // Use 'left' for LEFT JOIN

        // Fetch the reservation data with user names for the given $id
        $this->builder->where('reservation.id', $id);
        $reservation = $this->builder->get()->getRowArray();

        // Check if the reservation exists
        if (!$reservation) {
            // Redirect to some error page or show an error message
            return redirect()->to('reservation/error-page');
        }

        // Pass the reservation data to the view
        $data['reservation'] = $reservation;

        return view('payment/dp', $data);
    }
}
