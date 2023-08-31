<?

namespace App\Controllers;

use Carbon\Carbon;
use Midtrans\Config;
use Midtrans\Snap;
use App\Models\ProductModel;
use App\Models\ReservationDetailModel;
use App\Models\ReservationModel;
use App\Models\MenuModel;
use App\Models\TransaksiModel;
use App\Models\PaymentModel;
use Myth\Auth\Models\UserModel;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Dompdf\Dompdf;
use Dompdf\Options;

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
    protected $paymentModel;

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
        $this->paymentModel = new PaymentModel();
    }

    public function transaction(){
        $data = [
            'title' => 'List Payments',
        ];
        $payments = $this->db->table('payment')
            ->select('payment.id as paymentsid, payment.id_payment, payment.reservation_id, payment.transaksi_id, payment.payment_receipt,payment_updated, payment.user_id, payment.total_payment, payment.payment_date,payment.status, reservation.tgl_acara,reservation.lokasi, transaksi.id_transaksi, transaksi.total_harga, transaksi.produk_id,product.nama_produk,product.description,product.photos_filenames,product.harga_produk,user_produk.nama,user_produk.foto,user_produk.lokasi,user_produk.jenis_kelamin,user_produk.telepon')
            ->join('reservation', 'reservation.id = payment.reservation_id', 'left')
            ->join('transaksi', 'transaksi.id = payment.transaksi_id', 'left')
            ->join('product', 'product.id = transaksi.produk_id', 'left')
            ->join('users as user_produk', 'user_produk.id = product.user_id', 'left')
            ->orderBy('payment.payment_date', 'DESC')
            ->get()
            ->getResultArray();

        // Check if the payment exists
        if (!$payments) {
            // Redirect to some error page or show an error message
            return redirect()->to('payment/error-page');
        }

        // Pass the payment data to the view
        $data['payments'] = $payments;

        return view('payment/transaction', $data);
    }

    // Method untuk menampilkan halaman transaksi
    public function index($id = 0)
    {
        $data = [
            'title' => 'Full Payment',
        ];
        
        // Perform the LEFT JOIN with reservation_detail and users tables
        $this->builder = $this->db->table('reservation');
        $this->builder->select('reservation.id as reservationid, reservation.user_id, reservation.transaksi_id, reservation.user_id, reservation.tgl_acara,reservation.lokasi,reservation.status,transaksi.produk_id,transaksi.menu_id,transaksi.user_id as transaksi_user_id,transaksi.total_harga,transaksi.id_transaksi, product.nama_produk, product.description, product.user_id as produk_user_id,product.harga_produk,product.photos_filenames, kategori.nama_menu, kategori.deskripsi, users.username as reservation_username, users.email as reservation_email, users.nama as reservation_nama, users.foto as reservation_foto, users.jenis_kelamin as reservation_gender, users.telepon as reservation_telepon, users.lokasi as reservation_lokasi, product_users.username as product_username,product_users.nama as product_nama,product_users.foto as product_foto,product_users.lokasi as product_lokasi,product_users.foto as product_foto');
        $this->builder->join('transaksi', 'transaksi.id = reservation.transaksi_id', 'left'); // Use 'left' for LEFT JOIN
        $this->builder->join('kategori', 'kategori.id = transaksi.menu_id', 'left'); // Use 'left' for LEFT JOIN
        $this->builder->join('product', 'product.id = transaksi.produk_id', 'left'); // Use 'left' for LEFT JOIN
        $this->builder->join('users', 'users.id = reservation.user_id', 'left'); // Use 'left' for LEFT JOIN
        $this->builder->join('users as product_users', 'product_users.id = product.user_id', 'left'); // Use 'left' for LEFT JOIN

        // Fetch the reservation data with user names for the given $id
        $this->builder->where('transaksi.id', $id);
        $reservation = $this->builder->get()->getRowArray();

        // Check if the reservation exists
        if (!$reservation) {
            // Redirect to some error page or show an error message
            return redirect()->to('payment/error-page');
        }

        // Pass the reservation data to the view
        $data['reservation'] = $reservation;

        return view('payment/full', $data);
    }

    public function buy($id = 0)
    {
        // Validate if the user has completed their profile details
        $userData = user()->toArray();
        if (!$this->isProfileComplete($userData)) {
            return redirect()->to('user/setting')->with('error', 'Please complete your profile details before making a reservation.');
        }

        // Check if the reservation exists and get the reservation data
        $reservation = $this->reservationModel->find($id);
        if (!$reservation) {
            return redirect()->to('payment/error-page')->with('error', 'Reservation not found.');
        }

        // Fetch the corresponding transaksi data using the transaksi_id from the reservation
        $transaksi = $this->transaksiModel->find($reservation['transaksi_id']);
        if (!$transaksi) {
            return redirect()->to('payment/error-page')->with('error', 'Transaksi not found.');
        }

        // Get the 'total_harga' from the 'transaksi' table
        $totalHarga = $transaksi['total_harga'];

        // Calculate the DP amount (30% of the total price)
        $dpAmount = $totalHarga * 0.3;

        // Validate and upload the payment receipt photo
        $validation = \Config\Services::validation();

        $validation->setRules([
            'payment_receipt' => [
                'uploaded[payment_receipt]',
                'mime_in[payment_receipt,image/jpg,image/jpeg,image/png]',
                'max_size[payment_receipt,50000]', // 50 MB in kilobytes
                // 'min_size[payment_receipt,10000]'  // 10 MB in kilobytes (optional)
            ]
        ]);

        if (!$validation->run(request()->getPost())) {
            return redirect()->back()->with('error', $validation->getErrors());
        }

        $file = request()->getFile('payment_receipt');
        $filename = $file->getRandomName();
        $file->move('./uploads',
            $filename
        );

        // Save the payment detail into the database
        $user_id = user()->id;
        $paymentData = [
            'id_payment' => 'PAYDP-' . uniqid(), // Generate the payment ID for DP
            'total_payment' => $dpAmount, // Save the DP amount as total_payment
            'user_id' => $user_id,
            'status' => 'Menunggu Verifikasi', // Set the status to 'Pembayaran DP'
            'payment_receipt' => $filename,
            'transaksi_id' => $transaksi['id'], // Use the correct primary key for transaksi
            'reservation_id' => $reservation['id'], // Use the correct primary key for reservation
            'payment_date' => date('Y-m-d H:i:s'),
        ];
        $this->paymentModel->insert($paymentData);

        // Save the id_payment in session
        session()->set('id_payment',
            $paymentData['id_payment']
        );
        // Redirect to the reservation page or any other success page
        /* return redirect()->to('payment/invoice/' . $paymentData['id_payment'])->with('success', 'Your reservation has been created successfully.'); */
        return redirect()->to('user/transaksi')->with('success', 'Your reservation has been created successfully.');
    }

    /* public function paid($id = 0)
    {
        // Validate if the user has completed their profile details
        $userData = user()->toArray();
        if (!$this->isProfileComplete($userData)) {
            return redirect()->to('user/setting')->with('error', 'Please complete your profile details before making a reservation.');
        }

        // Check if the reservation exists and get the reservation data
        $reservation = $this->reservationModel->find($id);
        if (!$reservation) {
            return redirect()->to('payment/error-page')->with('error', 'Reservation not found.');
        }

        // Fetch the corresponding transaksi data using the transaksi_id from the reservation
        $transaksi = $this->transaksiModel->find($reservation['transaksi_id']);
        if (!$transaksi) {
            return redirect()->to('payment/error-page')->with('error', 'Transaksi not found.');
        }

        // Get the 'total_harga' from the 'transaksi' table
        $totalHarga = $transaksi['total_harga'];

        // Upload gambar dengan nama acak
        $photo1 = $this->request->getFile('payment_receipt');
        $newFileName1 = $photo1->getRandomName();
        $photo1->move('./uploads', $newFileName1);
        

        // Save the payment detail into the database
        $user_id = user()->id;
        $paymentData = [
            'id_payment' => 'PAY-' . uniqid(), // Generate the payment ID for DP
            'total_payment' =>  $totalHarga, // Save the DP amount as total_payment
            'user_id' => $user_id,
            'status' => 'PAID', // Set the status to 'Pembayaran DP'
            'payment_receipt' => $photo1,
            'transaksi_id' => $transaksi['id'], // Use the correct primary key for transaksi
            'reservation_id' => $reservation['id'], // Use the correct primary key for reservation
            'payment_date' => date('Y-m-d H:i:s'),
        ];
        $this->paymentModel->insert($paymentData);

        // Save the id_payment in session
        session()->set(
            'id_payment',
            $paymentData['id_payment']
        );
        // Redirect to the reservation page or any other success page
        return redirect()->to('payment/invoice/' . $paymentData['id_payment'])->with('success', 'Your reservation has been created successfully.');
    } */

    public function paid($id = 0)
    {
        // Validate if the user has completed their profile details
        $userData = user()->toArray();
        if (!$this->isProfileComplete($userData)) {
            return redirect()->to('user/setting')->with('error', 'Please complete your profile details before making a reservation.');
        }

        // Check if the reservation exists and get the reservation data
        $reservation = $this->reservationModel->find($id);
        if (!$reservation) {
            return redirect()->to('payment/error-page')->with('error', 'Reservation not found.');
        }

        // Fetch the corresponding transaksi data using the transaksi_id from the reservation
        $transaksi = $this->transaksiModel->find($reservation['transaksi_id']);
        if (!$transaksi) {
            return redirect()->to('payment/error-page')->with('error', 'Transaksi not found.');
        }

        // Get the 'total_harga' from the 'transaksi' table
        $totalHarga = $transaksi['total_harga'];

        // Validate and upload the payment receipt photo
        $validation = \Config\Services::validation();

        $validation->setRules([
            'payment_receipt' => [
                'uploaded[payment_receipt]',
                'mime_in[payment_receipt,image/jpg,image/jpeg,image/png]',
                'max_size[payment_receipt,50000]', // 50 MB in kilobytes
                // 'min_size[payment_receipt,10000]'  // 10 MB in kilobytes (optional)
            ]
        ]);

        if (!$validation->run(request()->getPost())) {
            return redirect()->back()->with('error', $validation->getErrors());
        }

        $file = request()->getFile('payment_receipt');
        $filename = $file->getRandomName();
        $file->move('./uploads', $filename);

        // Save the payment detail into the database
        $user_id = user()->id;
        $paymentData = [
            'id_payment' => 'PAY-' . uniqid(),
            'total_payment' =>  $totalHarga,
            'user_id' => $user_id,
            'status' => 'Menunggu Verifikasi',
            'payment_receipt' => $filename,
            'transaksi_id' => $transaksi['id'],
            'reservation_id' => $reservation['id'],
            'payment_date' => date('Y-m-d H:i:s'),
        ];

        // Insert the payment data into the database
        try {
            $this->paymentModel->insert($paymentData);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred while saving payment data: ' . $e->getMessage());
        }

        // Save the id_payment in session
        session()->set('id_payment', $paymentData['id_payment']);

        // Redirect to the reservation page or any other success page
        /* return redirect()->to('payment/invoice/' . $paymentData['id_payment'])->with('success', 'Your reservation has been created successfully.'); */
        return redirect()->to('user/transaksi')->with('success', 'Your reservation has been created successfully.');
    }

    public function updatePaymentStatus($id_payment)
    {
        $paymentModel = new PaymentModel();

        // Ambil data pembayaran berdasarkan nilai unik ($id_payment)
        $payment = $paymentModel->where('id_payment', $id_payment)->first();

        if (!$payment) {
            return redirect()->to('payment/transaction')->with('error', 'Pembayaran tidak ditemukan.');
        }

        // Cek prefix id_payment untuk menentukan status baru
        $newStatus = '';
        if (strpos($id_payment, 'PAY-') === 0) {
            $newStatus = 'PAID';
        } elseif (strpos($id_payment, 'PAYDP-') === 0) {
            $newStatus = 'Pembayaran DP';
        }

        // Perbarui status pembayaran jika ada prefix yang cocok
        if ($newStatus) {
            $updatedData = [
                'status' => $newStatus,
            ];
            $paymentModel->update($payment['id'], $updatedData);
        }

        // Alihkan dengan pesan keberhasilan
        return redirect()->to('payment/transaction')->with('success', 'Status pembayaran berhasil diperbarui.');
    }


    public function updatePaymentReject($id_payment)
    {
        $paymentModel = new PaymentModel();

        // Fetch the payment data based on the unique identifier ($id_payment)
        $payment = $paymentModel->where('id_payment', $id_payment)->first();

        if (!$payment) {
            return redirect()->to('payment/transaction')->with('error', 'Payment not found.');
        }

        // Update the payment status to 'Ditolak'
        $updatedData = [
            'status' => 'Ditolak',
        ];

        $paymentModel->update($payment['id'], $updatedData);

        // Redirect with success message
        return redirect()->to('payment/transaction')->with('success', "Payment status updated to 'Ditolak' successfully.");
    }



    public function generatePdf()
    {
        // Query data dari database
        $payment = $this->paymentModel->findAll();

        // Buat objek DOMPDF baru
        $dompdf = new Dompdf();

        // Buat template HTML untuk PDF
        $html = '<h1 style="text-align: center;">Data Laporan Product</h1>';
        $html .= '<table style="width: 100%; border-collapse: collapse; margin: 0 auto;">';
        $html .= '<thead>';
        $html .= '<tr>';
        $html .= '<th style="border: 1px solid #000; padding: 8px; border-top-left-radius: 8px;">No</th>';
        $html .= '<th style="border: 1px solid #000; padding: 8px;">ID Transaction</th>';
        $html .= '<th style="border: 1px solid #000; padding: 8px;">Nama Package</th>';
        $html .= '<th style="border: 1px solid #000; padding: 8px;">Harga</th>';
        $html .= '<th style="border: 1px solid #000; padding: 8px;">Lokasi</th>';
        $html .= '<th style="border: 1px solid #000; padding: 8px;">Reservation Date</th>';
        $html .= '<th style="border: 1px solid #000; padding: 8px;">Status</th>';
        $html .= '<th style="border: 1px solid #000; padding: 8px; border-top-right-radius: 8px;">Payment Date</th>';
        $html .= '</tr>';
        $html .= '</thead>';
        $html .= '<tbody>';

        $no = 1;
        foreach ($payment as $lp) {
            $html .= '<tr>';
            $html .= '<td style="border: 1px solid #000; padding: 8px;">' . $no . '</td>';
            $html .= '<td style="border: 1px solid #000; padding: 8px;">' . $lp['id_payment'] . '</td>';
            $buku = $this->productModel->find($lp['transaksi_id']);
            if ($buku) {
                $html .= '<td style="border: 1px solid #000; padding: 8px;">' . $buku['nama_produk'] . '</td>';
            } else {
                $html .= '<td style="border: 1px solid #000; padding: 8px;"></td>';
            }
            $html .= '<td style="border: 1px solid #000; padding: 8px;">' . $lp['total_payment'] . '</td>';
            $rr = $this->reservationModel->find($lp['reservation_id']);
            if ($rr) {
                $html .= '<td style="border: 1px solid #000; padding: 8px;">' . $rr['lokasi'] . '</td>';
                $html .= '<td style="border: 1px solid #000; padding: 8px;">' . $rr['tgl_acara'] . '</td>';
            } else {
                $html .= '<td style="border: 1px solid #000; padding: 8px;"></td>';
                $html .= '<td style="border: 1px solid #000; padding: 8px;"></td>';
            }
            $html .= '<td style="border: 1px solid #000; padding: 8px;">' . $lp['status'] . '</td>';
            $html .= '<td style="border: 1px solid #000; padding: 8px;">' . $lp['payment_date'] . '</td>';
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
        file_put_contents('laporan_transaction.pdf', $output);

        // Unduh file PDF
        header('Content-Type: application/pdf');
        header('Content-Disposition: attachment; filename="laporan_transaction.pdf"');
        readfile('laporan_transaction.pdf');
        exit();
    }

    /* public function generateSpreadsheet()
    {
        // Create an instance of the ProductModel
        $productModel = new ProductModel();

        // Query data from the database
        $produk = $productModel->findAll();

        // Create a new Spreadsheet instance
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Set column headers
        $sheet->setCellValue('A1', 'No');
        $sheet->setCellValue('B1', 'ID Product');
        $sheet->setCellValue('C1', 'Nama Product');
        $sheet->setCellValue('D1', 'Description');
        $sheet->setCellValue('E1', 'Harga');

        // Fill data rows
        $no = 1;
        $row = 2;
        foreach ($produk as $produk_item) {
            $sheet->setCellValue('A' . $row, $no);
            $sheet->setCellValue('B' . $row, $produk_item['id_produk']);
            $sheet->setCellValue('C' . $row, $produk_item['nama_produk']);
            $sheet->setCellValue('D' . $row, $produk_item['description']);
            $sheet->setCellValue('E' . $row, $produk_item['harga_produk']);
            $no++;
            $row++;
        }

        // Create Excel file
        $writer = new Xlsx($spreadsheet);

        // Generate a temporary file path
        $tempFilePath = WRITEPATH . 'temp/' . 'laporan_product.xlsx';

        // Save the file to the temporary path
        $writer->save($tempFilePath);

        // Set the response
        $response = $this->response->download($tempFilePath, null)->setFileName('laporan_product.xlsx')->setContentType('application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');

        // Delete the temporary file
        unlink($tempFilePath);

        return $response;
    } */

    public function generateSpreadsheet()
    {
        // Query data from the database
        $payments = $this->db->table('payment')
        ->select('payment.id as paymentsid, payment.id_payment, payment.reservation_id, payment.transaksi_id, payment.payment_receipt, payment.user_id, payment.total_payment, payment.payment_date,payment.status,payment_updated, reservation.tgl_acara,reservation.lokasi, transaksi.id_transaksi, transaksi.total_harga, transaksi.produk_id,product.nama_produk,product.description,product.photos_filenames,product.harga_produk,user_produk.nama,user_produk.foto,user_produk.lokasi,user_produk.jenis_kelamin,user_produk.telepon')
        ->join('reservation', 'reservation.id = payment.reservation_id', 'left')
            ->join('transaksi', 'transaksi.id = payment.transaksi_id', 'left')
            ->join('product', 'product.id = transaksi.produk_id', 'left')
            ->join('users as user_produk', 'user_produk.id = product.user_id', 'left')
            ->orderBy('payment.payment_date', 'DESC')
            ->get()
            ->getResultArray();

        // Create a new Spreadsheet instance
        $spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Set column headers
        $sheet->setCellValue('A1', 'No');
        $sheet->setCellValue('B1', 'ID Transaction');
        $sheet->setCellValue('C1', 'Nama Package');
        $sheet->setCellValue('D1', 'Harga');
        $sheet->setCellValue('E1', 'Lokasi');
        $sheet->setCellValue('F1', 'Status');
        $sheet->setCellValue('G1', 'Reservation Date');
        $sheet->setCellValue('H1', 'Payment Date');

        // Fill data rows
        $no = 1;
        $row = 2;
        foreach ($payments as $payment_item) {
            $sheet->setCellValue('A' . $row, $no);
            $sheet->setCellValue('B' . $row, $payment_item['id_payment']);
            $sheet->setCellValue('C' . $row, $payment_item['nama_produk']);
            $sheet->setCellValue('D' . $row, $payment_item['total_payment']);
            $sheet->setCellValue('E' . $row, $payment_item['lokasi']);
            /* if ($payment_item['status'] === 'PAID') {
                if ($payment_item['payment_updated'] !== null) {
                    $sheet->setCellValue('F' . $row, 'PAID');
                    $sheet->setCellValue('H' . $row, $payment_item['payment_updated']);
                } else {
                    $sheet->setCellValue('F' . $row, 'Pembayaran DP');
                    $sheet->setCellValue('H' . $row, $payment_item['payment_date']);
                }
            } else {
                $sheet->setCellValue('F' . $row, $payment_item['status']);
                $sheet->setCellValue('H' . $row, $payment_item['payment_date']);
            } */
            if ($payment_item['status'] === 'PAID') {
                if ($payment_item['payment_updated'] !== null) {
                    $sheet->setCellValue('F' . $row, 'PAID');
                    $sheet->setCellValue('H' . $row, $payment_item['payment_updated']);
                } else {
                    $sheet->setCellValue('F' . $row, 'PAID');
                    $sheet->setCellValue('H' . $row, $payment_item['payment_date']);
                }
            } elseif ($payment_item['status'] === 'DP') {
                $sheet->setCellValue('F' . $row, 'Pembayaran DP');
                $sheet->setCellValue('H' . $row, $payment_item['payment_date']);
            } else {
                $sheet->setCellValue('F' . $row, $payment_item['status']);
                $sheet->setCellValue('H' . $row, $payment_item['payment_date']);
            }
            $sheet->setCellValue('G' . $row, $payment_item['tgl_acara']);
            $no++;
            $row++;
        }

        // Create Excel file
        $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);

        // Define the file path
        $filePath = FCPATH . 'public/writable/temp/laporan_transaction.xlsx';

        // Ensure the directory exists, if not, create it
        if (!is_dir(dirname($filePath))) {
            mkdir(dirname($filePath), 0777, true);
        }

        // Save the file to the specified path
        $writer->save($filePath);

        // Set appropriate headers for download
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="laporan_transaction.xlsx"');
        header('Content-Length: ' . filesize($filePath));
        readfile($filePath);
        exit;
    }

    public function generateCsv()
    {
        // Query data from the database
        $payments = $this->db->table('payment')
        ->select('payment.id as paymentsid, payment.id_payment, payment.reservation_id,payment_updated, payment.transaksi_id, payment.payment_receipt, payment.user_id, payment.total_payment, payment.payment_date,payment.status, reservation.tgl_acara,reservation.lokasi, transaksi.id_transaksi, transaksi.total_harga, transaksi.produk_id,product.nama_produk,product.description,product.photos_filenames,product.harga_produk,user_produk.nama,user_produk.foto,user_produk.lokasi,user_produk.jenis_kelamin,user_produk.telepon')
        ->join('reservation', 'reservation.id = payment.reservation_id', 'left')
        ->join('transaksi', 'transaksi.id = payment.transaksi_id', 'left')
        ->join('product', 'product.id = transaksi.produk_id', 'left')
        ->join('users as user_produk', 'user_produk.id = product.user_id', 'left')
        ->orderBy('payment.payment_date', 'DESC')
        ->get()
            ->getResultArray();

        // Prepare CSV data
        $csvData = [];
        $csvData[] = ['No', 'ID Transaction', 'Nama Package', 'Harga', 'Lokasi','Status','Reservation Date','Payment Date','Payment Updated'];

        $no = 1;
        foreach ($payments as $produk_item) {
            $csvData[] = [
                $no,
                $produk_item['id_payment'],
                $produk_item['nama_produk'],
                $produk_item['total_payment'],
                $produk_item['lokasi'],
                $produk_item['status'],
                $produk_item['tgl_acara'],
                $produk_item['payment_date'],
                $produk_item['payment_updated'],
            ];
            $no++;
        }

        // Set the response header for CSV download
        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="laporan_transaction.csv"');

        // Output CSV data directly
        $output = fopen('php://output', 'w');
        foreach ($csvData as $row) {
            fputcsv($output, $row);
        }
        fclose($output);
    }

    /* Menampilkan data Payment per user id atau sesuai yang login*/

    /* // Set your Midtrans server key
        Config::$serverKey = 'SB-Mid-server-KGJ8_8kepWGli0XcAaGJ0xa7';
        // Set to Development/Sandbox environment (change to false for production)
        Config::$isProduction = false;

        // Generate payment token using Midtrans Snap API
        $paymentToken = Snap::getSnapToken([
            'transaction_details' => [
                'order_id' => $paymentData['id_payment'], // Use your own order_id
                'gross_amount' => $totalHarga, // Use the total_harga as the gross_amount
            ],
            'item_details' => [
                [
                    'id' => $reservation['id'], // Use the reservation_id as the item_id
                    'price' => $totalHarga, // Use the total_harga as the item price
                    'quantity' => 1,
                    'name' => 'Reservation Payment',
                ],
            ],
            'customer_details' => [
                'first_name' => $userData['first_name'],
                'last_name' => $userData['last_name'],
                'email' => $userData['email'],
                'phone' => $userData['phone'],
            ],
        ]);

        // Redirect to Midtrans payment page using the payment token
        return redirect()->to('https://app.sandbox.midtrans.com/snap/v1/transactions/' . $paymentToken); */

    /* public function paid($id = 0)
    {
        // Validate if the user has completed their profile details
        $userData = user()->toArray();
        if (!$this->isProfileComplete($userData)) {
            return redirect()->to('user/setting')->with('error', 'Please complete your profile details before making a reservation.');
        }

        // Check if the reservation exists and get the reservation data
        $reservation = $this->reservationModel->find($id);
        if (!$reservation) {
            return redirect()->to('payment/error-page')->with('error', 'Reservation not found.');
        }

        // Fetch the corresponding transaksi data using the transaksi_id from the reservation
        $transaksi = $this->transaksiModel->find($reservation['transaksi_id']);
        if (!$transaksi) {
            return redirect()->to('payment/error-page')->with('error', 'Transaksi not found.');
        }

        // Get the 'total_harga' from the 'transaksi' table
        $totalHarga = $transaksi['total_harga'];

        // Save the payment detail into the database
        $user_id = user()->id;
        $paymentData = [
            'id_payment' => 'PAY-' . uniqid(), // Generate the payment ID for DP
            'total_payment' =>  $totalHarga, // Save the DP amount as total_payment
            'user_id' => $user_id,
            'status' => 'PAID', // Set the status to 'Pembayaran DP'
            'transaksi_id' => $transaksi['id'], // Use the correct primary key for transaksi
            'reservation_id' => $reservation['id'], // Use the correct primary key for reservation
            'payment_date' => date('Y-m-d H:i:s'),
        ];
        $this->paymentModel->insert($paymentData);

        // Save the id_payment in session
        session()->set(
            'id_payment',
            $paymentData['id_payment']
        );
        // Redirect to the reservation page or any other success page
        return redirect()->to('payment/invoice/' . $paymentData['id_payment'])->with('success', 'Your reservation has been created successfully.');
    } */

    // Controller for the "Continue Payment" page
    /*  public function continuePayment($id_payment)
    {
        // Find the payment data by id_payment
        $payment = $this->paymentModel->where('id_payment', $id_payment)->first();

        if (!$payment) {
            return redirect()->to('payment/error-page')->with('error', 'Payment not found.');
        }

        // Fetch the reservation data using reservation_id
        $reservation = $this->reservationModel->find($payment['reservation_id']);

        if (!$reservation) {
            return redirect()->to('payment/error-page')->with('error', 'Reservation not found.');
        }

        // Check if it's time to perform the remaining payment
        $eventDate = new Carbon($reservation['tgl_acara']);
        $currentDate = Carbon::now();

        // Add 1 month to the event date
        $eventDate->addMonth();

        if ($currentDate >= $eventDate) {
            // Update the payment data for remaining payment
            $dpAmount = $payment['total_harga'] * 0.3;
            $remainingPayment = $payment['total_harga'] - $dpAmount;

            // Set the status to 'Lakukan Pelunasan'
            $payment->total_payment = $remainingPayment;
            $payment->status = 'Lakukan Pelunasan';
            $payment->payment_updated = date('Y-m-d H:i:s');
            $payment->save();

            return view('payment/continue_payment', ['payment' => $payment]);
        }

        // If it's not time to perform the remaining payment, redirect back with an error message
        return redirect()->back()->with('error', 'It is not yet time to perform the remaining payment.');
    } */

    public function continuePayment($id_payment)
    {
        // Find the payment data by id_payment
        $payment = $this->paymentModel->where('id_payment', $id_payment)->first();

        if (!$payment) {
            return redirect()->to('payment/error-page')->with('error', 'Payment not found.');
        }

        // Fetch the reservation data using reservation_id
        $reservation = $this->reservationModel->find($payment['reservation_id']);

        if (!$reservation) {
            return redirect()->to('payment/error-page')->with('error', 'Reservation not found.');
        }

        // Calculate the event date + 3 days
        $eventDate = new Carbon($reservation['tgl_acara']);
        $eventDate->addDays(3);

        $currentDate = Carbon::now();

        if ($currentDate >= $eventDate) {
            // Update the payment data for remaining payment
            $dpAmount = $payment['total_harga'] * 0.3;
            $remainingPayment = $payment['total_harga'] - $dpAmount;

            // Set the status to 'Lakukan Pelunasan'
            $payment->total_payment = $remainingPayment;
            $payment->status = 'Lakukan Pelunasan';
            $payment->payment_updated = date('Y-m-d H:i:s');
            $payment->save();

            return view('payment/continue_payment', ['payment' => $payment]);
        }

        // If it's not time to perform the remaining payment, redirect back with an error message
        return redirect()->back()->with('error', 'It is not yet time to perform the remaining payment.');
    }

    // Controller for the "Pay Remaining Payment" page
    public function payRemainingPayment($id_payment)
    {
        // Find the payment data by id_payment
        $payment = $this->paymentModel->where('id_payment', $id_payment)->first();

        if (!$payment) {
            return redirect()->to('payment/error-page')->with('error', 'Payment not found.');
        }

        // Update the payment data for remaining payment
        $payment->total_payment = $payment['total_harga'];
        $payment->status = 'Paid'; // Set the status to 'Paid' since the full payment is done
        $payment->save();

        return redirect()->to('payment/invoice/' . $id_payment)->with('success', 'Your remaining payment has been completed successfully.');
    }

    public function invoice($id_payment)
    {
        $data = [
            'title' => 'Invoice',
        ];

        // Perform the LEFT JOIN with reservation_detail and users tables
        $this->builder = $this->db->table('payment');
        $this->builder->select('payment.id as paymentid,payment.id_payment,payment.user_id,payment.transaksi_id, payment.reservation_id, payment.payment_date,payment.total_payment,payment.status,transaksi.produk_id,transaksi.menu_id,transaksi.user_id as transaksi_user_id,transaksi.id_transaksi, product.nama_produk, product.description, product.user_id as produk_user_id,product.harga_produk,product.photos_filenames, kategori.nama_menu, kategori.deskripsi, users.username as payment_username, users.email as payment_email, users.nama as payment_nama, users.foto as payment_foto, users.jenis_kelamin as payment_gender, users.telepon as payment_telepon, users.lokasi as payment_lokasi, product_users.username as product_username,product_users.nama as product_nama,product_users.foto as product_foto,product_users.lokasi as product_lokasi,product_users.telepon as product_telepon,,product_users.email as product_email');
        $this->builder->join('transaksi', 'transaksi.id = payment.transaksi_id', 'left'); // Use 'left' for LEFT JOIN
        $this->builder->join('reservation', 'reservation.id = payment.reservation_id', 'left'); // Use 'left' for LEFT JOIN
        $this->builder->join('kategori', 'kategori.id = transaksi.menu_id', 'left'); // Use 'left' for LEFT JOIN
        $this->builder->join('product', 'product.id = transaksi.produk_id', 'left'); // Use 'left' for LEFT JOIN
        $this->builder->join('users', 'users.id = payment.user_id', 'left'); // Use 'left' for LEFT JOIN
        $this->builder->join('users as product_users', 'product_users.id = product.user_id', 'left'); // Use 'left' for LEFT JOIN

        // Fetch the payment data by 'id_payment'
        $this->builder->where('payment.id_payment', $id_payment); // Use 'payment.id_payment' here instead of 'transaksi.id'

        // Get the first row from the result set
        $payment = $this->builder->get()->getRowArray();

        if (!$payment) {
            return redirect()->to('payment/error-page')->with('error', 'Payment not found.');
        }

        // Pass the payment data to the view
        $data['payment'] = $payment;

        // Load the invoice view to display the payment details
        return view('payment/invoice', $data);
    }



    public function dp($id = 0)
    {
        $data = [
            'title' => 'Down Payment',
        ];

        // Perform the LEFT JOIN with reservation_detail and users tables
        $this->builder = $this->db->table('reservation');
        $this->builder->select('reservation.id as reservationid, reservation.user_id, reservation.transaksi_id, reservation.user_id, reservation.tgl_acara,reservation.lokasi,reservation.status,transaksi.produk_id,transaksi.menu_id,transaksi.user_id as transaksi_user_id,transaksi.total_harga,transaksi.id_transaksi, product.nama_produk, product.description, product.user_id as produk_user_id,product.harga_produk,product.photos_filenames, kategori.nama_menu, kategori.deskripsi, users.username as reservation_username, users.email as reservation_email, users.nama as reservation_nama, users.foto as reservation_foto, users.jenis_kelamin as reservation_gender, users.telepon as reservation_telepon, users.lokasi as reservation_lokasi, product_users.username as product_username,product_users.nama as product_nama,product_users.foto as product_foto,product_users.lokasi as product_lokasi,product_users.foto as product_foto');
        $this->builder->join('transaksi', 'transaksi.id = reservation.transaksi_id', 'left'); // Use 'left' for LEFT JOIN
        $this->builder->join('kategori', 'kategori.id = transaksi.menu_id', 'left'); // Use 'left' for LEFT JOIN
        $this->builder->join('product', 'product.id = transaksi.produk_id', 'left'); // Use 'left' for LEFT JOIN
        $this->builder->join('users', 'users.id = reservation.user_id', 'left'); // Use 'left' for LEFT JOIN
        $this->builder->join('users as product_users', 'product_users.id = product.user_id', 'left'); // Use 'left' for LEFT JOIN

        // Fetch the reservation data with user names for the given $id
        $this->builder->where('transaksi.id', $id);
        $reservation = $this->builder->get()->getRowArray();

        // Check if the reservation exists
        if (!$reservation) {
            // Redirect to some error page or show an error message
            return redirect()->to('payment/error-page');
        }

        // Pass the reservation data to the view
        $data['reservation'] = $reservation;

        return view('payment/dp', $data);
    }

    private function isProfileComplete($userData)
    {
        // Implement your logic to check if the user profile is complete
        // For example, check if all required fields in the user's profile are filled in
        return !empty($userData['nama']) && !empty($userData['jenis_kelamin']) && !empty($userData['telepon']) && !empty($userData['lokasi']);
    }
}
