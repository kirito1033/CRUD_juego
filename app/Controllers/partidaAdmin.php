<?php

namespace App\Controllers;

use App\Models\PartidaModel;
use CodeIgniter\Controller;
use CodeIgniter\HTTP\ResponseInterface;


class partidaAdmin extends Controller
{

    private $primarykey;
    private $partidaModel;
    private $data;
    private $model;
    
    public function __construct() 
    { 
        $this->primaryKey = "id"; 
        $this->partidaModel = new PartidaModel(); 
        $this->data = []; 
        $this->model = "partidaModel"; 
    } 

  
    public function index() 
    { 
        $this->data['title'] = "PARTIDAS"; 
        $this->data[$this->model] = $this->partidaModel->orderBy($this->primaryKey, 'ASC')->findAll(); 
        return view('juegoadmin/juegoadmin_view', $this->data); 
    }
    

        
    public function create() 
    { 
        if ($this->request->isAJAX()) { 
         
            $dataModel = $this->getDataModel(); 

            
            if ($this->partidaModel->insert($dataModel)) { 
                $data['message'] = 'success'; 
                $data['response'] = ResponseInterface::HTTP_OK; 
                $data['data'] = $dataModel; 
                $data['csrf'] = csrf_hash(); 
            } else { 
                $data['message'] = 'Error creating user'; 
                $data['response'] = ResponseInterface::HTTP_NO_CONTENT; 
                $data['data'] = ''; 
            } 
        } else { 
            $data['message'] = 'Error Ajax'; 
            $data['response'] = ResponseInterface::HTTP_CONFLICT; 
            $data['data'] = ''; 
        } 
        echo json_encode($dataModel); 
    }

    
    public function singlePartida($id = null) 
    { 
        if ($this->request->isAJAX()) { 

            if ($data[$this->model] = $this->partidaModel->where($this->primaryKey, $id)->first()) { 
                $data['message'] = 'success'; 
                $data['response'] = ResponseInterface::HTTP_OK; 
                $data['csrf'] = csrf_hash(); 
            } else { 
                $data['message'] = 'Error retrieving user status'; 
                $data['response'] = ResponseInterface::HTTP_NO_CONTENT; 
                $data['data'] = ''; 
            } 
        } else { 
            $data['message'] = 'Error Ajax'; 
            $data['response'] = ResponseInterface::HTTP_CONFLICT; 
            $data['data'] = ''; 
        } 

        echo json_encode($data);  
    }


    
    public function update() 
    { 
        
        if ($this->request->isAJAX()) { 
            $today = date("Y-m-d H:i:s"); 
            $id = $this->request->getVar($this->primaryKey); 
            
            $dataModel = [
                'game_name' => $this->request->getVar('game_name'),
                'game_mode' => $this->request->getVar('game_mode'),
                'duration' => $this->request->getVar('duration'),
                'win_condition' => $this->request->getVar('win_condition'),
                'player_life' => $this->request->getVar('player_life'),
                'status' => $this->request->getVar('status') ?? 'esperando_jugador',
                'token' => $this->request->getVar('token'),
                'expires_at' => $expiresAt->format('Y-m-d H:i:s'),
                'update_at' => $today 
            ]; 
            
            if ($this->partidaModel->update($id, $dataModel)) { 
                $data['message'] = 'success'; 
                $data['response'] = ResponseInterface::HTTP_OK; 
                $data['data'] = $dataModel; 
                $data['csrf'] = csrf_hash(); 
            } else { 
                $data['message'] = 'Error updating user status'; 
                $data['response'] = ResponseInterface::HTTP_NO_CONTENT; 
                $data['data'] = ''; 
            } 
        } else { 
            $data['message'] = 'Error Ajax'; 
            $data['response'] = ResponseInterface::HTTP_CONFLICT; 
            $data['data'] = ''; 
        } 
        
        echo json_encode($dataModel); 
    }

       
    public function delete($id = null) 
    { 
        try { 

            if ($this->partidaModel->where($this->primaryKey, $id)->delete($id)) { 
                $data['message'] = 'success'; 
                $data['response'] = ResponseInterface::HTTP_OK; 
                $data['data'] = "OK"; 
                $data['csrf'] = csrf_hash(); 
            } else { 
                $data['message'] = 'Error deleting status'; 
                $data['response'] = ResponseInterface::HTTP_CONFLICT; 
                $data['data'] = 'error'; 
            } 
        } catch (\Exception $e) { 
            $data['message'] = $e; 
            $data['response'] = ResponseInterface::HTTP_CONFLICT; 
            $data['data'] = 'Error'; 
        } 
        
        echo json_encode($data);  
    }

   public function getDataModel() 
    {
        $durationMinutes = intval($this->request->getVar('duration'));

        $now = new \DateTime();
        $expiresAt = clone $now;
        $expiresAt->modify("+$durationMinutes minutes");

        $token = bin2hex(random_bytes(16)); // Genera un token aleatorio de 32 caracteres

        return [ 
            'id' => $this->request->getVar('id'),
            'game_name' => $this->request->getVar('game_name'),
            'game_mode' => $this->request->getVar('game_mode'),
            'duration' => $durationMinutes,
            'win_condition' => $this->request->getVar('win_condition'),
            'player_life' => $this->request->getVar('player_life'),
            'status' => 'Publica',
            'token' => $token,
            'expires_at' => $expiresAt->format('Y-m-d H:i:s'), // nuevo campo en BD
            'update_at' => $now->format('Y-m-d H:i:s')
        ]; 
    }

    
}