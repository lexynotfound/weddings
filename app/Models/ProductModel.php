<?php

namespace App\Models;
use CodeIgniter\Model;

class ProductModel extends Model
{
    protected $table = 'product';
    protected $primaryKey = 'id';
    protected $allowedFields = ['nama_produk', 'description', 'harga_produk', 'user_id'];
}