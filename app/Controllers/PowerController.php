<?php

namespace App\Controllers;

use App\Models\PowerModel;
use CodeIgniter\Controller;
use CodeIgniter\HTTP\ResponseInterface;



class PowerController extends Controller
{

    private $primarykey;
    private $PowerModel;
    private $data;
    private $model;
    
    public function __construct() 
    { 
        $this->primaryKey = "power_id"; 
        $this->PowerModel = new PowerModel(); 
        $this->data = []; 
        $this->model = "PowerModel"; 
    } 

  
    public function index() 
    { 
        $this->data['title'] = "POWER"; 
        $this->data[$this->model] = $this->PowerModel->orderBy($this->primaryKey, 'ASC')->findAll(); 
        return view('power/power_view', $this->data); 
    }
    

        
    public function create() 
    { 
        if ($this->request->isAJAX()) { 
         
            $dataModel = $this->getDataModel(); 

            
            if ($this->PowerModel->insert($dataModel)) { 
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

    
    public function singlePower($id = null) 
    { 
        if ($this->request->isAJAX()) { 

            if ($data[$this->model] = $this->PowerModel->where($this->primaryKey, $id)->first()) { 
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
                'name' => $this->request->getVar('name'), 
                'description' => $this->request->getVar('description'), 
                'percentage' => $this->request->getVar('percentage'), 
                'updated_at' => $today 
            ]; 
            
            if ($this->PowerModel->update($id, $dataModel)) { 
                $data['message'] = 'success'; 
                $data['response'] = ResponseInterface::HTTP_OK; 
                $data['data'] = $dataModel; 
                $data['csrf'] = csrf_hash(); 
            } else { 
                $data['message'] = 'Error updating power'; 
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

            if ($this->PowerModel->where($this->primaryKey, $id)->delete($id)) { 
                $data['message'] = 'success'; 
                $data['response'] = ResponseInterface::HTTP_OK; 
                $data['data'] = "OK"; 
                $data['csrf'] = csrf_hash(); 
            } else { 
                $data['message'] = 'Error deleting power'; 
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
            'power_id' => $this->request->getVar('power_id'), 
            'name' => $this->request->getVar('name'), 
            'description' => $this->request->getVar('description'), 
            'percentage' => $this->request->getVar('percentage'), 
            'update_at' => $this->request->getVar('update_at') 
        ]; 
        return $data; 
    }

    

 
}