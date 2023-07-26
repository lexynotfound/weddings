<?php

namespace App\Controllers;

use App\Models\ProductModel;
use App\Models\ProductPhotoModel;
use App\Models\KategoriModel;
use Myth\Auth\Models\UserModel;
use Myth\Auth\Models\GroupModel;
class Home extends BaseController
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

    public function index()
    {
        $data = [
            'title' => 'Wedding Organizer',
        ];

        // Load the KategoriModel
        $kategoriModel = new KategoriModel();

        // Fetch all categories from the database
        $categories = $kategoriModel->findAll();

        // Pass the category data to the view
        $data['categories'] = $categories;

        // Perform the LEFT JOIN with users and kategori tables
        $this->builder = $this->db->table('product');
        $this->builder->select('product.id as produkid, product.id_produk, product.nama_produk, product.description, product.user_id, product.kategori_id, product.harga_produk, product.photos_filenames, product.created_at, product.updated_at, product.deleted_at, users.username, users.email, users.nama, users.foto, users.jenis_kelamin, users.telepon, users.lokasi, kategori.nama_kategori, kategori.deskripsi, kategori.isi');
        $this->builder->join('users', 'users.id = product.user_id', 'left'); // Use 'left' for LEFT JOIN
        $this->builder->join('kategori', 'kategori.id = product.kategori_id');

        // Get the product data with user names
        $products = $this->builder->get()->getResultArray();

        // Pass the product data to the view
        $data['produk'] = $products;

        return view('home/index', $data);
    }

    public function detail($id = 0)
    {
        $data = [
            'title' => 'Wedding Organizer',
        ];

        // Load the KategoriModel
        $kategoriModel = new KategoriModel();

        // Fetch all categories from the database
        $categories = $kategoriModel->findAll();

        // Pass the category data to the view
        $data['categories'] = $categories;

        // Perform the LEFT JOIN with users and kategori tables
        $this->builder = $this->db->table('product');
        $this->builder->select('product.id as produkid, product.id_produk, product.nama_produk, product.description, product.user_id, product.kategori_id, product.harga_produk, product.photos_filenames, product.created_at, product.updated_at, product.deleted_at, users.username, users.email, users.nama, users.foto, users.jenis_kelamin, users.telepon, users.lokasi, kategori.nama_kategori, kategori.deskripsi, kategori.isi');
        $this->builder->join('users', 'users.id = product.user_id', 'left'); // Use 'left' for LEFT JOIN
        $this->builder->join('kategori', 'kategori.id = product.kategori_id');

        // Fetch the product data with user names for the given $id
        $this->builder->where('product.id', $id);
        $product = $this->builder->get()->getRowArray();

        // Check if the product exists
        if (!$product) {
            // Redirect to some error page or show an error message
            return redirect()->to('error-page');
        }

        // Pass the product data to the view
        $data['product'] = $product;

        // Fetch related products only if the product data is valid
        if (!empty($product['kategori_id']) && !empty($product['id_produk'])) {
            // Convert kategori_id to an integer
            $kategori_id = (int)$product['kategori_id'];

            // Fetch related products with the same category (excluding the current product)
            $relatedProducts = $this->getRelatedProducts($kategori_id, $product['id_produk']);

            // Pass the related product data to the view
            $data['relatedProducts'] = $relatedProducts;
        } else {
            // If the product data is invalid or missing, set an empty array for related products
            $data['relatedProducts'] = [];
        }

        return view('home/detail', $data);
    }

    // Method to fetch related products with the same category
    private function getRelatedProducts($kategori_id, $current_product_id)
    {
        // Load the ProductModel (adjust the model name as per your setup)
        $productModel = new ProductModel();

        // Perform the LEFT JOIN with users and kategori tables
        $productModel->select('product.id as produkid, product.id_produk, product.nama_produk, product.harga_produk, product.photos_filenames');
        $productModel->join('kategori', 'kategori.id = product.kategori_id');

        // Fetch related products (products with the same category except the current product)
        $productModel->where('product.kategori_id', $kategori_id);
        $productModel->where('product.id_produk !=', $current_product_id);

        // Limit the number of related products (adjust the number as needed)
        $productModel->limit(4);

        // Get the related product data
        $relatedProducts = $productModel->findAll();

        return $relatedProducts;
    }

}
