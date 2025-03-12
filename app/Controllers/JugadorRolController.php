<?php

namespace App\Controllers;

use App\Models\RoleModel;
use CodeIgniter\Controller;
use CodeIgniter\HTTP\ResponseInterface;



class JugadorRolController extends Controller
{

    private $primarykey;
    private $RolModel;
    private $data;
    private $model;
    
    public function __construct() 
    { 
        $this->primaryKey = "Roles_id"; 
        $this->RolModel = new RoleModel(); 
        $this->data = []; 
        $this->model = "jugadorRol"; 
    } 

  
    public function index() 
    { 
        $this->data['title'] = "JUGADOR ROL"; 
        $this->data[$this->model] = $this->RolModel->orderBy($this->primaryKey, 'ASC')->findAll(); 
        return view('jugadorRol/rol_view', $this->data); 
    }
    

        
    public function create() 
    { 
        if ($this->request->isAJAX()) { 
            $dataModel = $this->getDataModel(); 

            
            if ($this->RolModel->insert($dataModel)) { 
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

    
    public function singleJugadorRol($id = null) 
    { 
        if ($this->request->isAJAX()) { 

            if ($data[$this->model] = $this->RolModel->where($this->primaryKey, $id)->first()) { 
                $data['message'] = 'success'; 
                $data['response'] = ResponseInterface::HTTP_OK; 
                $data['csrf'] = csrf_hash(); 
            } else { 
                $data['message'] = 'Error retrieving user rol'; 
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
                'Roles_name' => $this->request->getVar('Roles_name'), 
                'Roles_description' => $this->request->getVar('Roles_description'), 
                'update_at' => $today 
            ]; 
            
            if ($this->RolModel->update($id, $dataModel)) { 
                $data['message'] = 'success'; 
                $data['response'] = ResponseInterface::HTTP_OK; 
                $data['data'] = $dataModel; 
                $data['csrf'] = csrf_hash(); 
            } else { 
                $data['message'] = 'Error updating user rol'; 
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

            if ($this->RolModel->where($this->primaryKey, $id)->delete($id)) { 
                $data['message'] = 'success'; 
                $data['response'] = ResponseInterface::HTTP_OK; 
                $data['data'] = "OK"; 
                $data['csrf'] = csrf_hash(); 
            } else { 
                $data['message'] = 'Error deleting rol'; 
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
            'Roles_id' => $this->request->getVar('Roles_id'), 
            'Roles_name' => $this->request->getVar('Roles_name'), 
            'Roles_description' => $this->request->getVar('Roles_description'), 
            'update_at' => $this->request->getVar('update_at') 
        ]; 
        return $data; 
    }

    

 
}