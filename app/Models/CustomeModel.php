<?php

namespace App\Models;

use CodeIgniter\Model;

class CustomeModel extends Model
{
    protected $table = 'custom';
    protected $primaryKey = 'id';
    protected $allowedFields = ['user_id', 'produk_id', 'custom_option_1', 'custom_option_2', 'custom_option_3'];

    // Add your custom methods if needed
}
