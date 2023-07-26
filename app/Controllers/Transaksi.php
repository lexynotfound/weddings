<?

namespace App\Controllers;

use App\Models\ProductModel;
use App\Models\CustomeModel;
use App\Models\KategoriModel;
use App\Models\TransaksiModel;
use Myth\Auth\Models\UserModel;

// Controller untuk mengelola customisasi produk
class Transaksi extends BaseController
{

    protected $db;
    protected $builder;
    protected $productModel;
    protected $costumeModel;
    protected $kategoriModel;
    protected $userModel;
    protected $transaksiModel;

    public function __construct()
    {
        $this->db = \Config\Database::connect();
        $this->builder = $this->db->table('custome');
        $this->productModel = new ProductModel();
        $this->kategoriModel = new KategoriModel();
        $this->costumeModel = new CustomeModel();
        $this->userModel = new UserModel();
        $this->transaksiModel = new TransaksiModel();
    }
    // Method untuk menampilkan halaman transaksi
    public function showTransaksiPage()
    {
        $transaksiModel = new TransaksiModel();
        $transaksiData = $transaksiModel->where('user_id', user_id())->first();

        // Load halaman transaksi dengan mengirimkan data transaksi ke view
        return view('transaksi_page', ['transaksiData' => $transaksiData]);
    }

    // Method untuk membuat transaksi
    public function createTransaksi()
    {
        $product_id = $this->request->getVar('product_id');
        $custom_option_1 = $this->request->getVar('custom_option_1');
        $custom_option_2 = $this->request->getVar('custom_option_2');
        $custom_option_3 = $this->request->getVar('custom_option_3');
        $dp_option = $this->request->getVar('dp_option'); // Berisi '30' atau 'full'

        // Lakukan validasi dan pemrosesan lain yang dibutuhkan sebelum menyimpan transaksi

        $transaksiModel = new TransaksiModel();
        $transaksi_id = 'THYX3XX23'; // Generate ID transaksi sesuai dengan kebutuhan Anda
        $user_id = user_id(); // Ambil ID user yang sedang login
        $status = 'pending'; // Tentukan status sesuai dengan kebutuhan

        $transaksiModel->insert([
            'id_transaksi' => $transaksi_id,
            'user_id' => $user_id,
            'produk_id' => $product_id,
            'status' => $status,
        ]);

        // Lakukan redirect ke halaman pembayaran sesuai dengan pilihan DP atau full payment
        if ($dp_option === '30') {
            return redirect()->to(base_url('pembayaran/dp/' . $transaksi_id));
        } else {
            return redirect()->to(base_url('pembayaran/full/' . $transaksi_id));
        }
    }
}