<?php

// app/Controllers/ProductController.php
namespace App\Controllers;


use App\Models\ProductModel;
use App\Models\MenuModel;
use App\Models\CategoriesModel;
use Myth\Auth\Models\UserModel;
use Myth\Auth\Models\GroupModel;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Dompdf\Dompdf;
use Dompdf\Options;

class Product extends BaseController
{
    protected $db;
    protected $builder;
    protected $productModel;
    protected $menuModel;
    protected $categoryModel;
    protected $userModel;

    public function __construct()
    {
        $this->db = \Config\Database::connect();
        $this->builder = $this->db->table('product');
        $this->productModel = new ProductModel();
        $this->menuModel = new MenuModel();
        $this->categoryModel = new CategoriesModel();
        $this->userModel = new UserModel();
    }

    /* public function edit($id = 0)
    {
        $data = [
            'title' => 'Wedding Organizer',
        ];

        // Perform the LEFT JOIN with product, kategori, and users tables
        $this->builder = $this->db->table('product');
        $this->builder->select('product.id as produkid, product.nama_produk, product.description, product.user_id, product.kategori_id, product.harga_produk, product.photos_filenames, product.created_at, product.updated_at, product.deleted_at, kategori.nama_menu, kategori.deskripsi, kategori.isi, kategori.produk_id, categories.nama_categories, users.username, users.email, users.nama, users.foto, users.jenis_kelamin, users.telepon, users.lokasi');
        $this->builder->join('kategori', 'kategori.produk_id = product.id', 'left'); // Use 'left' for LEFT JOIN
        $this->builder->join('categories', 'categories.id = product.kategori_id', 'left'); // Use 'left' for LEFT JOIN
        $this->builder->join('users', 'users.id = product.user_id', 'left'); // Use 'left' for LEFT JOIN

        // Exclude soft-deleted records from kategori table
        $this->builder->where('kategori.deleted_at', null);

        // Fetch the product data with user names for the given $id
        $this->builder->where('product.id', $id);
        $product = $this->builder->get()->getRowArray();

        // Check if the product exists
        if (!$product) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Package not found');
        }

        // Pass the product data to the view
        $data['product'] = $product;

        // Fetch the menu options from the kategori table based on the produk_id of the main product
        $menuOptions = $this->getMenuOptions($product['produk_id']);

        // Pass the menu options to the view
        $data['menuOptions'] = $menuOptions;

        // Pass the product data to the view
        $data['product'] = $product;

        return view('produk/edit', $data);
    } */

    public function edit($id = 0)
    {
        $data = [
            'title' => 'Wedding Organizer',
        ];

        // Perform the LEFT JOIN with product, kategori, and users tables
        $this->builder = $this->db->table('product');
        $this->builder->select('product.id as produkid, product.nama_produk, product.description, product.user_id, product.kategori_id, product.harga_produk, product.photos_filenames, product.created_at, product.updated_at, product.deleted_at, kategori.nama_menu, kategori.deskripsi, kategori.produk_id,kategori.deleted_at, kategori.updated_at, categories.nama_categories, users.username, users.email, users.nama, users.foto, users.jenis_kelamin, users.telepon, users.lokasi');
        $this->builder->join('kategori', 'kategori.produk_id = product.id', 'left'); // Use 'left' for LEFT JOIN
        $this->builder->join('categories', 'categories.id = product.kategori_id', 'left'); // Use 'left' for LEFT JOIN
        $this->builder->join('users', 'users.id = product.user_id', 'left'); // Use 'left' for LEFT JOIN
        // Exclude soft-deleted records from kategori table
        
        $this->builder->where('product.deleted_at', null);

        // Fetch the product data with user names for the given $id
        $this->builder->where('product.id', $id);
        $product = $this->builder->get()->getRowArray();

        // Check if the product exists
        if (!$product) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Package not found');
        }

        // Pass the product data to the view
        $data['product'] = $product;

        // Fetch the menu options from the kategori table based on the produk_id of the main product
        $menuOptions = $this->getMenuOptions($product['produk_id']);

        // Exclude soft-deleted menu items
        $menuOptions = array_filter($menuOptions, function ($item) {
            return empty($item['deleted_at']);
        });

        // Pass the filtered menu options to the view
        $data['menuOptions'] = $menuOptions;

        // Pass the category data to the view

        $CategoryModel = new CategoriesModel();
        $kategori = $CategoryModel->findAll();

        // Pass the category data to the view
        $data['kategori'] = $kategori;

        return view('produk/edit', $data);
    }



    public function detail($id = 0)
    {
        $data = [
            'title' => 'Wedding Organizer',
        ];

        // Perform the LEFT JOIN with product, kategori, and users tables
        $this->builder = $this->db->table('product');
        $this->builder->select('product.id as produkid, product.nama_produk, product.description, product.user_id, product.kategori_id, product.harga_produk, product.photos_filenames, product.created_at, product.updated_at, product.deleted_at, kategori.nama_menu, kategori.deskripsi as kategori_deskripsi, kategori.isi,kategori.produk_id,categories.nama_categories, users.username, users.email, users.nama, users.foto, users.jenis_kelamin, users.telepon, users.lokasi');
        $this->builder->join('kategori', 'kategori.produk_id = product.id', 'left'); // Use 'left' for LEFT JOIN
        $this->builder->join('categories', 'categories.id = product.kategori_id', 'left'); // Use 'left' for LEFT JOIN
        $this->builder->join('users', 'users.id = product.user_id', 'left'); // Use 'left' for LEFT JOIN

        // Fetch the product data with user names for the given $id
        $this->builder->where('product.id', $id);
        $product = $this->builder->get()->getRowArray();

        // Check if the product exists
        if (!$product) {
            // Redirect to some error page or show an error message
            return redirect()->to('home/error-page');
        }

        // Pass the product data to the view
        $data['product'] = $product;

        // Fetch the menu options from the kategori table based on the produk_id of the main product
        $menuOptions = $this->getMenuOptions($product['produk_id']);

        // Pass the menu options to the view
        $data['menuOptions'] = $menuOptions;

        return view('produk/detail', $data);
    }
    // Add your getProductData function implementation here
    // This function should retrieve product data based on the provided $id

    public function generatePdf()
    {
        // Query data dari database
        $product = $this->productModel->findAll();

        // Buat objek DOMPDF baru
        $dompdf = new Dompdf();

        // Buat template HTML untuk PDF
        $html = '<h1 style="text-align: center;">Data Laporan Product</h1>';
        $html .= '<table style="width: 100%; border-collapse: collapse; margin: 0 auto;">';
        $html .= '<thead>';
        $html .= '<tr>';
        $html .= '<th style="border: 1px solid #000; padding: 8px; border-top-left-radius: 8px;">No</th>';
        $html .= '<th style="border: 1px solid #000; padding: 8px;">ID Product</th>';
        $html .= '<th style="border: 1px solid #000; padding: 8px;">Nama Product</th>';
        $html .= '<th style="border: 1px solid #000; padding: 8px;">Description</th>';
        $html .= '<th style="border: 1px solid #000; padding: 8px; border-top-right-radius: 8px;">Harga</th>';
        $html .= '</tr>';
        $html .= '</thead>';
        $html .= '<tbody>';

        $no = 1;
        foreach ($product as $lp) {
            $html .= '<tr>';
            $html .= '<td style="border: 1px solid #000; padding: 8px;">' . $no . '</td>';
            $html .= '<td style="border: 1px solid #000; padding: 8px;">' . $lp['id_produk'] . '</td>';
            $html .= '<td style="border: 1px solid #000; padding: 8px;">' . $lp['nama_produk'] . '</td>';
            $html .= '<td style="border: 1px solid #000; padding: 8px;">' . $lp['description'] . '</td>';
            $html .= '<td style="border: 1px solid #000; padding: 8px;">' . $lp['harga_produk'] . '</td>';
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
        file_put_contents('laporan_product.pdf', $output);

        // Unduh file PDF
        header('Content-Type: application/pdf');
        header('Content-Disposition: attachment; filename="laporan_product.pdf"');
        readfile('laporan_product.pdf');
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
        // Create an instance of the ProductModel
        $productModel = new ProductModel();

        // Query data from the database
        $produk = $productModel->findAll();

        // Create a new Spreadsheet instance
        $spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
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
        $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);

        // Define the file path
        $filePath = FCPATH . 'public/writable/temp/laporan_product.xlsx';

        // Ensure the directory exists, if not, create it
        if (!is_dir(dirname($filePath))) {
            mkdir(dirname($filePath), 0777, true);
        }

        // Save the file to the specified path
        $writer->save($filePath);

        // Set appropriate headers for download
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="laporan_product.xlsx"');
        header('Content-Length: ' . filesize($filePath));
        readfile($filePath);
        exit;
    }

    public function generateCsv()
    {
        // Query data from the database
        $produk = $this->productModel->findAll();

        // Prepare CSV data
        $csvData = [];
        $csvData[] = ['No', 'ID Product', 'Nama Product', 'Description', 'Harga'];

        $no = 1;
        foreach ($produk as $produk_item) {
            $csvData[] = [
                $no,
                $produk_item['id_produk'],
                $produk_item['nama_produk'],
                $produk_item['description'],
                $produk_item['harga_produk'],
            ];
            $no++;
        }

        // Set the response header for CSV download
        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="laporan_product.csv"');

        // Output CSV data directly
        $output = fopen('php://output', 'w');
        foreach ($csvData as $row) {
            fputcsv($output, $row);
        }
        fclose($output);
    }

    protected function getMenuOptions($produk_id)
    {
        $this->builder = $this->db->table('kategori');
        $this->builder->where('produk_id', $produk_id);
        $this->builder->where('deleted_at', null); // Filter out soft deleted records
        return $this->builder->get()->getResultArray();
    }

    public function create()
    {
        $data = [
            'title' => 'Tambah Package',
        ];
        // Fetch the category data from the database
        $menuModel = new MenuModel();
        $categories = $menuModel->findAll();

        // Pass the category data to the view
        $data['categories'] = $categories;

        $CategoryModel = new CategoriesModel();
        $kategori = $CategoryModel->findAll();

        // Pass the category data to the view
        $data['kategori'] = $kategori;

        // Display a form for adding products with category data
        return view('produk/create', $data);
    }


    public function daftar()
    {
        $data = [
            'title' => 'Daftar Package',
        ];

        $menuModel = new MenuModel();
        $categories = $menuModel->findAll();

        // Pass the category data to the view
        $data['categories'] = $categories;

        $CategoryModel = new CategoriesModel();
        $kategori = $CategoryModel->findAll();

        // Pass the category data to the view
        $data['kategori'] = $kategori;

        // Ambil data produk dari model
        $data['produk'] = $this->productModel->findAll();

        return view('produk/daftar_produk', $data);
    }

    /* public function store()
    {
        $data = [
            'title' => 'Tambah Package',
        ];

        $kategoriModel = new KategoriModel();
        $categories = $kategoriModel->findAll();

        // Pass the category data to the view
        $data['categories'] = $categories;

        // Validasi data yang diinput
        $rules = [
            // ... aturan validasi lainnya ...
            'nama_produk' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nama Package Wajib Diisi',
                ]
            ],
            'description' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Deskripsi Package Wajib Diisi',
                ]
            ],
            'harga_produk' => [
                'rules' => 'required|numeric',
                'errors' => [
                    'required' => 'Harga Package Wajib Diisi',
                    'numeric' => 'Harga Package Harus Berupa Angka',
                ]
            ],
            'photos_filenames' => [
                'rules' => 'uploaded[photos_filenames]|max_size[photos_filenames,105000]|ext_in[photos_filenames,jpg,jpeg,png]',
                'errors' => [
                    'uploaded' => 'Foto 1 harus diunggah.',
                    'max_size' => 'Ukuran Foto 1 maksimum adalah 105 MB.',
                    'ext_in' => 'Format Foto 1 harus jpg, jpeg, atau png.'
                ]
            ],
            'produk_id' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Kategori harus dipilih.',
                ]
            ],
            'nama_menu_id' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Kategori harus dipilih.',
                ]
            ],
            'deskripsi' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Kategori harus dipilih.',
                ]
            ],
        ];

        if (!$this->validate($rules)) {
            $data['validation'] = $this->validator;

            // Tambahkan pesan error jika terdapat kesalahan validasi
            session()->setFlashdata('error', 'Terdapat kesalahan validasi. Silakan periksa kembali data yang diinput.');

            return view('produk/create', $data);
        } else {
            // Ambil data dari form
            $nama_produk = $this->request->getPost('nama_produk');
            $description = $this->request->getPost('description');
            $harga_produk = $this->request->getPost('harga_produk');
            $kategori_id = $this->request->getPost('kategori_id');

            // Check if the provided kategori_id exists in the kategori table
            $kategoriModel = new KategoriModel();
            $kategori = $kategoriModel->find($kategori_id);

            if (!$kategori) {
                // If the kategori_id does not exist, handle the error accordingly
                session()->setFlashdata('error', 'Kategori ID tidak valid. Silakan pilih kategori yang sesuai.');
                return view('produk/create', $data);
            }

            // Get the authenticated user data
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
                // Handle the error if the user does not have the "admin" role
                session()->setFlashdata('error', 'Anda tidak memiliki izin untuk menambahkan produk.');
                return redirect()->to('produk/daftar_produk'); // Redirect to a page where users are authorized to create products
            }

            // Upload gambar dengan nama acak
            $photo1 = $this->request->getFile('photos_filenames');
            $newFileName1 = $photo1->getRandomName();
            $photo1->move('./uploads', $newFileName1);

            // Generate ID produk secara otomatis
            $id_produk = 'PCK' . strtoupper(bin2hex(random_bytes(4)));

            // Use the fetched user ID
            $user_id = $user->id;
            // Simpan data produk ke database
            $productData = [
                'id_produk' => $id_produk,
                'nama_produk' => $nama_produk,
                'description' => $description,
                'harga_produk' => $harga_produk,
                'kategori_id' => $kategori_id,
                'photos_filenames' => $newFileName1,
                'user_id' => $user_id, // Include the user_id in the product data
                'created_at' => date('Y-m-d'),
            ];

            $this->productModel->insert($productData);

            // Redirect ke halaman lain atau tampilkan pesan sukses
            session()->setFlashdata('success', 'Package berhasil dibuat.');
            return redirect()->to('produk/daftar_produk');
        }
    } */

    /* public function store()
    {
        $data = [
            'title' => 'Tambah Package',
        ];

        // Validasi data yang diinput
        $rules = [
            // ... aturan validasi lainnya ...
            'nama_produk' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nama Package Wajib Diisi',
                ]
            ],
            'description' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Deskripsi Package Wajib Diisi',
                ]
            ],
            'harga_produk' => [
                'rules' => 'required|numeric',
                'errors' => [
                    'required' => 'Harga Package Wajib Diisi',
                    'numeric' => 'Harga Package Harus Berupa Angka',
                ]
            ],
            'photos_filenames' => [
                'rules' => 'uploaded[photos_filenames]|max_size[photos_filenames,105000]|ext_in[photos_filenames,jpg,jpeg,png]',
                'errors' => [
                    'uploaded' => 'Foto 1 harus diunggah.',
                    'max_size' => 'Ukuran Foto 1 maksimum adalah 105 MB.',
                    'ext_in' => 'Format Foto 1 harus jpg, jpeg, atau png.'
                ]
            ],
            // Use dot notation to indicate array inputs
            'nama_menu.*' => [
            ],
            'deskripsi.*' => [
            ],
        ];

        if (!$this->validate($rules)) {
            $data['validation'] = $this->validator;

            // Tambahkan pesan error jika terdapat kesalahan validasi
            session()->setFlashdata('error', 'Terdapat kesalahan validasi. Silakan periksa kembali data yang diinput.');

            return view('produk/create', $data);
        } else {
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
                // Handle the error if the user does not have the "admin" role
                session()->setFlashdata('error', 'Anda tidak memiliki izin untuk menambahkan produk.');
                return redirect()->to('produk/daftar_produk'); // Redirect to a page where users are authorized to create products
            }

            // Upload gambar dengan nama acak
            $photo1 = $this->request->getFile('photos_filenames');
            $newFileName1 = $photo1->getRandomName();
            $photo1->move('./uploads', $newFileName1);

            // Generate ID produk secara otomatis
            $id_produk = 'PCK' . strtoupper(bin2hex(random_bytes(4)));

            // Use the fetched user ID
            $user_id = $user->id;

            // Simpan data produk ke database
            $productData = [
                'id_produk' => $id_produk,
                'nama_produk' => $this->request->getPost('nama_produk'),
                'description' => $this->request->getPost('description'),
                'harga_produk' => $this->request->getPost('harga_produk'),
                'photos_filenames' => $newFileName1,
                'user_id' => $user_id,
                'created_at' => date('Y-m-d'),
            ];

            $productModel = new ProductModel();

            // Check if insertion into the product table is successful
            if (!$productModel->insert($productData)) {
                // Handle the error if product insertion fails
                session()->setFlashdata('error', 'Gagal menyimpan data produk.');
                return view('produk/create', $data);
            }

            // Get the username of the user who added the product
            $userModel = new UserModel();
            $addedByUser = $userModel->find($user->id);
            $addedByUsername = $addedByUser ? $addedByUser->username : 'Unknown User';

            // Redirect ke halaman lain atau tampilkan pesan sukses
            session()->setFlashdata('success', 'Package baru dengan nama "' . $productData['nama_produk'] . '" berhasil dibuat oleh user: ' . $addedByUsername . '.');
            return redirect()->to('produk/daftar_produk');
        }
    } */

    public function store()
    {
        $data = [
            'title' => 'Tambah Package',
        ];

        // Validasi data yang diinput
        $rules = [
            // ... aturan validasi lainnya ...
            'nama_produk' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nama Package Wajib Diisi',
                ]
            ],
            'description' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Deskripsi Package Wajib Diisi',
                ]
            ],
            'harga_produk' => [
                'rules' => 'required|numeric',
                'errors' => [
                    'required' => 'Harga Package Wajib Diisi',
                    'numeric' => 'Harga Package Harus Berupa Angka',
                ]
            ],
            'photos_filenames' => [
                'rules' => 'uploaded[photos_filenames]|max_size[photos_filenames,105000]|ext_in[photos_filenames,jpg,jpeg,png]',
                'errors' => [
                    'uploaded' => 'Foto 1 harus diunggah.',
                    'max_size' => 'Ukuran Foto 1 maksimum adalah 105 MB.',
                    'ext_in' => 'Format Foto 1 harus jpg, jpeg, atau png.'
                ]
            ],
            'kategori_id' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Kategori Package Wajib Diisi',
                ]
            ],
            // Use dot notation to indicate array inputs
            'nama_menu.*' => [],
            'deskripsi.*' => [],
        ];

        if (!$this->validate($rules)) {
            $data['validation'] = $this->validator;

            // Tambahkan pesan error jika terdapat kesalahan validasi
            session()->setFlashdata('error', 'Terdapat kesalahan validasi. Silakan periksa kembali data yang diinput.');

            // Load the categories data
            $categoryModel = new CategoriesModel();
            $kategori = $categoryModel->findAll();

            // Pass the category data to the view
            $data['kategori'] = $kategori;

            return view('produk/create', $data);
        } else {

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
                // Handle the error if the user does not have the "admin" role
                session()->setFlashdata('error', 'Anda tidak memiliki izin untuk menambahkan produk.');
                return redirect()->to('produk/daftar_produk'); // Redirect to a page where users are authorized to create products
            }

            // Upload gambar dengan nama acak
            $photo1 = $this->request->getFile('photos_filenames');
            $newFileName1 = $photo1->getRandomName();
            $photo1->move('./uploads', $newFileName1);

            // Generate ID produk secara otomatis
            $id_produk = 'PCK' . strtoupper(bin2hex(random_bytes(4)));

            // Use the fetched user ID
            $user_id = $user->id;

            // Simpan data produk ke database
            $productData = [
                'id_produk' => $id_produk, // Ini adalah penamaan atau kode produk yang diisi otomatis
                'nama_produk' => $this->request->getPost('nama_produk'),
                'description' => $this->request->getPost('description'),
                'harga_produk' => $this->request->getPost('harga_produk'),
                'kategori_id' => $this->request->getPost('kategori_id'),
                'photos_filenames' => $newFileName1,
                'user_id' => $user_id,
                'created_at' => date('Y-m-d'),
            ];

            $productModel = new ProductModel();

            // Check if insertion into the product table is successful
            if (!$productModel->insert($productData)) {
                // Handle the error if product insertion fails
                session()->setFlashdata('error', 'Gagal menyimpan data produk.');
                return view('produk/create', $data);
            }

            // Get the inserted product's ID
            $insertedProductID = $productModel->insertID();

            // Save the category data to the database
            $nama_menu = $this->request->getPost('nama_menu');
            $deskripsi = $this->request->getPost('deskripsi');

            // Check if both $nama_menu and $deskripsi are arrays and not empty
            if (is_array($nama_menu) && is_array($deskripsi)) {
                // Remove empty elements from $nama_menu and $deskripsi arrays
                $nama_menu = array_filter($nama_menu);
                $deskripsi = array_filter($deskripsi);

                // Make sure both $nama_menu and $deskripsi arrays have the same number of elements
                $count = min(count($nama_menu), count($deskripsi));

                $menuModel = new MenuModel();
                $kategoriData = [];

                // Insert the menu data into the $kategoriData array
                for ($i = 0; $i < $count; $i++) {
                    // Insert data kategori hanya ketika nama_menu dan deskripsi diisi
                    if (!empty($nama_menu[$i]) && !empty($deskripsi[$i])) {
                        $id_kategori = 'MNU-' . strtoupper(bin2hex(random_bytes(3)));

                        $kategoriData[] = [
                            'id_kategori' => $id_kategori,
                            'produk_id' => $insertedProductID, // Use the fetched 'id' of the product
                            'nama_menu' => $nama_menu[$i],
                            'deskripsi' => $deskripsi[$i],
                        ];
                    }
                }

                // ... existing code ...

                // Insert the kategori data into the database using insertBatch()
                if (!empty($kategoriData)) {
                    $menuModel->insertBatch($kategoriData);
                }
            }

            // Get the username of the user who added the product
            $userModel = new UserModel();
            $addedByUser = $userModel->find($user->id);
            $addedByUsername = $addedByUser ? $addedByUser->username : 'Unknown User';

            // Redirect ke halaman lain atau tampilkan pesan sukses
            session()->setFlashdata('success', 'Package baru dengan nama "' . $productData['nama_produk'] . '" berhasil dibuat oleh user: ' . $addedByUsername . '.');
            return redirect()->to('produk/daftar_produk');
        }
    }

    public function update($id)
    {
        $productModel = new ProductModel();
        $existingProduct = $productModel->find($id);

        // Check if the product exists in the database
        if (!$existingProduct) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Product not found');
        }

        $data = [
            'title' => 'Ubah Package',
        ];

        // Validasi data yang diinput
        $rules = [
            // ... aturan validasi lainnya ...
            'nama_produk' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nama Package Wajib Diisi',
                ]
            ],
            'description' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Deskripsi Package Wajib Diisi',
                ]
            ],
            'harga_produk' => [
                'rules' => 'required|numeric',
                'errors' => [
                    'required' => 'Harga Package Wajib Diisi',
                    'numeric' => 'Harga Package Harus Berupa Angka',
                ]
            ],
            'photos_filenames' => [
                'rules' => 'max_size[photos_filenames,105000]|ext_in[photos_filenames,jpg,jpeg,png]',
                'errors' => [
                    'max_size' => 'Ukuran Foto 1 maksimum adalah 105 MB.',
                    'ext_in' => 'Format Foto 1 harus jpg, jpeg, atau png.'
                ]
            ],
            'kategori_id' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Kategori Harus Di isi',
                ]
            ],
            // Use dot notation to indicate array inputs
            'nama_menu.*' => [],
            'deskripsi.*' => [],
        ];

        if (!$this->validate($rules)) {
            $data['validation'] = $this->validator;

            // Tambahkan pesan error jika terdapat kesalahan validasi
            session()->setFlashdata('error', 'Terdapat kesalahan validasi. Silakan periksa kembali data yang diinput.');

            // Get the existing product data to pre-fill the form fields
            $productModel = new ProductModel();
            $existingProduct = $productModel->find($id);
            if (!$existingProduct) {
                throw new \CodeIgniter\Exceptions\PageNotFoundException('Product not found');
            }
            $data['product'] = $existingProduct;

            return view('produk/edit', $data);
        } else {
            // Get authenticated user data
            $user = service('authentication')->user();

            // Check if the user is logged in
            if (!$user) {
                // Handle the error if the user is not logged in
                session()->setFlashdata('error', 'Anda harus masuk untuk mengubah produk.');
                return redirect()->to('login'); // Redirect to the login page
            }

            // Check if the user is an admin
            $groupModel = new GroupModel();
            $isAdmin = false;
            $userGroups = $groupModel->getGroupsForUser($user->id);

            // Check if the user has groups
            if ($userGroups) {
                // Iterate through each group to find 'admin' role
                foreach ($userGroups as $group) {
                    if ($group['name'] === 'admin') {
                        $isAdmin = true;
                        break;
                    }
                }
            }

            if (!$isAdmin) {
                // Handle the error if the user does not have the "admin" role
                session()->setFlashdata('error', 'Anda tidak memiliki izin untuk mengubah produk.');
                return redirect()->to('produk/daftar_produk'); // Redirect to a page where users are authorized to edit products
            }

            $photo1 = $this->request->getFile('photos_filenames');
            if ($photo1->isValid() && !$photo1->hasMoved()) {
                $newFileName1 = $photo1->getRandomName();
                $photo1->move('./uploads', $newFileName1);
                $productData['photos_filenames'] = $newFileName1;
                // Delete the old image if it exists and is a file
                $oldImagePath = './uploads/' . $existingProduct['photos_filenames'];
                if (is_file($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }

            // Simpan data produk ke database
            $productData = [
                'nama_produk' => $this->request->getPost('nama_produk'),
                'description' => $this->request->getPost('description'),
                'harga_produk' => $this->request->getPost('harga_produk'),
                'kategori_id' => $this->request->getPost('kategori_id'),
                'user_id' => $user->id,
                'photos_filenames' => isset($productData['photos_filenames']) ? $productData['photos_filenames'] : $existingProduct['photos_filenames'],
            ];

            // Check if update to the product table is successful
            $db = db_connect(); // Assuming you are using CodeIgniter 4 database connection
            $db->transStart(); // Start transaction

            if (!$productModel->update($id, $productData)) {
                session()->setFlashdata('error', 'Package "' . $existingProduct['nama_produk'] . '" gagal diupdate.');
                $db->transRollback(); // Rollback transaction
                return view('produk/edit', $data);
            }
            // Save the category data to the database
            $nama_menu = $this->request->getPost('nama_menu');
            $deskripsi = $this->request->getPost('deskripsi');

            $menuModel = new MenuModel();

            // Get the existing categories for the product
            $existingCategories = $menuModel->where('produk_id', $id)->findAll();

            if (!empty($nama_menu)) {
                // Update existing categories or insert new categories
                foreach ($nama_menu as $index => $menu) {
                    // Check if nama_menu and deskripsi are not null and not empty before updating
                    if (!empty($menu) || !is_null($menu) || !empty($deskripsi[$index]) || !is_null($deskripsi[$index])) {
                        $id_kategori = 'MNU-' . strtoupper(bin2hex(random_bytes(3))); // Generate a new id_kategori for new menu items
                        $categoryData = [
                            'produk_id' => $id,
                            'id_kategori' => $id_kategori,
                            'nama_menu' => $menu,
                            'deskripsi' => $deskripsi[$index],
                        ];

                        if (isset($existingCategories[$index])) {
                            // If the category exists, update it
                            $menuModel->update($existingCategories[$index]['id'], $categoryData);
                        } else {
                            // If the category does not exist, insert it
                            $menuModel->insert($categoryData);
                        }
                    }
                }
            }

            // Menangani penghapusan item menu
            $deleted_menu_ids = $this->request->getPost('id_kategori');
            if (!empty($deleted_menu_ids)) {
                foreach ($deleted_menu_ids as $deleted_id) {
                    // Melakukan penghapusan lunak pada item menu dengan mengatur nilai deleted_at
                    $categoryData = ['deleted_at' => date('Y-m-d H:i:s')];
                    $menuModel->update($deleted_id, $categoryData);
                }
            }

            $db->transCommit(); // Commit transaction

            $userModel = new UserModel();
            $updatedByUser = $userModel->find($user->id);
            $updatedByUsername = $updatedByUser ? $updatedByUser->username : 'Unknown User';

            session()->setFlashdata('success', 'Package "' . $existingProduct['nama_produk'] . '" berhasil diupdate by user: ' . $updatedByUsername . '.');
            return redirect()->to('produk/daftar_produk');
        }
    }


    /* public function update($id)
    {
        // Fetch the existing product data from the database
        $productModel = new ProductModel();
        $existingProduct = $productModel->find($id);

        // Check if the product exists in the database
        if (!$existingProduct) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Product not found');
        }

        // Fetch the submitted data from the form
        $nama_produk = $this->request->getPost('nama_produk');
        $description = $this->request->getPost('description');
        $harga_produk = $this->request->getPost('harga_produk');
        $kategori_id = $this->request->getPost('kategori_id');

        // Prepare the data to be updated
        $updatedData = [];

        // Check if the submitted data is different from the existing data
        if ($nama_produk !== $existingProduct['nama_produk']) {
            $updatedData['nama_produk'] = $nama_produk;
        }

        if ($description !== $existingProduct['description']) {
            $updatedData['description'] = $description;
        }

        if ($harga_produk !== $existingProduct['harga_produk']) {
            $updatedData['harga_produk'] = $harga_produk;
        }

        if ($kategori_id !== $existingProduct['kategori_id']) {
            // Check if the provided kategori_id exists in the kategori table
            $kategoriModel = new KategoriModel();
            $kategori = $kategoriModel->find($kategori_id);

            if (!$kategori) {
                // If the kategori_id does not exist, handle the error accordingly
                session()->setFlashdata('error', 'Kategori ID tidak valid. Silakan pilih kategori yang sesuai.');
                return redirect()->to('produk/daftar_produk');
            }

            $updatedData['kategori_id'] = $kategori_id;
        }

        // If no changes were made, redirect back with a message
        if (empty($updatedData)) {
            session()->setFlashdata('info', 'No changes were made.');
            return redirect()->to('produk/daftar_produk');
        }

        // If there are changes, proceed with the update
        // ... your update logic here ...

        // Update the product data in the database
        $productModel->update($id, $updatedData);

        // Redirect to the product listing page with a success message
        session()->setFlashdata('success', 'Package updated successfully.');
        return redirect()->to('produk/daftar_produk');
    } */

    public function delete($id)
    {
        // Load the product model
        $productModel = new ProductModel();

        // Fetch the product data from the database
        $product = $productModel->find($id);

        // Check if the product exists in the database
        if (!$product) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Product not found');
        }

        // Get the authenticated user data
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

        // Check if the user is an admin or the owner of the product before allowing deletion
        if ($isAdmin || $product['user_id'] === $user->id) {
            // Get the username of the user who deleted the product
            $userModel = new UserModel();
            $deletedByUser = $userModel->find($product['user_id']);
            $deletedByUsername = $deletedByUser ? $deletedByUser->username : 'Unknown User';

            // Update the deleted_at field to mark it as soft deleted
            $data = ['deleted_at' => date('Y-m-d H:i:s')];
            if ($productModel->update($id, $data)) {
                // Product deletion successful
                session()->setFlashdata('success', 'Package "' . $product['nama_produk'] . '" has been soft deleted successfully by user: ' . $deletedByUsername . '.');
            } else {
                // Product deletion failed
                session()->setFlashdata('error', 'Failed to soft delete the package "' . $product['nama_produk'] . '".');
            }
        } else {
            // User does not have permission to delete the product
            session()->setFlashdata('error', 'You do not have permission to delete this package.');
        }

        return redirect()->to('produk/daftar_produk');
    }

    public function dlts($id)
    {
        // Load the menu model
        $menuModel = new MenuModel();

        // Fetch the menu data from the database
        $menu = $menuModel->find($id);

        // Check if the menu exists in the database
        if (!$menu) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Menu not found');
        }

        // Check if the menu has been soft deleted before
        if (!empty($menu['deleted_at'])) {
            session()->setFlashdata('error', 'Menu "' . $menu['nama_menu'] . '" has been already deleted.');
            return redirect()->back(); // Menggunakan redirect()->back() untuk kembali ke halaman sebelumnya
        }

        // Update the deleted_at field to mark it as soft deleted
        $data = ['deleted_at' => date('Y-m-d H:i:s')];
        if ($menuModel->update($id, $data)) {
            // Menu deletion successful
            session()->setFlashdata('success', 'Menu "' . $menu['nama_menu'] . '" has been soft deleted successfully.');
        } else {
            // Menu deletion failed
            session()->setFlashdata('error', 'Failed to soft delete the menu "' . $menu['nama_menu'] . '".');
        }

        return redirect()->back(); // Menggunakan redirect()->back() untuk kembali ke halaman sebelumnya
    }

}
