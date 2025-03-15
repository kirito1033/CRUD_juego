<?php

namespace App\Controllers;

use App\Models\WarriorPowerModel;
use CodeIgniter\Controller;
use CodeIgniter\HTTP\ResponseInterface;



class WarriorPowerController extends Controller
{

    private $primarykey;
    private $WarriorPowerModel;
    private $data;
    private $model;
    
    public function __construct() 
    { 
        $this->primaryKey = "id"; 
        $this->WarriorPowerModel = new WarriorPowerModel(); 
        $this->data = []; 
        $this->model = "WarriorPowerModel"; 
    } 

  
    public function index() 
    { 
    $this->data['title'] = "WARRIOR POWER"; 
    $this->data[$this->model] = $this->WarriorPowerModel->orderBy($this->primaryKey, 'ASC')->findAll(); 

    // Cargar modelos de roles y estados
    $warrior_id = new \App\Models\WarriorModel();
    $power_id = new \App\Models\PowerModel();

    $this->data['warriors'] = $warrior_id->findAll();
    $this->data['powers'] = $power_id->findAll();

    return view('warriorpower/warriorpower_view', $this->data); 
    }
    
    

        
    public function create() 
    { 
        if ($this->request->isAJAX()) { 
         
            $dataModel = $this->getDataModel(); 

            
            if ($this->WarriorPowerModel->insert($dataModel)) { 
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

    
    public function singleWarriorPower($id = null) 
    { 
        if ($this->request->isAJAX()) { 

            if ($data[$this->model] = $this->WarriorPowerModel->where($this->primaryKey, $id)->first()) { 
                $data['message'] = 'success'; 
                $data['response'] = ResponseInterface::HTTP_OK; 
                $data['csrf'] = csrf_hash(); 
            } else { 
                $data['message'] = 'Error retrieving power'; 
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
                'id' => $this->request->getVar('id'), 
                'warrior_id' => $this->request->getVar('warrior_id'), 
                'power_id' => $this->request->getVar('power_id'), 
                'updated_at' => $today 
            ]; 
            
            if ($this->WarriorPowerModel->update($id, $dataModel)) { 
                $data['message'] = 'success'; 
                $data['response'] = ResponseInterface::HTTP_OK; 
                $data['data'] = $dataModel; 
                $data['csrf'] = csrf_hash(); 
            } else { 
                $data['message'] = 'Error updating WarriorPower'; 
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

            if ($this->WarriorPowerModel->where($this->primaryKey, $id)->delete($id)) { 
                $data['message'] = 'success'; 
                $data['response'] = ResponseInterface::HTTP_OK; 
                $data['data'] = "OK"; 
                $data['csrf'] = csrf_hash(); 
            } else { 
                $data['message'] = 'Error deleting WarriorPower'; 
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
            'id' => $this->request->getVar('id'), 
            'warrior_id' => $this->request->getVar('warrior_id'), 
            'power_id' => $this->request->getVar('power_id'), 
        ]; 
        return $data; 
    }

    

 
}