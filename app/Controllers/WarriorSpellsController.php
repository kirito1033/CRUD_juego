<?php

namespace App\Controllers;

use App\Models\WarriorSpellsModel;
use CodeIgniter\Controller;
use CodeIgniter\HTTP\ResponseInterface;



class WarriorSpellsController extends Controller
{

    private $primarykey;
    private $WarriorSpellsModel;
    private $data;
    private $model;
    
    public function __construct() 
    { 
        $this->primaryKey = "id"; 
        $this->WarriorSpellsModel = new WarriorSpellsModel(); 
        $this->data = []; 
        $this->model = "WarriorSpellsModel"; 
    } 

  
    public function index() 
    { 
    $this->data['title'] = "WARRIOR SPELLS"; 
    $this->data[$this->model] = $this->WarriorSpellsModel->orderBy($this->primaryKey, 'ASC')->findAll(); 

    // Cargar modelos de roles y estados
    $warrior_id = new \App\Models\WarriorModel();
    $spell_id = new \App\Models\SpellsModel();

    $this->data['warriors'] = $warrior_id->findAll();
    $this->data['spells'] = $spell_id->findAll();

    return view('warriorspells/warriorspells_view', $this->data); 
    }
    
    

        
    public function create() 
    { 
        if ($this->request->isAJAX()) { 
         
            $dataModel = $this->getDataModel(); 

            
            if ($this->WarriorSpellsModel->insert($dataModel)) { 
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

    
    public function singleWarriorSpells($id = null) 
    { 
        if ($this->request->isAJAX()) { 

            if ($data[$this->model] = $this->WarriorSpellsModel->where($this->primaryKey, $id)->first()) { 
                $data['message'] = 'success'; 
                $data['response'] = ResponseInterface::HTTP_OK; 
                $data['csrf'] = csrf_hash(); 
            } else { 
                $data['message'] = 'Error retrieving WarriorSpells'; 
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
                'spell_id' => $this->request->getVar('spell_id'), 
                'updated_at' => $today 
            ]; 
            
            if ($this->WarriorSpellsModel->update($id, $dataModel)) { 
                $data['message'] = 'success'; 
                $data['response'] = ResponseInterface::HTTP_OK; 
                $data['data'] = $dataModel; 
                $data['csrf'] = csrf_hash(); 
            } else { 
                $data['message'] = 'Error updating WarriorSpells'; 
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

            if ($this->WarriorSpellsModel->where($this->primaryKey, $id)->delete($id)) { 
                $data['message'] = 'success'; 
                $data['response'] = ResponseInterface::HTTP_OK; 
                $data['data'] = "OK"; 
                $data['csrf'] = csrf_hash(); 
            } else { 
                $data['message'] = 'Error deleting WarriorSpells'; 
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
            'spell_id' => $this->request->getVar('spell_id'), 
        ]; 
        return $data; 
    }

    

 
}