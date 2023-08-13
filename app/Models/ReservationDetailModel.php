<?php

namespace App\Models;

use CodeIgniter\Model;

class ReservationDetailModel extends Model
{
    protected $table = 'reservation_detail';
    protected $primaryKey = 'id';
    protected $returnType = 'array';
    protected $useSoftDeletes = true;
    protected $allowedFields = ['menu_id', 'user_id', 'produk_id', 'created_at','tgl_expired'];

    protected $useTimestamps  = true;
    protected $createdField   = 'created_at';
    /* protected $updatedField   = 'updated_at'; */
    protected $deletedField   = 'tgl_expired';
}
