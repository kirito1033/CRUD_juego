<?php

namespace App\Models;

use CodeIgniter\Model;

class WarriorTypeModel extends Model
{
    protected $table            = 'warrior_type';
    protected $primaryKey       = 'type_id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['type_id','name', 'description', 'updated_at'];

    protected bool $allowEmptyInserts = false;
    
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    

}
