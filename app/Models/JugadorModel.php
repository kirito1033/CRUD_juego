<?php

namespace App\Models;

use CodeIgniter\Model;

class JugadorModel extends Model
{
    protected $table            = 'jugadores';
    protected $primaryKey       = 'jugador_id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['jugador_id', 'jugador_name', 'jugador_password', 'roles_fk', 'jugador_status_fk', 'update_at'];

    protected bool $allowEmptyInserts = false;
    
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    public function getJugadorConRol($jugador_id)
    {
        return $this->select('jugadores.*, jugador_roles.Roles_name AS role_name') // 🔹 Asignamos alias 'role_name'
            ->join('jugador_roles', 'jugadores.roles_fk = jugador_roles.Roles_id', 'left') // 🔹 Unimos con jugador_roles
            ->where('jugadores.jugador_id', $jugador_id)
            ->first();
    }
    
    
}

