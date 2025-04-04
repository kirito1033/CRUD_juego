<?php

namespace App\Models;

use CodeIgniter\Model;

class WarriorModel extends Model
{
    protected $table            = 'warrior';
    protected $primaryKey       = 'warrior_id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['warrior_id', 'name', 'total_power', 'total_magic', 'health', 'speed', 'intelligence', 'status', 'type_id', 'race_id', 'image', 'updated_at'];

    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    public function getWarriorsWithDetails()
    {
    return $this->db->table('warrior w')
        ->select('
            w.warrior_id as warrior_id, w.name as warrior_name, w.image as warrior_image, 
            w.race_id as warrior_race, w.health as warrior_life, w.total_power as warrior_damage,
            p.power_id as power_id, p.name as power_name, p.percentage as power_percentage, 
            s.spell_id as spell_id, s.name as spell_name, s.percentage as spell_percentage
        ')
        ->join('warrior_powers wp', 'w.warrior_id = wp.warrior_id', 'left')
        ->join('powers p', 'wp.power_id = p.power_id', 'left')
        ->join('warrior_spells ws', 'w.warrior_id = ws.warrior_id', 'left')
        ->join('spells s', 'ws.spell_id = s.spell_id', 'left')
        ->get()
        ->getResultArray();
    }

}