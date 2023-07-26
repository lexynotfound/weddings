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
        $product = $this->productModel->find($id_produk);
        $categories = $this->kategoriModel->findAll();

        if (!$product) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Package not found');
        }

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
    }

    public function update($id)
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
    }



    public function delete($id)
    {
        $product = $this->productModel->find($id);

        if (!$product) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Product not found');
        }

        // Delete the product and its photos from the database
        $this->productModel->delete($id);
        // ... (delete product photos if applicable) ...

        session()->setFlashdata('success', 'Package deleted successfully.');
        return redirect()->to('produk/daftar_produk');
    }

}