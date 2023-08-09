<?php

namespace App\Controllers;

use App\Models\ProductModel;
use App\Models\MenuModel;
use App\Models\CategoriesModel;
use Myth\Auth\Models\UserModel;

class Category extends BaseController
{
    protected $db;
    protected $builder;
    protected $productModel;
    protected $menuModel;
    protected $categoriesModel;
    protected $userModel;

    public function __construct()
    {
        $this->db = \Config\Database::connect();
        $this->builder = $this->db->table('product');
        $this->productModel = new ProductModel();
        $this->menuModel = new MenuModel();
        $this->categoriesModel = new CategoriesModel();
        $this->userModel = new UserModel();
    }

    /* public function index()
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

        // Perform the LEFT JOIN with product and kategori tables
        $this->builder = $this->db->table('product');
        $this->builder->select('product.id as produkid, product.nama_produk, product.description, product.user_id, product.kategori_id, product.harga_produk, product.photos_filenames, product.created_at, product.updated_at, product.deleted_at, users.username, users.email, users.nama, users.foto, users.jenis_kelamin, users.telepon, users.lokasi, kategori.id as kategori_id, kategori.nama_menu, kategori.deskripsi as kategori_deskripsi, kategori.isi');
        $this->builder->join('kategori', 'kategori.produk_id = product.id', 'left'); // Use 'left' for LEFT JOIN
        $this->builder->join('users', 'users.id = product.user_id', 'left'); // Use 'left' for LEFT JOIN

        // Get the product data with category information
        $products = $this->builder->get()->getResultArray();

        // Pass the product data to the view
        $data['produk'] = $products;

        return view('home/index', $data);
    } */

    public function index()
    {
        $data = [
            'title' => 'Category',
        ];

        // Get related products with kategori_id = 1
        $categoriesProducts = $this->getCategoriesProducts();

        // Pass the related product data to the view
        $data['categoriesProducts'] = $categoriesProducts;
        
        // Get related products with kategori_id = 2
        $categoriesProductsDC = $this->getCategoriesProductsDC();

        // Pass the related product data to the view
        $data['categoriesProductsDC'] = $categoriesProductsDC;

        // Get related products with kategori_id = 3
        $categoriesProductsNon = $this->getCategoriesProductsNon();

        // Pass the related product data to the view
        $data['categoriesProductsNon'] = $categoriesProductsNon;

        // Pass the product data to the view

        return view('category/index', $data);
    }

    private function getCategoriesProducts()
    {
        // Get distinct products with kategori_id = 1
        $this->builder = $this->db->table('product');
        $this->builder->select('product.id as produkid, product.nama_produk,product.kategori_id, product.harga_produk, product.photos_filenames, users.foto, users.lokasi');
        $this->builder->join('kategori', 'kategori.produk_id = product.id', 'left'); // Use 'left' for LEFT JOIN
        $this->builder->join('users', 'users.id = product.user_id', 'left'); // Use 'left' for LEFT JOIN
        $this->builder->where('product.kategori_id', 1); // Filter products with kategori_id = 1
        $this->builder->distinct(); // Make sure only distinct products are selected
        $this->builder->orderBy('product.id', 'DESC');

        $query = $this->builder->get();
        $products = $query->getResultArray();

        return $products;
    }

    private function getCategoriesProductsDC()
    {
        // Get distinct products with kategori_id = 1
        $this->builder = $this->db->table('product');
        $this->builder->select('product.id as produkid, product.nama_produk,product.kategori_id, product.harga_produk, product.photos_filenames, users.foto, users.lokasi');
        $this->builder->join('kategori', 'kategori.produk_id = product.id', 'left'); // Use 'left' for LEFT JOIN
        $this->builder->join('users', 'users.id = product.user_id', 'left'); // Use 'left' for LEFT JOIN
        $this->builder->where('product.kategori_id', 2); // Filter products with kategori_id = 1
        $this->builder->distinct(); // Make sure only distinct products are selected
        $this->builder->orderBy('product.id', 'DESC');

        $query = $this->builder->get();
        $products = $query->getResultArray();

        return $products;
    }

    private function getCategoriesProductsNon()
    {
        // Get distinct products with kategori_id = 1
        $this->builder = $this->db->table('product');
        $this->builder->select('product.id as produkid, product.nama_produk,product.kategori_id, product.harga_produk, product.photos_filenames, users.foto, users.lokasi');
        $this->builder->join('kategori', 'kategori.produk_id = product.id', 'left'); // Use 'left' for LEFT JOIN
        $this->builder->join('users', 'users.id = product.user_id', 'left'); // Use 'left' for LEFT JOIN
        $this->builder->where('product.kategori_id', 3); // Filter products with kategori_id = 1
        $this->builder->distinct(); // Make sure only distinct products are selected
        $this->builder->orderBy('product.id', 'DESC');

        $query = $this->builder->get();
        $products = $query->getResultArray();

        return $products;
    }

    public function errorpage()
    {
        $data = [
            'title' => 'Hmmm Sepertinya ada yang salah...',
        ];

        return view('home/error-page', $data);
    }

    // Function to get menu options based on produk_id
    protected function getMenuOptions($produk_id)
    {
        $this->builder = $this->db->table('kategori');
        $this->builder->where('produk_id', $produk_id);
        return $this->builder->get()->getResultArray();
    }

    // Function to get related products based on the given produk_id
    private function getRelatedProducts($kategoriId, $currentProductId)
    {
        // Perform a query to fetch related products with the same "kategori_id" randomly and limit to 4 rows
        $this->builder = $this->db->table('product');
        $this->builder->select('product.id as produkid, product.nama_produk, product.description, product.user_id, product.kategori_id, product.harga_produk, product.photos_filenames, product.created_at, product.updated_at, product.deleted_at,categories.nama_categories,kategori.nama_menu,kategori.deskripsi, users.username, users.email, users.nama, users.foto, users.jenis_kelamin, users.telepon, users.lokasi');
        $this->builder->join('categories', 'categories.id = product.kategori_id', 'left'); // Use 'left' for LEFT JOIN
        $this->builder->join('kategori', 'kategori.produk_id = product.id', 'left');
        $this->builder->join('users', 'users.id = product.user_id', 'left'); // Use 'left' for LEFT JOIN
        $this->builder->where('product.id !=', $currentProductId); // Exclude the current product
        $this->builder->where('product.kategori_id', $kategoriId); // Fetch related products with the same "kategori_id"
        $this->builder->orderBy('RAND()'); // Randomize the order

        // Limit the result to 4 rows
        $this->builder->limit(4);

        // Fetch related products and return the result as an array
        $relatedProducts = $this->builder->get()->getResultArray();
        return $relatedProducts;
    }

    public function custom($id = 0)
    {
        $data = [
            'title' => 'Wedding Organizer',
        ];

        // Load the KategoriModel
        $menuModel = new MenuModel();

        // Fetch all categories from the database
        $categories = $menuModel->findAll();

        // Pass the category data to the view
        $data['categories'] = $categories;

        // Perform the LEFT JOIN with users and kategori tables
        $this->builder = $this->db->table('product');
        $this->builder->select('product.id as produkid, product.id_produk, product.nama_produk, product.description, product.user_id, product.kategori_id, product.harga_produk, product.photos_filenames, product.created_at, product.updated_at, product.deleted_at, users.username, users.email, users.nama, users.foto, users.jenis_kelamin, users.telepon, users.lokasi, kategori.nama_menu, kategori.deskripsi, kategori.isi');
        $this->builder->join('users', 'users.id = product.user_id', 'left'); // Use 'left' for LEFT JOIN
        $this->builder->join('kategori', 'kategori.id = product.kategori_id');

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

        return view('home/custom', $data);
    }

    // Method to fetch related products with the same category
    /* private function getRelatedProducts($kategori_id, $current_product_id)
    {
        // Load the ProductModel (adjust the model name as per your setup)
        $productModel = new ProductModel();

        // Perform the LEFT JOIN with users and kategori tables
        $productModel->select('product.id as produkid, product.id_produk, product.nama_produk, product.harga_produk, product.photos_filenames, kategori.nama_menu,');
        $productModel->join('kategori', 'kategori.id = product.kategori_id');

        // Fetch related products (products with the same category except the current product)
        $productModel->where('product.kategori_id', $kategori_id);
        $productModel->where('product.id_produk !=', $current_product_id);

        // Limit the number of related products (adjust the number as needed)
        $productModel->limit(4);

        // Get the related product data
        $relatedProducts = $productModel->findAll();

        return $relatedProducts;
    } */
}
