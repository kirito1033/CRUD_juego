<?php

namespace App\Controllers;

use App\Models\ProfileModel;
use CodeIgniter\Controller;
use CodeIgniter\HTTP\ResponseInterface;



class ProfileController extends Controller
{

    private $primarykey;
    private $profile;
    private $data;
    private $model;
    
    public function __construct() 
    { 
        $this->primaryKey = "profile_id"; 
        $this->profileModel = new ProfileModel(); 
        $this->data = []; 
        $this->model = "profileModel"; 
    } 

  
    public function index() 
    { 
    $this->data['title'] = "profile"; 
    $this->data[$this->model] = $this->profileModel->orderBy($this->primaryKey, 'ASC')->findAll(); 

    $jugadorModel = new \App\Models\jugadorModel();
   
    $this->data['jugadores'] = $jugadorModel->findAll();

    return view('profile/profile_view', $this->data); 
    }
    
    public function create() 
    { 
        if ($this->request->isAJAX()) { 
         
            $dataModel = $this->getDataModel(); 

            
            if ($this->profileModel->insert($dataModel)) { 
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

    
    public function singleProfile($id = null) 
    { 
        if ($this->request->isAJAX()) { 

            if ($data[$this->model] = $this->profileModel->where($this->primaryKey, $id)->first()) { 
                $data['message'] = 'success'; 
                $data['response'] = ResponseInterface::HTTP_OK; 
                $data['csrf'] = csrf_hash(); 
            } else { 
                $data['message'] = 'Error retrieving profile'; 
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
                'profile_email' => $this->request->getVar('profile_email'), 
                'profile_name' => $this->request->getVar('profile_name'), 
                'profile_photo' => $this->request->getVar('profile_photo'), 
                'jugador_id_fk' => $this->request->getVar('jugador_id_fk'), 
                'update_at' => $today 
            ]; 
            
            if ($this->profileModel->update($id, $dataModel)) { 
                $data['message'] = 'success'; 
                $data['response'] = ResponseInterface::HTTP_OK; 
                $data['data'] = $dataModel; 
                $data['csrf'] = csrf_hash(); 
            } else { 
                $data['message'] = 'Error updating profile'; 
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

            if ($this->profileModel->where($this->primaryKey, $id)->delete($id)) { 
                $data['message'] = 'success'; 
                $data['response'] = ResponseInterface::HTTP_OK; 
                $data['data'] = "OK"; 
                $data['csrf'] = csrf_hash(); 
            } else { 
                $data['message'] = 'Error deleting profile'; 
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
            'profile_id' => $this->request->getVar('profile_id'), 
            'profile_email' => $this->request->getVar('profile_email'), 
            'profile_name' => $this->request->getVar('profile_name'), 
            'profile_photo' => $this->request->getVar('profile_photo'), 
            'jugador_id_fk' => $this->request->getVar('jugador_id_fk'), 
            'update_at' => $this->request->getVar('update_at') 

        ];
        return $data; 
    }

    
    
 
}