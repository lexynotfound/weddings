<?

namespace App\Controllers;

use App\Models\ProductModel;
use App\Models\CustomeModel;
use App\Models\KategoriModel;
use Myth\Auth\Models\UserModel;

// Controller untuk mengelola customisasi produk
class Custome extends BaseController
{

    protected $db;
    protected $builder;
    protected $productModel;
    protected $costumeModel;
    protected $kategoriModel;
    protected $userModel;

    public function __construct()
    {
        $this->db = \Config\Database::connect();
        $this->builder = $this->db->table('custome');
        $this->productModel = new ProductModel();
        $this->kategoriModel = new KategoriModel();
        $this->costumeModel = new CustomeModel();
        $this->userModel = new UserModel();
    }
    // Method untuk menampilkan halaman customisasi
    public function showCustomPage($product_id)
    {
        $productModel = new ProductModel();
        $product = $productModel->find($product_id);

        // Load halaman customisasi dengan mengirimkan data produk ke view
        return view('custom_page', ['product' => $product]);
    }

    // Method untuk menyimpan data customisasi
    public function saveCustomization()
    {
        $product_id = $this->request->getVar('product_id');
        $custom_option_1 = $this->request->getVar('custom_option_1');
        $custom_option_2 = $this->request->getVar('custom_option_2');
        $custom_option_3 = $this->request->getVar('custom_option_3');

        $customeModel = new CustomeModel();
        $customeModel->insert([
            'produk_id' => $product_id,
            'user_id' => user_id(), // Ambil ID user yang sedang login
            'custom_option_1' => $custom_option_1,
            'custom_option_2' => $custom_option_2,
            'custom_option_3' => $custom_option_3,
        ]);

        // Redirect ke halaman transaksi
        return redirect()->to(base_url('transaksi'));
    }
}