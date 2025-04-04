<?php

namespace App\Controllers;

use App\Models\WarriorModel;
use App\Models\GameModel;
use CodeIgniter\RESTful\ResourceController;

class BattleController extends ResourceController
{
    public function index()
    {
        return view('battle_view'); // Vista de la pelea
    }

    public function fight()
    {
        // Obtener IDs de los guerreros de la petición
        $idJugador1 = $this->request->getPost('player1_id');
        $idJugador2 = $this->request->getPost('player2_id');

        if (!$idJugador1 || !$idJugador2) {
            return $this->respond(['error' => 'Selecciona dos guerreros para iniciar la pelea.'], 400);
        }

        // Cargar modelos de guerreros
        $warriorModel = new WarriorModel();
        $warrior1 = $warriorModel->find($idJugador1);
        $warrior2 = $warriorModel->find($idJugador2);

        if (!$warrior1 || !$warrior2) {
            return $this->respond(['error' => 'Uno o ambos guerreros no existen.'], 404);
        }

        // Importar la lógica de counters
        require APPPATH . 'Config/counters.php'; 

        // Determinar el resultado
        $resultado = $this->determinarResultado($idJugador1, $idJugador2, $counters);

        return $this->respond(['resultado' => $resultado, 'warrior1' => $warrior1, 'warrior2' => $warrior2], 200);
    }

    private function determinarResultado($id1, $id2, $counters)
    {
        if (isset($counters[$id1])) {
            if (in_array($id2, $counters[$id1]['gana'])) {
                return "Jugador 1 gana";
            } elseif (in_array($id2, $counters[$id1]['pierde'])) {
                return "Jugador 2 gana";
            } elseif (in_array($id2, $counters[$id1]['empata'])) {
                return "Empate";
            }
        }
        return "Resultado desconocido";
    }
}
