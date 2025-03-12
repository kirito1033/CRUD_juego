<?php

namespace App\Controllers;

use App\Models\JugadorStatusModel;
use CodeIgniter\Controller;
use CodeIgniter\HTTP\ResponseInterface;



class JugadorStatus extends Controller
{

    private $primarykey;
    private $StatusModel;
    private $data;
    private $model;
    
    public function __construct() 
    { 
        $this->primaryKey = "Jugador_status_id"; 
        $this->StatusModel = new JugadorStatusModel(); 
        $this->data = []; 
        $this->model = "jugadorStatus"; 
    } 

  
    public function index() 
    { 
        $this->data['title'] = "JUGADOR STATUS"; 
        $this->data[$this->model] = $this->StatusModel->orderBy($this->primaryKey, 'ASC')->findAll(); 
        return view('jugadorStatus/status_view', $this->data); 
    }
    

        
    public function create() 
    { 
        if ($this->request->isAJAX()) { 
            $dataModel = new JugadorRolModel();
            $dataModel = $this->getDataModel(); 

            
            if ($this->StatusModel->insert($dataModel)) { 
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

    
    public function singleJugadorStatus($id = null) 
    { 
        if ($this->request->isAJAX()) { 

            if ($data[$this->model] = $this->StatusModel->where($this->primaryKey, $id)->first()) { 
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
                'Jugador_status_name' => $this->request->getVar('Jugador_status_name'), 
                'Jugador_status_description' => $this->request->getVar('Jugador_status_description'), 
                'update_at' => $today 
            ]; 
            
            if ($this->StatusModel->update($id, $dataModel)) { 
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

            if ($this->StatusModel->where($this->primaryKey, $id)->delete($id)) { 
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
        $data = [ 
            'Jugador_status_id' => $this->request->getVar('Jugador_status_id'), 
            'Jugador_status_name' => $this->request->getVar('Jugador_status_name'), 
            'Jugador_status_description' => $this->request->getVar('Jugador_status_description'), 
            'update_at' => $this->request->getVar('update_at') 
        ]; 
        return $data; 
    }

    

 
}