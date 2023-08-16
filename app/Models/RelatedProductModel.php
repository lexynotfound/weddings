<?php

namespace App\Models;

use CodeIgniter\Model;

class RelatedProductModel extends Model
{
    protected $table = 'related_produk';
    protected $primaryKey = 'id';
    protected $allowedFields = ['produk_id', 'menu_id','created_at'];
}
