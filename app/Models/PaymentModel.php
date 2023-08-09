<?php

namespace App\Models;

use CodeIgniter\Model;

class PaymentModel extends Model
{
    protected $table = 'payment';
    protected $primaryKey = 'id';
    protected $allowedFields = ['user_id', 'id_payment', 'transaksi_id','reservation_id', 'status', 'total_payment', 'payment_receipt', 'payment_date', 'payment_updated'];

    // Add your custom methods if needed
}
