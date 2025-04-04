<?php

namespace App\Models;

use CodeIgniter\Model;

class PlayerModel extends Model
{
    protected $table = 'players';
    protected $primaryKey = 'id';
    protected $allowedFields = ['profile_id', 'wins'];

    public function getLeaderboard()
    {
    return $this->select('profiles.profile_name, players.wins')
                ->join('profiles', 'profiles.profile_id = players.profile_id')
                ->orderBy('players.wins', 'DESC')
                ->findAll();
    }
}