<?php

namespace App\Controllers;

use App\Models\JugadorModel;
use CodeIgniter\Controller;
use CodeIgniter\HTTP\ResponseInterface;



class JugadorController extends Controller
{

    private $primarykey;
    private $jugador;
    private $data;
    private $model;
    
    public function __construct() 
    { 
        $this->primaryKey = "jugador_id"; 
        $this->jugadorModel = new JugadorModel(); 
        $this->data = []; 
        $this->model = "jugadorModel"; 
    } 

  
    public function index() 
    { 
    $this->data['title'] = "JUGADOR"; 
    $this->data[$this->model] = $this->jugadorModel->orderBy($this->primaryKey, 'ASC')->findAll(); 

    // Cargar modelos de roles y estados
    $roleModel = new \App\Models\RoleModel();
    $statusModel = new \App\Models\JugadorStatusModel();

    $this->data['roles'] = $roleModel->findAll();
    $this->data['estados'] = $statusModel->findAll();

    return view('jugador/jugador_view', $this->data); 
    }
    
    public function create() 
    { 
        if ($this->request->isAJAX()) { 
         
            $dataModel = $this->getDataModel(); 

            
            if ($this->jugadorModel->insert($dataModel)) { 
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

    
    public function singleJugador($id = null) 
    { 
        if ($this->request->isAJAX()) { 

            if ($data[$this->model] = $this->jugadorModel->where($this->primaryKey, $id)->first()) { 
                $data['message'] = 'success'; 
                $data['response'] = ResponseInterface::HTTP_OK; 
                $data['csrf'] = csrf_hash(); 
            } else { 
                $data['message'] = 'Error retrieving jugador'; 
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
                'jugador_name' => $this->request->getVar('jugador_name'), 
                'jugador_password' => password_hash($this->request->getVar('jugador_password'), PASSWORD_DEFAULT),
                'roles_fk' => $this->request->getVar('roles_fk'), 
                'jugador_status_fk' => $this->request->getVar('jugador_status_fk'), 
                'update_at' => $today 
            ]; 
            
            if ($this->jugadorModel->update($id, $dataModel)) { 
                $data['message'] = 'success'; 
                $data['response'] = ResponseInterface::HTTP_OK; 
                $data['data'] = $dataModel; 
                $data['csrf'] = csrf_hash(); 
            } else { 
                $data['message'] = 'Error updating jugador'; 
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

            if ($this->jugadorModel->where($this->primaryKey, $id)->delete($id)) { 
                $data['message'] = 'success'; 
                $data['response'] = ResponseInterface::HTTP_OK; 
                $data['data'] = "OK"; 
                $data['csrf'] = csrf_hash(); 
            } else { 
                $data['message'] = 'Error deleting jugador'; 
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
            'jugador_id' => $this->request->getVar('jugador_id'), 
            'jugador_name' => $this->request->getVar('jugador_name'), 
           'jugador_password' => password_hash($this->request->getVar('jugador_password'), PASSWORD_DEFAULT),
            'roles_fk' => $this->request->getVar('roles_fk'), 
            'jugador_status_fk' => $this->request->getVar('jugador_status_fk'), 
            'update_at' => $this->request->getVar('update_at') 
        ]; 
        return $data; 
    }

    
    
 
}