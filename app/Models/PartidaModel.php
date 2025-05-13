<?php

namespace App\Models;

use CodeIgniter\Model;

class PartidaModel extends Model {
    
    protected $table = 'partidas'; 
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields = [ 'id','game_name', 'game_mode', 'duration', 'win_condition', 'status', 'player_life', 'token', 'expires_at'];

    protected bool $allowEmptyInserts = false;
  
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

   

    public function insertPartida($data) {
        $this->insert($data);
        return $this->insertID(); // Retorna el ID insertado
    }

    public function getById($id) {
        return $this->find($id);
    }
}