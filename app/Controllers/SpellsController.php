<?php

namespace App\Controllers;

use App\Models\SpellsModel;
use CodeIgniter\Controller;
use CodeIgniter\HTTP\ResponseInterface;



class SpellsController extends Controller
{

    private $primarykey;
    private $SpellModel;
    private $data;
    private $model;
    
    public function __construct() 
    { 
        $this->primaryKey = "spell_id"; 
        $this->SpellModel = new SpellsModel(); 
        $this->data = []; 
        $this->model = "SpellModel"; 
    } 

  
    public function index() 
    { 
        $this->data['title'] = "SPELLS"; 
        $this->data[$this->model] = $this->SpellModel->orderBy($this->primaryKey, 'ASC')->findAll(); 
        return view('spells/spells_view', $this->data); 
    }
    

        
    public function create() 
    { 
        if ($this->request->isAJAX()) { 
         
            $dataModel = $this->getDataModel(); 

            
            if ($this->SpellModel->insert($dataModel)) { 
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

    
    public function singleSpells($id = null) 
    { 
        if ($this->request->isAJAX()) { 

            if ($data[$this->model] = $this->SpellModel->where($this->primaryKey, $id)->first()) { 
                $data['message'] = 'success'; 
                $data['response'] = ResponseInterface::HTTP_OK; 
                $data['csrf'] = csrf_hash(); 
            } else { 
                $data['message'] = 'Error retrieving spells'; 
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
            
            if ($this->SpellModel->update($id, $dataModel)) { 
                $data['message'] = 'success'; 
                $data['response'] = ResponseInterface::HTTP_OK; 
                $data['data'] = $dataModel; 
                $data['csrf'] = csrf_hash(); 
            } else { 
                $data['message'] = 'Error updating spells'; 
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

            if ($this->SpellModel->where($this->primaryKey, $id)->delete($id)) { 
                $data['message'] = 'success'; 
                $data['response'] = ResponseInterface::HTTP_OK; 
                $data['data'] = "OK"; 
                $data['csrf'] = csrf_hash(); 
            } else { 
                $data['message'] = 'Error deleting spells'; 
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
            'spell_id' => $this->request->getVar('spell_id'), 
            'name' => $this->request->getVar('name'), 
            'description' => $this->request->getVar('description'), 
            'percentage' => $this->request->getVar('percentage'), 
            'update_at' => $this->request->getVar('update_at') 
        ]; 
        return $data; 
    }

    

 
}