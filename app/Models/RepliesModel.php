<?php

namespace App\Models;

use CodeIgniter\Model;

class RepliesModel extends Model
{
    protected $table = 'replies';
    protected $primaryKey = 'id';
    protected $returnType = 'array';
    protected $useSoftDeletes = true;
    protected $allowedFields = ['user_id', 'review_id', 'reply', 'created_at', 'updated_at', 'deleted_at'];

    // Add your custom methods if needed
    /* protected $useTimestamps  = true; */
   /*  protected $createdField   = 'created_at';
    protected $updatedField   = 'updated_at';
    protected $deletedField   = 'deleted_at'; */
}
