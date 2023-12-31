<?php

namespace App\Models;

use CodeIgniter\Model;

class TransaksiModel extends Model
{
    protected $table = 'transaksi';
    protected $primaryKey = 'id';
    protected $returnType = 'array';
    protected $useSoftDeletes = true;
    protected $allowedFields = ['user_id', 'id_transaksi', 'menu_id', 'produk_id', 'reservation_id', 'status', 'total_harga', 'payment_option', 'tgl_transaksi','updated_at','tgl_expired'];

    // Add your custom methods if needed
    protected $useTimestamps  = true;
    protected $createdField   = 'tgl_transaksi';
    protected $updatedField   = 'updated_at';
    protected $deletedField   = 'tgl_expired';
}
