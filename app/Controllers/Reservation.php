<?

namespace App\Controllers;

use App\Models\ProductModel;
use App\Models\MenuModel;
use App\Models\ReservationModel;
use App\Models\ReservationDetailModel;
use Myth\Auth\Models\UserModel;
use Myth\Auth\Models\GroupModel;
class Reservation extends BaseController
{
    protected $db;
    protected $builder;
    protected $productModel;
    protected $menuModel;
    protected $reservationModel;
    protected $reservationDetailModel;
    protected $userModel;

    public function __construct()
    {
        $this->db = \Config\Database::connect();
        $this->builder = $this->db->table('reservation');
        $this->productModel = new ProductModel();
        $this->menuModel = new MenuModel();
        $this->reservationModel = new ReservationModel();
        $this->reservationDetailModel = new ReservationDetailModel();
        $this->userModel = new UserModel();
    }

    public function index($id = 0)
    {
        $data = [
            'title' => 'Reservation',
        ];

        // Perform the LEFT JOIN with reservation_detail and users tables
        $this->builder = $this->db->table('reservation_detail');
        $this->builder->select('reservation_detail.id as reservation_detailid, reservation_detail.user_id, reservation_detail.menu_id, reservation_detail.produk_id, reservation_detail.created_at, product.nama_produk, product.description, product.user_id as produk_user_id,product.harga_produk, kategori.nama_menu, kategori.deskripsi, users.username, users.email, users.nama, users.foto, users.jenis_kelamin, users.telepon, users.lokasi');
        $this->builder->join('kategori', 'kategori.id = reservation_detail.menu_id', 'left'); // Use 'left' for LEFT JOIN
        $this->builder->join('product', 'product.id = reservation_detail.produk_id', 'left'); // Use 'left' for LEFT JOIN
        $this->builder->join('users', 'users.id = reservation_detail.user_id', 'left'); // Use 'left' for LEFT JOIN

        // Fetch the reservation data with user names for the given $id
        $this->builder->where('reservation_detail.id', $id);
        $reservation = $this->builder->get()->getRowArray();

        // Check if the reservation exists
        if (!$reservation) {
            // Redirect to some error page or show an error message
            return redirect()->to('reservation/error-page');
        }

        // Pass the reservation data to the view
        $data['reservation'] = $reservation;

        return view('reservation/index', $data);
    }

    public function store()
    {
        // Validate if the user has completed their profile details
        $userData = user()->toArray();
        if (!$this->isProfileComplete($userData)) {
            return redirect()->to('user/setting')->with('error', 'Please complete your profile details before making a reservation.');
        }

        // Get the reservation detail ID from the form (assuming it's posted as 'reservation_detail_id')
        $reservationDetailId = $this->request->getPost('reservation_detail_id');

        // Retrieve the reservation detail based on the ID
        $reservationDetail = $this->reservationDetailModel->find($reservationDetailId);
        if (!$reservationDetail) {
            return redirect()->to('reservation/error-page')->with('error', 'Reservation not found.');
        }

        // Calculate the down payment (30% of the product price)
        $product = $this->productModel->find($reservationDetail['produk_id']);
        $dpAmount = 0.3 * $product['harga_produk'];

        // Get the payment option from the form (assuming it's posted as 'payment_option')
        $paymentOption = $this->request->getPost('payment_option');

        // Determine the full payment amount based on the selected payment option
        if ($paymentOption === 'dp') {
            // Update the reservation detail with down payment amount and status
            $this->reservationDetailModel->update($reservationDetailId, [
                'dp' => $dpAmount,
                'status_pembayaran' => 'pembayaran belum lunas',
                'payment_option' => 'dp', // Store the chosen payment option as 'dp'
            ]);
        } elseif ($paymentOption === 'full') {
            // Update the reservation detail with full payment amount and status
            $this->reservationDetailModel->update($reservationDetailId, [
                'full' => $product['harga_produk'],
                'status_pembayaran' => 'lunas',
                'payment_option' => 'full', // Store the chosen payment option as 'full'
            ]);
        } else {
            // Handle invalid payment option
            return redirect()->to('reservation/error-page')->with('error', 'Invalid payment option.');
        }

        // Get the logged-in user's ID
        $userId = user()->id;

        // Save the reservation data in the 'reservation' table
        $reservationData = [
            'tgl_acara' => $reservationDetail['tgl_acara'],
            'lokasi' => $reservationDetail['lokasi'],
            'user_id' => $userId,
            'reservation_detail_id' => $reservationDetailId,
        ];
        $this->reservationModel->insert($reservationData);

        // Redirect to the payment page based on the selected payment option
        if ($paymentOption === 'dp') {
            // Redirect to the down payment page
            return redirect()->to('payment/dp/')->with('success', 'Reservation details saved successfully. Please make a 30% down payment to secure your reservation.');
        } elseif ($paymentOption === 'full') {
            // Redirect to the full payment page
            return redirect()->to('payment/index/')->with('success', 'Reservation details saved successfully. Please proceed with the full payment to secure your reservation.');
        } else {
            // Handle invalid payment option
            return redirect()->to('reservation/error-page')->with('error', 'Invalid payment option.');
        }
    }


    public function errorpage()
    {
        $data = [
            'title' => 'Hmmm Sepertinya ada yang salah...',
        ];

        return view('home/error-page', $data);
    }

    /* private function isProfileComplete($user)
    {
        // Implement your logic to check if the user profile is complete
        // For example, check if all required fields in the user's profile are filled in
        return $user['nama'] !== null && $user['jenis_kelamin'] !== null && $user['telepon'] !== null && $user['lokasi'] !== null;
    } */

    // ... (code sebelumnya) ...
    public function buy($id = 0)
    {
        // Validate if the user has completed their profile details
        $userData = user()->toArray();
        if (!$this->isProfileComplete($userData)) {
            return redirect()->to('user/setting')->with('error', 'Please complete your profile details before making a reservation.');
        }

        // Check if the product exists and get the product data
        $product = $this->productModel->find($id);
        if (!$product) {
            return redirect()->to('reservation/error-page')->with('error', 'Product not found.');
        }

        // Check if the menu_id is selected (assuming the radio button's name is 'menu_id')
        $selectedMenuId = $this->request->getPost('menu_id');
        if (!$selectedMenuId) {
            return redirect()->back()->with('error', 'Please select a menu option before making a reservation.');
        }

        // Save the reservation_detail into the database
        $user_id = user()->id;
        $reservationDetailData = [
            'user_id' => $user_id,
            'produk_id' => $product['id'],
            'menu_id' => $selectedMenuId,
            'created_at' => date('Y-m-d H:i:s'),
        ];
        $this->reservationDetailModel->insert($reservationDetailData);

        // Redirect to the reservation page or any other success page
        return redirect()->to('reservation/index/'. $id)->with('success', 'Your reservation has been created successfully.');
    }

    // ... (code selanjutnya) ...

    private function isProfileComplete($userData)
    {
        // Implement your logic to check if the user profile is complete
        // For example, check if all required fields in the user's profile are filled in
        return !empty($userData['nama']) && !empty($userData['jenis_kelamin']) && !empty($userData['telepon']) && !empty($userData['lokasi']);
    }
}