<?

namespace App\Controllers;

use App\Models\ProductModel;
use App\Models\KategoriModel;
use App\Models\ReservationModel;
use Myth\Auth\Models\UserModel;
use Myth\Auth\Models\GroupModel;
class Reservation extends BaseController
{
    protected $db;
    protected $builder;
    protected $productModel;
    protected $kategoriModel;
    protected $reservationModel;
    protected $userModel;

    public function __construct()
    {
        $this->db = \Config\Database::connect();
        $this->builder = $this->db->table('reservation');
        $this->productModel = new ProductModel();
        $this->kategoriModel = new KategoriModel();
        $this->reservationModel = new ReservationModel();
        $this->userModel = new UserModel();
    }
    public function index()
    {
        // Check if the user has filled in their complete profile data
        $userId = user_id_from_session(); // Replace this with your actual function to get the logged-in user ID
        $user = $this->userModel->getUserById($userId); // Replace this with your actual function to get user data by ID

        // Check if the user profile is complete
        if (!$this->isProfileComplete($user)) {
            // If the user profile is not complete, redirect to the profile completion page
            return redirect()->to('profile/completion');
        }

        // Load the product data based on the produk_id (replace 'produk_id' with the actual column name in your 'product' table)
        $productId = get_selected_product_id(); // Replace this with your actual function to get the selected product ID
        $product = $this->productModel->getProductById($productId); // Replace this with your actual function to get product data by ID

        // Load the reservation view with the product data
        return view('reservation/index', [
            'product' => $product
        ]);
    }

    public function store()
    {
        // Get the form data
        $date = $this->request->getPost('date');
        $location = $this->request->getPost('location');
        $paymentType = $this->request->getPost('payment_type');

        // Perform validation
        $validationRules = [
            'date' => [
                'label' => 'Date',
                'rules' => 'required|valid_date|check_reservation_date',
                'errors' => [
                    'required' => '{field} is required.',
                    'valid_date' => 'Invalid {field} format.',
                    'check_reservation_date' => 'You cannot make a reservation on the same date or within two days of the selected date.'
                ]
            ],
            'location' => [
                'label' => 'Location',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} is required.'
                ]
            ],
            // Add other form fields as needed
        ];

        if (!$this->validate($validationRules)) {
            // If validation fails, redirect back to the reservation form with validation errors
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        // Insert the reservation data into the database
        $userId = user_id_from_session(); // Replace this with your actual function to get the logged-in user ID
        $productId = get_selected_product_id(); // Replace this with your actual function to get the selected product ID

        $reservationData = [
            'tgl_acara' => $date,
            'location' => $location,
            'user_id' => $userId,
            'produk_id' => $productId,
            'status' => 'pending', // Set the status as 'pending' or other appropriate value
            // Add more reservation data fields as needed
        ];

        $this->reservationModel->insert($reservationData);

        // After successfully storing the reservation data, redirect to the payment page
        return redirect()->to('payment');
    }

    private function isProfileComplete($user)
    {
        // Implement your logic to check if the user profile is complete
        // For example, check if all required fields in the user's profile are filled in
        return $user['nama'] !== null && $user['jenis_kelamin'] !== null && $user['telepon'] !== null && $user['lokasi'] !== null;
    }
}