<?php
namespace App\Controllers;
use App\Models\PlayerModel;
use CodeIgniter\HTTP\ResponseInterface;

class PlayerController extends BaseController
{
    public function updateWins()
    {
        $db = \Config\Database::connect();
        $json = $this->request->getJSON();
    
        // Verificar si se recibió el ID del perfil
        if (!isset($json->profile_id)) {
            return $this->response->setJSON(['success' => false, 'error' => 'Falta el ID del perfil']);
        }
    
        $profile_id = $json->profile_id;  // Ahora deberías tener el profile_id
    
        $builder = $db->table('players');
    
        // Verificar si el perfil ya existe en la tabla
        $existingRow = $builder->where('profile_id', $profile_id)->get()->getRowArray();
    
        if ($existingRow) {
            // Si el perfil existe, aumentar victorias en +1
            $newWins = $existingRow['wins'] + 1;
            $builder->where('profile_id', $profile_id)->update(['wins' => $newWins]);
        } else {
            // Si no existe, insertarlo con 1 victoria
            $newWins = 1;
            $builder->insert(['profile_id' => $profile_id, 'wins' => $newWins]);
        }
    
        return $this->response->setJSON(['success' => true, 'wins' => $newWins]);
    }

    public function showLeaderboard()
    {
        $playerModel = new \App\Models\PlayerModel();
        $data['players'] = $playerModel->getLeaderboard();

        return view('players_table', $data);
    }
}
