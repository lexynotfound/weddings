<?php

namespace App\Models;

use CodeIgniter\Model;

class ReservationModel extends Model
{
    protected $table = 'reservation';
    protected $primaryKey = 'id';
    protected $allowedFields = ['tgl_acara', 'user_id','reservation_detail_id','payment_option','status' ];
}
