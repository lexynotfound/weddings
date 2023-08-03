<?php

namespace App\Models;

use CodeIgniter\Model;

class ReservationDetailModel extends Model
{
    protected $table = 'reservation_detail';
    protected $primaryKey = 'id';
    protected $allowedFields = ['menu_id', 'user_id', 'produk_id', 'created_at'];


}
