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
        $this->builder = $this->db->table('users');
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
            return redirect()->to('login');
        }
        // Menambahkan informasi nama pengguna ke dalam data
        $data['user'] = $user;

        $userId = $user->id;

        $payments = $this->db->table('payment')
        ->select('payment.id as paymentid, payment.id_payment, payment.reservation_id, payment.transaksi_id, payment.payment_receipt, payment.user_id, payment.total_payment, payment.payment_date,payment.status, reservation.tgl_acara,reservation.lokasi,payment.payment_receipt, transaksi.id_transaksi, transaksi.total_harga, transaksi.produk_id,product.nama_produk,product.description,product.photos_filenames,user_produk.nama,user_produk.foto,user_produk.lokasi,user_produk.jenis_kelamin,user_produk.telepon')
        ->join('reservation', 'reservation.id = payment.reservation_id', 'left')
        ->join('transaksi', 'transaksi.id = payment.transaksi_id', 'left')
        ->join('product', 'product.id = transaksi.produk_id', 'left')
        ->join('users as user_produk', 'user_produk.id = product.user_id', 'left')
        ->where('payment.user_id', $userId)
            ->orderBy('payment.payment_date', 'DESC')
            ->get()
            ->getResultArray();

        $reservation = $this->db->table('reservation')
        ->select('reservation.id as reservationid, reservation.tgl_acara,reservation.user_id,reservation.lokasi, transaksi.id_transaksi, transaksi.total_harga, transaksi.produk_id,product_transaksi.nama_produk,product_transaksi.description,product_transaksi.photos_filenames,user_produk.nama,user_produk.foto,user_produk.lokasi,user_produk.jenis_kelamin,user_produk.telepon')
        ->join('transaksi', 'transaksi.id = reservation.transaksi_id', 'left')
        ->join('product as product_transaksi', 'product_transaksi.id = transaksi.produk_id', 'left')
        ->join('users as user_produk', 'user_produk.id = product_transaksi.user_id', 'left')
        ->where('reservation.user_id', $userId)
            ->orderBy('reservation.tgl_acara', 'DESC')
            ->get()
            ->getResultArray();

        $data['payments'] = $payments;
        $data['reservation'] = $reservation;

        return view('user/setting', $data);
    }

    public function reservations()
    {
        $data = [
            'title' => 'Reservation',
        ];

        $user = $this->userModel->where('id', user_id())->first();

        if (!$user) {
            return redirect()->to('login');
        }
        // Menambahkan informasi nama pengguna ke dalam data
        $data['user'] = $user;

        $userId = $user->id;

        $payments = $this->db->table('payment')
        ->select('payment.id as paymentid, payment.id_payment, payment.reservation_id, payment.transaksi_id, payment.payment_receipt, payment.user_id, payment.total_payment, payment.payment_date,payment.status, reservation.tgl_acara,reservation.lokasi,payment.payment_receipt, transaksi.id_transaksi, transaksi.total_harga, transaksi.produk_id,product.nama_produk,product.description,product.photos_filenames,user_produk.nama,user_produk.foto,user_produk.lokasi,user_produk.jenis_kelamin,user_produk.telepon')
        ->join('reservation', 'reservation.id = payment.reservation_id', 'left')
        ->join('transaksi', 'transaksi.id = payment.transaksi_id', 'left')
        ->join('product', 'product.id = transaksi.produk_id', 'left')
        ->join('users as user_produk', 'user_produk.id = product.user_id', 'left')
        ->where('payment.user_id', $userId)
            ->orderBy('payment.payment_date', 'DESC')
            ->get()
            ->getResultArray();

        $reservation = $this->db->table('reservation')
        ->select('reservation.id as reservationid, reservation.tgl_acara,reservation.user_id,reservation.lokasi, transaksi.id_transaksi, transaksi.total_harga, transaksi.produk_id,product_transaksi.nama_produk,product_transaksi.description,product_transaksi.photos_filenames,user_produk.nama,user_produk.foto,user_produk.lokasi,user_produk.jenis_kelamin,user_produk.telepon')
        ->join('transaksi', 'transaksi.id = reservation.transaksi_id', 'left')
        ->join('product as product_transaksi', 'product_transaksi.id = transaksi.produk_id', 'left')
        ->join('users as user_produk', 'user_produk.id = product_transaksi.user_id', 'left')
        ->where('reservation.user_id', $userId)
            ->orderBy('reservation.tgl_acara', 'DESC')
            ->get()
            ->getResultArray();

        $data['payments'] = $payments;
        $data['reservation'] = $reservation;

        return view('user/reservation', $data);
    }

    public function transaksi()
    {
        $data = [
            'title' => 'Reservation',
        ];

        $user = $this->userModel->where('id', user_id())->first();

        if (!$user) {
            return redirect()->to('login');
        }
        // Menambahkan informasi nama pengguna ke dalam data
        $data['user'] = $user;

        $userId = $user->id;

        $payments = $this->db->table('payment')
        ->select('payment.id as paymentid, payment.id_payment, payment.reservation_id, payment.transaksi_id, payment.payment_receipt, payment.user_id, payment.total_payment, payment.payment_date,payment.status, reservation.tgl_acara,reservation.lokasi,payment.payment_receipt, transaksi.id_transaksi, transaksi.total_harga, transaksi.produk_id,product.nama_produk,product.description,product.photos_filenames,user_produk.nama,user_produk.foto,user_produk.lokasi,user_produk.jenis_kelamin,user_produk.telepon')
        ->join('reservation', 'reservation.id = payment.reservation_id', 'left')
        ->join('transaksi', 'transaksi.id = payment.transaksi_id', 'left')
        ->join('product', 'product.id = transaksi.produk_id', 'left')
        ->join('users as user_produk', 'user_produk.id = product.user_id', 'left')
        ->where('payment.user_id', $userId)
            ->orderBy('payment.payment_date', 'DESC')
            ->get()
            ->getResultArray();

        $reservation = $this->db->table('reservation')
        ->select('reservation.id as reservationid, reservation.tgl_acara,reservation.user_id,reservation.lokasi, transaksi.id_transaksi, transaksi.total_harga, transaksi.produk_id,product_transaksi.nama_produk,product_transaksi.description,product_transaksi.photos_filenames,user_produk.nama,user_produk.foto,user_produk.lokasi,user_produk.jenis_kelamin,user_produk.telepon')
        ->join('transaksi', 'transaksi.id = reservation.transaksi_id', 'left')
        ->join('product as product_transaksi', 'product_transaksi.id = transaksi.produk_id', 'left')
        ->join('users as user_produk', 'user_produk.id = product_transaksi.user_id', 'left')
        ->where('reservation.user_id', $userId)
            ->orderBy('reservation.tgl_acara', 'DESC')
            ->get()
            ->getResultArray();

        $data['payments'] = $payments;
        $data['reservation'] = $reservation;

        return view('user/transaksi', $data);
    }

    /* public function sendVerificationEmail($to, $token)
    {
        $email = \Config\Services::email();

        $email->setFrom('your@email.com', 'Your Name');
        $email->setTo($to);

        $email->setSubject('Email Verification');

        $message = "Please click the link below to verify your email:\n\n";
        $message .= site_url('user/verify_email/' . $token); // Ganti dengan URL verifikasi email Anda

        $email->setMessage($message);

        return $email->send();
    } */

    // Email sending logic
    /*  private function sendVerificationEmail($to, $token)
    {
        $email = \Config\Services::email();

        $email->setFrom('your@example.com', 'Your Name');
        $email->setTo($to);

        $email->setSubject('Email Verification');
        $email->setMessage('Your verification code: ' . $token);

        if ($email->send()) {
            return true;
        } else {
            return false;
        }
    } */

    public function update_name()
    {
        $user = user();

        if (!$user) {
            return redirect()->to('login');
        }

        $newName = $this->request->getPost('nama');

        if ($newName !== $user->nama) {
            $updatedData = [
                'nama' => $newName,
                'updated_at' => date('Y-m-d H:i:s') // Tambahkan created_at saat memperbarui
            ];

            $this->userModel->update($user->id, $updatedData);

            return redirect()->to('user/setting')->with('success', 'Name updated successfully.' .'in account '. $user->nama);
        }

        return redirect()->to('user/setting')->with('error', 'No changes made names .' . $user->nama . ' in account ' . $user->nama); // Set session key 'no_changes'
    }


    public function update_email()
    {
        // Ambil informasi user yang sedang login
        $user = user();

        if (!$user) {
            return redirect()->to('login');
        }

        $userId = $user->id;

        // Rules validasi
        $validationRules = [
            'email' => [
                'rules' => "required|valid_email|is_unique[users.email,id,$userId]",
                'errors' => [
                    'is_unique' => 'Email already exists.'
                ]
            ]
        ];

        $validation = \Config\Services::validation();
        $validation->setRules($validationRules);

        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->to('user/setting')->with('error', $validation->listErrors());
        }

        $newEmail = $this->request->getPost('email');

        // Check if email is unique and changed
        if ($newEmail !== $user->email) {
            $dataToUpdate = [
                'email' => $newEmail,
                'updated_at' => date('Y-m-d H:i:s'),
            ];
            $this->userModel->update($userId, $dataToUpdate);

            return redirect()->to('user/setting')->with('success', 'Email updated successfully.');
        } else {
            return redirect()->to('user/setting')->with('error', 'No changes made at data . ' . $user->email . ' in account ' . $user->nama);
        }
    }

    public function update_telepon()
    {
        $newTelepon = $this->request->getPost('telepon');

        // Ambil informasi user yang sedang login
        $user = user();

        if (!$user) {
            return redirect()->to('login');
        }

        $userId = $user->id;

        // Cek apakah terdapat perubahan pada lokasi
        if ($newTelepon !== $user->telepon) {
            // Update lokasi jika ada perubahan
            $dataToUpdate = [
                'telepon' => $newTelepon,
                'updated_at' => date('Y-m-d H:i:s'),
            ];

            $this->userModel->update($userId, $dataToUpdate);

            return redirect()->to('user/setting')->with('success',
                'Telepon updated successfully.'
            );
        }

        return redirect()->to('user/setting')->with('error', 'No changes made at data phones . ' . $user->telepon. ' in account ' . $user->nama);
    }

    public function update_foto()
    {
        $photo = $this->request->getFile('foto');

        // Ambil informasi user yang sedang login
        $user = user();

        if (!$user) {
            return redirect()->to('login');
        }

        $userId = $user->id;

        if ($photo->isValid() && !$photo->hasMoved()) {
            // Validasi ukuran dan tipe file
            if ($photo->getSize() > 10000000 || !in_array($photo->getExtension(), ['jpg', 'jpeg', 'png'])) {
                return redirect()->to('user/setting')->with('error', 'Invalid file. Maximum file size: 10 Megabytes. Allowed extensions: .JPG .JPEG .PNG.');
            }

            $newFileName = $photo->getRandomName();
            $photo->move('./uploads', $newFileName);

            // Update foto pengguna
            $dataToUpdate = [
                'foto' => $newFileName,
                'updated_at' => date('Y-m-d H:i:s'),
            ];

            $this->userModel->update($userId, $dataToUpdate);

            // Delete the old photo if it exists
            if ($user->foto !== 'default.svg' && file_exists('./images/' . $user->foto)) {
                unlink('./images/' . $user->foto);
            }

            return redirect()->to('user/setting')->with('success', 'Foto updated successfully.');
        } elseif ($photo->getError() === UPLOAD_ERR_NO_FILE) {
            // Jika tidak ada perubahan foto
            return redirect()->to('user/setting')->with('error', 'No Changes Made Photo Profile in account '. $user->nama);
        } else {
            return redirect()->to('user/setting')->with('error', 'An error occurred while uploading the photo.');
        }
    }

    public function update_lokasi()
    {
        $newLokasi = $this->request->getPost('lokasi');

        // Ambil informasi user yang sedang login
        $user = user();

        if (!$user) {
            return redirect()->to('login');
        }

        $userId = $user->id;

        // Cek apakah terdapat perubahan pada lokasi
        if ($newLokasi !== $user->lokasi) {
            // Update lokasi jika ada perubahan
            $dataToUpdate = [
                'lokasi' => $newLokasi,
                'updated_at' => date('Y-m-d H:i:s'),
            ];

            $this->userModel->update($userId, $dataToUpdate);
            return redirect()->to('user/setting')->with('success', 'Lokasi updated successfully.');
        }

        return redirect()->to('user/setting')->with('error', 'No changes made. ' . $user->lokasi. ' in account ' . $user->nama);
    }

    public function update_gender()
    {
        $newGender = $this->request->getPost('jenis_kelamin');

        // Ambil informasi user yang sedang login
        $user = user();

        if (!$user) {
            return redirect()->to('login');
        }

        $userId = $user->id;

        // Cek apakah terdapat perubahan pada jenis kelamin
        if ($newGender !== $user->jenis_kelamin) {
            // Update jenis kelamin jika ada perubahan
            $dataToUpdate = [
                'jenis_kelamin' => $newGender,
                'updated_at' => date('Y-m-d H:i:s'),
            ];

            $this->userModel->update($userId, $dataToUpdate);
            return redirect()->to('user/setting')->with('success', 'Jenis kelamin updated successfully.');
        }

        return redirect()->to('user/setting')->with('error', 'No changes made Gender . ' .$user->jenis_kelamin .' in account '. $user->nama);
    }

    public function update_profile()
    {
        // Ambil informasi user yang sedang login
        $user = user(); // Menggunakan fungsi user() dari Myth:Auth

        if (!$user) {
            return redirect()->to('login');
        }

        $userId = $user->id; // Mengambil ID pengguna dari user()
        $nama = $this->request->getPost('nama');
        $email = $this->request->getPost('email');
        $jenis_kelamin = $this->request->getPost('jenis_kelamin');
        $lokasi = $this->request->getPost('lokasi');
        $telepon = $this->request->getPost('telepon');

        // Validasi input
        $validationRules = [
            'nama' => 'required',
            'email' => 'required|valid_email',
            'jenis_kelamin' => 'required',
            'lokasi' => 'required',
            'telepon' => 'required',
        ];

        if ($email !== $user->email) {
            $validationRules['email'] .= '|is_unique[users.email]';
        }

        $validation = \Config\Services::validation();
        $validation->setRules($validationRules);

        if (!$validation->run()) {
            return redirect()->to('user/setting')->with('error', $validation->listErrors());
        }

        // Update email if changed
        if ($email !== $user->email) {
            $this->userModel->update($userId, ['email' => $email]);
        }

        // Update other fields
        $dataToUpdate = [
            'nama' => $nama,
            'jenis_kelamin' => $jenis_kelamin,
            'lokasi' => $lokasi,
            'telepon' => $telepon,
        ];

        $this->userModel->update($userId, $dataToUpdate);

        // Upload gambar dengan nama acak jika ada perubahan foto
        $photo = $this->request->getFile('foto');

        if ($photo->isValid() && !$photo->hasMoved()) {
            $newFileName = $photo->getRandomName();
            $photo->move('./uploads', $newFileName);

            // Update the user's profile photo
            $dataToUpdate = [
                'foto' => $newFileName,
            ];

            $this->userModel->update($userId, $dataToUpdate);

            // Delete the old photo if it exists
            if ($user->foto !== 'default.svg' && file_exists('./images/' . $user->foto)) {
                unlink('./images/' . $user->foto);
            }
        }

        return redirect()->to('user/setting')->with('success', 'Profile updated successfully.');
    }



    private function Reservation()
    {
        $user = $this->userModel->where('id', user_id())->first();

        if (!$user) {
            return redirect()->to('user/login');
        }

        $userId = $user->id;

        $reservation = $this->db->table('reservation')
        ->select('reservation.id as reservationid, reservation.tgl_acara,reservation.user_id,reservation.lokasi, transaksi.id_transaksi, transaksi.total_harga, transaksi.produk_id,product_transaksi.nama_produk,product_transaksi.description,product_transaksi.photos_filenames,user_produk.nama,user_produk.foto,user_produk.lokasi,user_produk.jenis_kelamin,user_produk.telepon')
        ->join('reservation', 'reservation.id = payment.reservation_id', 'left')
        ->join('transaksi', 'transaksi.id = payment.transaksi_id', 'left')
        ->join('product as product_transaksi', 'product_transaksi.id = transaksi.produk_id', 'left')
        ->join('users as user_produk', 'user_produk.id = product.user_id', 'left')
        ->where('reservation.user_id', $userId)
            ->orderBy('reservation.tgl_acara', 'DESC')
            ->get()
            ->getResultArray();

        $data['reservation'] = $reservation;

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
