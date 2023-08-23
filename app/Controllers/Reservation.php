<?

namespace App\Controllers;

use App\Models\ProductModel;
use App\Models\MenuModel;
use App\Models\ReservationModel;
use App\Models\ReservationDetailModel;
use App\Models\TransaksiModel;
use App\Models\PaymentModel;
use Myth\Auth\Models\UserModel;
use Myth\Auth\Models\GroupModel;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Dompdf\Dompdf;
use Dompdf\Options;
class Reservation extends BaseController
{
    protected $db;
    protected $builder;
    protected $productModel;
    protected $menuModel;
    protected $reservationModel;
    protected $reservationDetailModel;
    protected $transaksiModel;
    protected $paymentModel;
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
        $this->paymentModel = new PaymentModel();
        $this->transaksiModel = new TransaksiModel();
    }

    public function index($id_transaksi)
    {
        $data = [
            'title' => 'Reservation',
        ];

        // Perform the LEFT JOIN with reservation_detail and users tables
        $this->builder = $this->db->table('transaksi');
        $this->builder->select('transaksi.id as transaksiid, transaksi.user_id, transaksi.menu_id, transaksi.produk_id,transaksi.total_harga, transaksi.tgl_transaksi, product.nama_produk, product.description, product.user_id as produk_user_id,product.harga_produk, kategori.nama_menu, kategori.deskripsi, users.username, users.email, users.nama, users.foto, users.jenis_kelamin, users.telepon, users.lokasi');
        $this->builder->join('kategori', 'kategori.id = transaksi.menu_id', 'left'); // Use 'left' for LEFT JOIN
        $this->builder->join('product', 'product.id = transaksi.produk_id', 'left'); // Use 'left' for LEFT JOIN
        $this->builder->join('users', 'users.id = transaksi.user_id', 'left'); // Use 'left' for LEFT JOIN

        // Fetch the reservation data with user names for the given $id
        $this->builder->where('transaksi.id_transaksi', $id_transaksi);
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

    public function data()
    {
        $data = [
            'title' => 'List Reservation Weddings',
        ];
        $reservation = $this->db->table('reservation')
        ->select('reservation.id as reservationid, reservation.tgl_acara, reservation.user_id, reservation.transaksi_id, reservation.lokasi, reservation.status, payment.id_payment,payment.total_payment, payment.payment_date,payment.status, reservation.tgl_acara,reservation.lokasi, transaksi.id_transaksi, transaksi.total_harga, transaksi.produk_id,product.nama_produk,product.description,product.photos_filenames,product.harga_produk,user_produk.nama,user_produk.foto,user_produk.lokasi,user_produk.jenis_kelamin,user_produk.telepon,users.nama,users.lokasi,users.jenis_kelamin,users.telepon,users.email')
        ->join('users', 'users.id = reservation.user_id', 'left')
        ->join('payment', 'reservation.id = payment.reservation_id', 'left')
        ->join('transaksi', 'transaksi.id = reservation.transaksi_id', 'left')
        ->join('product', 'product.id = transaksi.produk_id', 'left')
        ->join('users as user_produk', 'user_produk.id = product.user_id', 'left')
        ->orderBy('payment.payment_date', 'DESC')
        ->get()
            ->getResultArray();

        // Check if the payment exists
        if (!$reservation) {
            // Redirect to some error page or show an error message
            return redirect()->to('payment/error-page');
        }

        // Pass the payment data to the view
        $data['reservation'] = $reservation;

        return view('reservation/data', $data);
    }

    public function reservation($id = 0)
    {
        $data = [
            'title' => 'Reservation',
        ];

        // Perform the LEFT JOIN with reservation_detail and users tables
        $this->builder = $this->db->table('transaksi');
        $this->builder->select('transaksi.id as transaksiid, transaksi.user_id, transaksi.menu_id, transaksi.produk_id,transaksi.total_harga, transaksi.tgl_transaksi, product.nama_produk, product.description, product.user_id as produk_user_id,product.harga_produk, kategori.nama_menu, kategori.deskripsi, users.username, users.email, users.nama, users.foto, users.jenis_kelamin, users.telepon, users.lokasi');
        $this->builder->join('kategori', 'kategori.id = transaksi.menu_id', 'left'); // Use 'left' for LEFT JOIN
        $this->builder->join('product', 'product.id = transaksi.produk_id', 'left'); // Use 'left' for LEFT JOIN
        $this->builder->join('users', 'users.id = transaksi.user_id', 'left'); // Use 'left' for LEFT JOIN
        $this->builder->orderBy('transaksi.id','DESC');
        // Fetch the reservation data with user names for the given $id
        $this->builder->where('product.id', $id);
        $reservation = $this->builder->get()->getRowArray();

        // Check if the reservation exists
        if (!$reservation) {
            // Redirect to some error page or show an error message
            return redirect()->to('reservation/error-page');
        }

        // Pass the reservation data to the view
        $data['reservation'] = $reservation;

        return view('reservation/reservation', $data);
    }

    public function store()
    {
        $rules = [
            // ... aturan validasi lainnya ...
            'tgl_acara' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Tanggal Reservation harus di isi',
                ]
            ],
            'lokasi' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Lokasi Pernikahan Harus di isi',
                ]
            ],
        ];
        // Perform validation
        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('error', $this->validator->listErrors());
        }

        // Validate if the user has completed their profile details
        $userData = user()->toArray();
        if (!$this->isProfileComplete($userData)) {
            return redirect()->to('user/setting')->with('error', 'Please complete your profile details before making a reservation.');
        }

        // Get the reservation detail ID from the form (assuming it's posted as 'reservation_detail_id')
        $transaksiId = $this->request->getPost('transaksi_id');

        // Retrieve the reservation detail based on the ID
        $transaksi = $this->transaksiModel->find($transaksiId);
        if (!$transaksi) {
            return redirect()->to('reservation/error-page')->with('error', 'Reservation not found.');
        }

        // Check if the 'produk_id' key exists in the $reservationDetail array
        if (!array_key_exists('produk_id', $transaksi)) {
            return redirect()->to('reservation/error-page')->with('error', 'Invalid reservation detail.');
        }

        // Get the payment option from the form (assuming it's posted as 'payment_option')
        $paymentOption = $this->request->getPost('payment_option');

        // Calculate the payment amount based on the selected payment option
        $totalHarga = $transaksi['total_harga'];
        $paymentAmount = 0;
        $status = 'pending';

        if ($paymentOption === 'dp') {
            // Calculate 30% down payment
            $paymentAmount = 0.3 * $totalHarga;
        } elseif ($paymentOption === 'full') {
            // Full payment
            $paymentAmount = $totalHarga;
            $status = 'paid';
        } elseif ($paymentOption === 'dp_later') {
            // Payment after 1 month from tgl_acara
            // You need to implement the logic to calculate the payment after 1 month
            // For demonstration purposes, I'll set the payment amount to 70% of totalHarga
            $paymentAmount = 0.7 * $totalHarga;
            $status = 'Lakukan Pembayaran Pelunasan';
        } else {
            // Handle invalid payment option
            return redirect()->to('reservation/error-page')->with('error', 'Invalid payment option.');
        }

        // Save the payment amount and status in the 'reservation' table
        $reservationData = [
            'tgl_acara' => $this->request->getPost('tgl_acara'), // User input for tgl_acara
            'lokasi' => $this->request->getPost('lokasi'), // User input for lokasi
            'user_id' => user()->id,
            'transaksi_id' => $transaksiId, // Save the newly inserted transaksi_id here
            'payment_option' => $paymentOption,
            'payment_amount' => $paymentAmount, // Save the calculated payment amount
            'status' => $status, // Save the status based on the selected payment option
        ];
        $this->reservationModel->insert($reservationData);

        // Redirect to the payment page based on the selected payment option and reservation detail ID
        if ($paymentOption === 'dp') {
            // Redirect to the down payment page with the reservation detail ID
            return redirect()->to('payment/dp/' . $transaksiId)->with('success', 'Reservation details saved successfully. Please make a 30% down payment to secure your reservation.');
        } elseif ($paymentOption === 'full' || $paymentOption === 'dp_later') {
            // Redirect to the payment page with the reservation detail ID
            return redirect()->to('payment/full/' . $transaksiId)->with('success', 'Reservation details saved successfully. Please proceed with the payment to secure your reservation.');
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

        // Get the 'harga_produk' from the form data
        $hargaProduk = $this->request->getPost('harga_produk');

        // Check if the menu_id is selected (assuming the radio button's name is 'menu_id')
        $selectedMenuId = $this->request->getPost('menu_id');

        // Check if the selectedMenuId is not empty and it exists as a valid foreign key in the 'kategori' table
        $menuExists = true; // Assume menu exists
        if ($selectedMenuId) {
            $menu = $this->menuModel->find($selectedMenuId);
            if (!$menu) {
                // Invalid menu_id, set menuExists to false
                $menuExists = false;
            }
        } else {
            // If the selectedMenuId is empty, set menuExists to false
            $menuExists = false;
        }

        // Save the reservation_detail into the database
        $user_id = user()->id;
        $transaksiData = [
            'id_transaksi' => 'TRX-' . uniqid(), // Generate the transaction ID
            'total_harga' => $hargaProduk, // Save the 'harga_produk' as total_harga
            'user_id' => $user_id,
            'status' => 'pending', // Set the status to 'pending'
            'produk_id' => $product['id'],
            'menu_id' => $menuExists ? $selectedMenuId : null, // Save the menu_id if it exists, otherwise set to null
            'tgl_transaksi' => date('Y-m-d H:i:s'),
        ];
        $this->transaksiModel->insert($transaksiData);


        // Redirect to the reservation page or any other success page
        return redirect()->to('reservation/reservation/' . $id)->with('success', 'Your reservation has been created successfully.');
    }

    public function generatePdf()
    {
        // Query data dari database
        $payment = $this->reservationModel->findAll();

        // Buat objek DOMPDF baru
        $dompdf = new Dompdf();

        // Buat template HTML untuk PDF
        $html = '<h1 style="text-align: center;">Data Laporan Product</h1>';
        $html .= '<table style="width: 100%; border-collapse: collapse; margin: 0 auto;">';
        $html .= '<thead>';
        $html .= '<tr>';
        $html .= '<th style="border: 1px solid #000; padding: 8px; border-top-left-radius: 8px;">No</th>';
        $html .= '<th style="border: 1px solid #000; padding: 8px;">Payment ID</th>';
        $html .= '<th style="border: 1px solid #000; padding: 8px;">Paket Name</th>';
        $html .= '<th style="border: 1px solid #000; padding: 8px;">Bride Name</th>';
        $html .= '<th style="border: 1px solid #000; padding: 8px;">Lokasi</th>';
        $html .= '<th style="border: 1px solid #000; padding: 8px; border-top-right-radius: 8px;">Weddings Date</th>';
        $html .= '</tr>';
        $html .= '</thead>';
        $html .= '<tbody>';

        $no = 1;
        foreach ($payment as $lp) {
            $html .= '<tr>';
            $html .= '<td style="border: 1px solid #000; padding: 8px;">' . $no . '</td>';
            $buku = $this->paymentModel->find($lp['transaksi_id']);
            if ($buku) {
                $html .= '<td style="border: 1px solid #000; padding: 8px;">' . $buku['id_payment'] . '</td>';
            } else {
                $html .= '<td style="border: 1px solid #000; padding: 8px;"></td>';
            }
            $cc = $this->productModel->find($lp['transaksi_id']);
            if ($cc) {
                $html .= '<td style="border: 1px solid #000; padding: 8px;">' . $cc['nama_produk'] . '</td>';
            } else {
                $html .= '<td style="border: 1px solid #000; padding: 8px;"></td>';
            }
            $rr = $this->userModel->find($lp['user_id']);
            if ($rr) {
                $html .= '<td style="border: 1px solid #000; padding: 8px;">' . $rr->nama . '</td>';
            } else {
                $html .= '<td style="border: 1px solid #000; padding: 8px;"></td>';
            }
            $html .= '<td style="border: 1px solid #000; padding: 8px;">' . $lp['lokasi'] . '</td>';
            $html .= '<td style="border: 1px solid #000; padding: 8px;">' . $lp['tgl_acara'] . '</td>';
            // Ambil data buku berdasarkan buku_id

            $html .= '</tr>';
            $no++;
        }

        $html .= '</tbody></table>';

        // Load konten HTML ke DOMPDF
        $dompdf->loadHtml($html);

        // Set orientasi landscape
        $dompdf->setPaper('A4', 'landscape');

        // Aktifkan opsi isRemoteEnabled
        $dompdf->set_option('isRemoteEnabled', true);

        // Render konten HTML menjadi PDF
        $dompdf->render();

        // Simpan PDF ke file
        $output = $dompdf->output();
        file_put_contents('laporan_reservasi.pdf', $output);

        // Unduh file PDF
        header('Content-Type: application/pdf');
        header('Content-Disposition: attachment; filename="laporan_reservasi.pdf"');
        readfile('laporan_reservasi.pdf');
        exit();
    }

    private function isProfileComplete($userData)
    {
        // Implement your logic to check if the user profile is complete
        // For example, check if all required fields in the user's profile are filled in
        return !empty($userData['nama']) && !empty($userData['jenis_kelamin']) && !empty($userData['telepon']) && !empty($userData['lokasi']);
    }
}