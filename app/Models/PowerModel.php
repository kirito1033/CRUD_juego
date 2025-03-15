<?php

namespace App\Models;

use CodeIgniter\Model;

class PowerModel extends Model
{
    protected $table            = 'powers';
    protected $primaryKey       = 'power_id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['power_id','name', 'description', 'percentage', 'updated_at'];

    protected bool $allowEmptyInserts = false;
    
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    

}
