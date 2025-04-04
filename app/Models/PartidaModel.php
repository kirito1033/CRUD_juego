<?php

namespace App\Models;

use CodeIgniter\Model;

class PartidaModel extends Model {
    protected $table = 'partidas'; 
    protected $primaryKey = 'id';
    protected $allowedFields = ['game_name', 'game_mode', 'duration', 'win_condition', 'player_life', 'status', 'password'];

    public function insertPartida($data) {
        $this->insert($data);
        return $this->insertID(); // Retorna el ID insertado
    }

    public function getById($id) {
        return $this->find($id);
    }
}