<?php

namespace App\Controllers;

use App\Models\WarriorTypeModel;
use CodeIgniter\Controller;
use CodeIgniter\HTTP\ResponseInterface;



class WarriorTypeController extends Controller
{

    private $primarykey;
    private $WarriorTypeModel;
    private $data;
    private $model;
    
    public function __construct() 
    { 
        $this->primaryKey = "type_id"; 
        $this->WarriorTypeModel = new WarriorTypeModel(); 
        $this->data = []; 
        $this->model = "WarriorTypeModel"; 
    } 

  
    public function index() 
    { 
        $this->data['title'] = "WARRIOR TYPE"; 
        $this->data[$this->model] = $this->WarriorTypeModel->orderBy($this->primaryKey, 'ASC')->findAll(); 
        return view('warriortype/warriortype_view', $this->data); 
    }
    

        
    public function create() 
    { 
        if ($this->request->isAJAX()) { 
         
            $dataModel = $this->getDataModel(); 

            
            if ($this->WarriorTypeModel->insert($dataModel)) { 
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

    
    public function singleWarriorType($id = null) 
    { 
        if ($this->request->isAJAX()) { 

            if ($data[$this->model] = $this->WarriorTypeModel->where($this->primaryKey, $id)->first()) { 
                $data['message'] = 'success'; 
                $data['response'] = ResponseInterface::HTTP_OK; 
                $data['csrf'] = csrf_hash(); 
            } else { 
                $data['message'] = 'Error retrieving WarriorType'; 
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
                'name' => $this->request->getVar('name'), 
                'description' => $this->request->getVar('description'), 
                'updated_at' => $today 
            ]; 
            
            if ($this->WarriorTypeModel->update($id, $dataModel)) { 
                $data['message'] = 'success'; 
                $data['response'] = ResponseInterface::HTTP_OK; 
                $data['data'] = $dataModel; 
                $data['csrf'] = csrf_hash(); 
            } else { 
                $data['message'] = 'Error updating WarriorType'; 
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

            if ($this->WarriorTypeModel->where($this->primaryKey, $id)->delete($id)) { 
                $data['message'] = 'success'; 
                $data['response'] = ResponseInterface::HTTP_OK; 
                $data['data'] = "OK"; 
                $data['csrf'] = csrf_hash(); 
            } else { 
                $data['message'] = 'Error deleting WarriorType'; 
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
            'type_id' => $this->request->getVar('type_id'), 
            'name' => $this->request->getVar('name'), 
            'description' => $this->request->getVar('description'), 
            'update_at' => $this->request->getVar('update_at') 
        ]; 
        return $data; 
    }

    

 
}