<?php

namespace App\Models;

use CodeIgniter\Model;

class TransaksiModel extends Model
{
    protected $table = 'transaksi';
    protected $primaryKey = 'id';
    protected $allowedFields = ['user_id', 'id_transaksi', 'reservation_id', 'status','total_harga', 'tgl_transaksi'];

    // Add your custom methods if needed
    protected $useTimestamps  = true;
    protected $createdField   = 'tgl_transaksi';

}
