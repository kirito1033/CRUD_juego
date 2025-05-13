<?php
namespace App\Controllers;

use App\Models\WarriorModel;
use App\Models\PartidaModel;
use App\Models\ProfileModel; 
use App\Models\JugadorModel;
use CodeIgniter\Controller;

class Partidas extends Controller {

    protected $partidaModel;
    protected $profileModel;
    protected $jugadorModel;
    protected $session;

    public function __construct() {
        $this->partidaModel = new PartidaModel();
        $this->jugadorModel = new JugadorModel();
        $this->profileModel = new ProfileModel(); 
        $this->session = session(); // Iniciar sesión
    }
    public function index()
    {
    
        $data['partidas'] = $this->partidaModel->findAll(); // Obtiene todas las partidas
      
        return view('juego/crear_view', $data);
    }

    public function store() {
        $data = [
            'game_name' => $this->request->getPost('game_name'),
            'game_mode' => $this->request->getPost('game_mode'),
            'duration' => $this->request->getPost('duration'),
            'win_condition' => $this->request->getPost('win_condition'),
            'player_life' => $this->request->getPost('player_life'),
            'password' => $this->request->getPost('password_enabled') ? password_hash($this->request->getPost('password'), PASSWORD_BCRYPT) : null,
            'status' => 'esperando_jugador', // Usar 'status' en lugar de 'estado'
        ];
    
        $this->partidaModel->insert($data);
        return redirect()->to('/partidas')->with('success', 'Partida creada, esperando jugadores.');
    }
    
    public function getWarriorsWithDetails()
{
    return $this->select('
            warrior.*, 
            race.name as race, 
            warrior.health as life, 
            warrior.total_power as damage,
            powers.name as power_name, 
            powers.percentage as power_percentage,
            spells.name as spell_name  -- Cambiado de spell a spells
        ')
        ->join('race', 'race.race_id = warrior.race_id', 'left')
        ->join('powers', 'powers.power_id = warrior.type_id', 'left')  
        ->join('spells', 'spells.spell_id = warrior.type_id', 'left')  // Cambiado de spell a spells
        ->findAll();
}

    

    public function mostrarUltimaPartida($id) {
        $session = session();

        $tokenJugador1 = $session->get('token_jugador1');
        $tokenJugador2 = $session->get('token_jugador2');

        log_message('debug', 'Token Jugador 1 en sesión: ' . ($tokenJugador1 ?? 'NULL'));
        log_message('debug', 'Token Jugador 2 en sesión: ' . ($tokenJugador2 ?? 'NULL'));

        // Redirigir si algún jugador no está autenticado
        if (!$tokenJugador1 || !$tokenJugador2) {
            return redirect()->to('/auth/login')->with('error', 'Ambos jugadores deben estar logueados.');
        }

        // Obtener perfiles desde ProfileModel con el jugador_id_fk
        $profile1 = $this->profileModel->where('jugador_id_fk', $session->get('jugador1_id'))->first();
        $profile2 = $this->profileModel->where('jugador_id_fk', $session->get('jugador2_id'))->first();

        if (!$profile1 || !$profile2) {
            return redirect()->to('/auth/login')->with('error', 'Error al obtener los perfiles de los jugadores.');
        }

        // Extraer nombre e imagen del perfil
        $data['profile1'] = [
            'profile_id' => $profile1['profile_id'],
            'profile_name' => $profile1['profile_name'],
            'profile_photo' => $profile1['profile_photo'] ?? 'default_profile.png'
        ];

        $data['profile2'] = [
            'profile_id' => $profile2['profile_id'],
            'profile_name' => $profile2['profile_name'],
            'profile_photo' => $profile2['profile_photo'] ?? 'default_profile.png'
        ];

        // Obtener guerreros
        $warriorModel = new WarriorModel();
        $data['partida'] = $this->partidaModel->find($id);
        $data['warriors'] = $warriorModel->getWarriorsWithDetails();

        return view('partidas/ultima_partida', $data);
    }
    public function iniciarBatalla($partida_id)
    {
        $this->partidaModel->update($partida_id, ['estado' => 'en_batalla']);
    }
    public function finalizarPartida($partida_id)
    {
        $this->partidaModel->update($partida_id, ['estado' => 'finalizada']);
    }
    public function listarPartidas() {
        $partidas = $this->partidaModel->whereIn('status', ['esperando_jugador', 'publica'])->findAll();

        $now = new \DateTime();

        foreach ($partidas as &$partida) {
            // Calcular el tiempo restante
            if (!empty($partida['expires_at'])) {
                $expiresAt = new \DateTime($partida['expires_at']);
                $interval = $now->diff($expiresAt);

                // Formatear: días, horas, minutos
                $partida['tiempo_restante'] = $expiresAt > $now 
                    ? $interval->format('%ad %hh %im')
                    : 'Expirada';
            } else {
                $partida['tiempo_restante'] = 'Sin límite';
            }
        }

        return view('partidas/listar', ['partidas' => $partidas]);
    }

    
    public function unirsePartida($id) {
    $session = session();
    $jugador_id = $session->get('jugador_id_fk');

    // Verificar si la partida existe
    $partida = $this->partidaModel->find($id);

    if (!$partida) {
        return redirect()->to('/partidas')->with('error', 'La partida no existe.');
    }

    // Verificar si ha expirado
    if (!empty($partida['expires_at'])) {
        $now = new \DateTime();
        $expiresAt = new \DateTime($partida['expires_at']);

        if ($now > $expiresAt) {
            // Cambiar el estado de la partida a finalizado si ya expiró
            $this->partidaModel->update($id, ['status' => 'finalizado']);
            return redirect()->to('/partidas')->with('error', 'La partida ha expirado.');
        }
    }

    // Verificar si está en un estado válido
    if (!isset($partida['status']) || !in_array($partida['status'], ['esperando_jugador', 'publica'])) {
        return redirect()->to('/partidas')->with('error', 'La partida no está disponible.');
    }

    // Asignar el jugador 2 y cambiar el estado a en_batalla
    $this->partidaModel->update($id, [
        'jugador2_id_fk' => $jugador_id,
        'status' => 'en_batalla'
    ]);

    return redirect()->to('/partidas/mostrarUltimaPartida/' . $id);
}

    
    public function joinGame($token)
    {
    $partida = $this->partidaModel->where('token', $token)->first();

    if (!$partida) {
        return $this->failNotFound('Token inválido.');
    }

    $now = new \DateTime();
    $expiresAt = new \DateTime($partida['expires_at']);

    if ($now > $expiresAt) {
        $this->partidaModel->update($partida['id'], ['status' => 'finalizado']);
        return $this->fail('La partida ha expirado.');
    }

    // Puedes devolver info o redirigir según tu lógica
    return $this->respond($partida); 
    }
    public function verificarToken()
    {
    $data = json_decode($this->request->getBody(), true);
    $id = $data['id'] ?? null;
    $tokenInput = $data['token'] ?? null;

    $model = new \App\Models\PartidaModel();
    $partida = $model->find($id);

    if ($partida && $partida['token'] === $tokenInput) {
        return $this->response->setJSON(['success' => true]);
    }

    return $this->response->setJSON(['success' => false]);
    }

}