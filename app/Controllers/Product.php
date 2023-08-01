<?php

// app/Controllers/ProductController.php
namespace App\Controllers;


use App\Models\ProductModel;
use App\Models\ProductPhotoModel;
use App\Models\KategoriModel;
use Myth\Auth\Models\UserModel;
use Myth\Auth\Models\GroupModel;

class Product extends BaseController
{
    protected $db;
    protected $builder;
    protected $productModel;
    protected $kategoriModel;
    protected $productPhotoModel;
    protected $userModel;

    public function __construct()
    {
        $this->db = \Config\Database::connect();
        $this->builder = $this->db->table('product');
        $this->productModel = new ProductModel();
        $this->kategoriModel = new KategoriModel();
        $this->productPhotoModel = new ProductPhotoModel();
        $this->userModel = new UserModel();
    }

    public function edit($id_produk)
    {
        // Load the ProductModel
        $productModel = new ProductModel();

        // Perform the LEFT JOIN with users and kategori tables
        $this->builder = $this->db->table('product');
        $this->builder->select('product.id as produkid, product.id_produk, product.nama_produk, product.description, product.user_id, product.kategori_id, product.harga_produk, product.photos_filenames, product.created_at, product.updated_at, product.deleted_at, users.username, users.email, users.nama, users.foto, users.jenis_kelamin, users.telepon, users.lokasi, kategori.nama_menu, kategori.deskripsi, kategori.isi');
        $this->builder->join('users', 'users.id = product.user_id', 'left'); // Use 'left' for LEFT JOIN
        $this->builder->join('kategori', 'kategori.id = product.kategori_id');

        // Fetch the product data with user names for the given $id_produk
        $this->builder->where('product.id', $id_produk);
        $product = $this->builder->get()->getRowArray();

        if (!$product) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Package not found');
        }

        // Load the KategoriModel
        $kategoriModel = new KategoriModel();

        // Fetch all categories from the database
        $categories = $kategoriModel->findAll();

        // Pass the data to the view
        $data = [
            'product' => $product,
            'categories' => $categories,
            'title' => 'Ubah Package',
        ];

        return view('produk/edit', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Tambah Package',
        ];
        // Fetch the category data from the database
        $kategoriModel = new KategoriModel();
        $categories = $kategoriModel->findAll();

        // Pass the category data to the view
        $data['categories'] = $categories;

        // Display a form for adding products with category data
        return view('produk/create', $data);
    }


    public function daftar()
    {
        $data = [
            'title' => 'Daftar Package',
        ];

        $kategoriModel = new KategoriModel();
        $categories = $kategoriModel->findAll();

        // Pass the category data to the view
        $data['categories'] = $categories;

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

    public function store()
    {
        $data = [
            'title' => 'Tambah Package',
        ];

        $kategoriModel = new KategoriModel();
        $categories = $kategoriModel->findAll();

        // Pass the category data to the view
        $data['categories'] = $categories;

        // Validasi data yang diinput
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
                if (
                    $group['name'] === 'admin'
                ) {
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

            // Get the last inserted product ID
            $product_id = $productModel->getInsertID();

            // Save the category data to the database
            $id_kategori = 'MNU' . strtoupper(bin2hex(random_bytes(4)));
            $nama_menu = $this->request->getPost('nama_menu');
            $deskripsi = $this->request->getPost('deskripsi');

            $kategoriModel = new KategoriModel();

            foreach ($nama_menu as $index => $menu) {
                $categoryData = [
                    'id_kategori' => $id_kategori,
                    'produk_id' => $product_id,
                    'nama_menu' => $menu,
                    'deskripsi' => $deskripsi[$index],
                ];

                // Check if insertion into the kategori table is successful
                if (!$kategoriModel->insert($categoryData)) {
                    // Handle the error if category insertion fails
                    session()->setFlashdata('error', 'Gagal menyimpan data kategori.');
                    return view('produk/create', $data);
                }
            }

            // Redirect ke halaman lain atau tampilkan pesan sukses
            session()->setFlashdata('success', 'Package berhasil dibuat.');
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

    public function update($id)
    {
        // Fetch the existing product data from the database
        $productModel = new ProductModel();
        $existingProduct = $productModel->find($id);

        // Check if the product exists in the database
        if (!$existingProduct) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Package not found');
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
        $productModel->update($id,
            $updatedData
        );

        // Redirect to the product listing page with a success message
        session()->setFlashdata('success', 'Package updated successfully.');
        return redirect()->to('produk/daftar_produk');
    }

    public function delete($id)
    {
        // Fetch the product data from the database
        $product = $this->productModel->find($id);

        // Check if the product exists in the database
        if (!$product) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Product not found');
        }

        // Delete the product and its related records (kategori) from the database
        // (Make sure the foreign key constraint ON DELETE CASCADE is set in the database)
        $this->productModel->delete($id);

        session()->setFlashdata('success', 'Package deleted successfully.');
        return redirect()->to('produk/daftar_produk');
    }

}