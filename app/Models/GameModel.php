<?php

namespace App\Models;
use CodeIgniter\Model;

class GameModel extends Model
{
    protected $table = 'players';
    protected $primaryKey = 'id';
    protected $allowedFields = ['name', 'wins'];

    public function addWin($playerName)
    {
        // Verificar si el jugador ya existe
        $player = $this->where('name', $playerName)->first();

        if ($player) {
            // Incrementar el contador de victorias
            $this->set('wins', 'wins + 1', false)
                 ->where('name', $playerName)
                 ->update();
        } else {
            // Insertar el jugador con 1 victoria
            $this->insert(['name' => $playerName, 'wins' => 1]);
        }
    }

    public function getLeaderboard()
    {
        return $this->orderBy('wins', 'DESC')->findAll();
    }
}
