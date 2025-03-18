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

    public function profileView()
    {
        
    $session = session();
    $jugador_id_fk = $session->get('jugador_id_fk'); // Obtener ID del jugador
    $jugador_role = $session->get('jugador_role');   // Obtener el rol
  
    // Verificar si el perfil ya existe
    $profile = $this->profileModel->where('jugador_id_fk', $jugador_id_fk)->first();

    if ($profile) {
        // 🔀 Redirigir según el rol
        if ($jugador_role === "1") {
            return redirect()->to('/juego');
        } elseif ($jugador_role === "2") {
            return redirect()->to('/jugador');
        }
    }

    // Si no tiene perfil, mostrar el formulario de registro
    return view('login/profile', ['jugador_id_fk' => $jugador_id_fk]);
    }

 
    
    public function store()
    {
        $session = session();
        $jugador_id_fk = $this->request->getVar('jugador_id_fk');
    
        if (!$jugador_id_fk) {
            return redirect()->back()->withInput()->with('error', 'El ID del jugador es requerido');
        }
    
        // Obtener el rol desde la sesión
        $jugador_role = $session->get('jugador_role');
    
        // Procesar la imagen
        $file = $this->request->getFile('profile_photo'); // Obtener el archivo
    
        if ($file && $file->isValid() && !$file->hasMoved()) {
            $newName = $file->getRandomName(); // Generar un nombre aleatorio
            $file->move('uploads/', $newName); // Guardar en la carpeta 'uploads/'
            $photoPath = 'uploads/' . $newName; // Ruta de la imagen
        } else {
            $photoPath = null; // Si no hay imagen válida, dejar null
        }
    
        $data = [
            'profile_email' => $this->request->getVar('profile_email'), 
            'profile_name' => $this->request->getVar('profile_name'), 
            'profile_photo' => $photoPath, // Guardar la ruta en la base de datos
            'jugador_id_fk' => $jugador_id_fk, 
            'update_at' => date("Y-m-d H:i:s")
        ];
    
        if ($this->profileModel->insert($data)) {
            // 🔀 Redirigir según el rol
            if ($jugador_role === "1") {
                return redirect()->to('/juego')->with('success', 'Perfil registrado exitosamente');
            } elseif ($jugador_role === "2") {
                return redirect()->to('/jugador')->with('success', 'Perfil registrado exitosamente');
            } else {
                return redirect()->to('/login')->with('error', 'Rol no reconocido');
            }
        } else {
            return redirect()->back()->withInput()->with('error', 'Error al registrar el perfil');
        }
    }

    public function juegoView()
    {
    $session = session();
    $jugador_id_fk = $session->get('jugador_id_fk');

    // Obtener los datos del perfil
    $profile = $this->profileModel->where('jugador_id_fk', $jugador_id_fk)->first();

    if (!$profile) {
        return redirect()->to('login/login_view')->with('error', 'No se encontró el perfil.');
    }

    return view('juego/juego_view', ['profile' => $profile]);
    }

    
    
}