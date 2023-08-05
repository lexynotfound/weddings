<?php

namespace App\Models;

use CodeIgniter\Model;

class TransaksiModel extends Model
{
    protected $table = 'transaksi';
    protected $primaryKey = 'id';
    protected $allowedFields = ['user_id', 'id_transaksi', 'menu_id', 'produk_id', 'reservation_id', 'status', 'total_harga', 'payment_option', 'tgl_transaksi'];

    // Add your custom methods if needed

}
