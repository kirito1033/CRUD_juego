<?php

namespace App\Controllers;

use App\Models\WarriorModel;
use CodeIgniter\Controller;
use CodeIgniter\HTTP\ResponseInterface;



class WarriorController extends Controller
{

    private $primarykey;
    private $warrior;
    private $data;
    private $model;
    
    public function __construct() 
    { 
        $this->primaryKey = "warrior_id"; 
        $this->warrior = new WarriorModel(); 
        $this->data = []; 
        $this->model = "warrior"; 
    } 

  
    public function index() 
    { 

   
        
    $this->data['title'] = "WARRIOR"; 
    $this->data[$this->model] = $this->warrior->orderBy($this->primaryKey, 'ASC')->findAll(); 
   
    // Cargar modelos de roles y estados
    $type_id = new \App\Models\WarriorTypeModel();
    $race_id = new \App\Models\RaceModel();

    $this->data['types'] = $type_id->findAll();
    $this->data['races'] = $race_id->findAll();

    return view('warrior/warrior_view', $this->data); 
    }
    
    public function prueba() 
    {
        $type_id = new \App\Models\WarriorTypeModel();
        $race_id = new \App\Models\RaceModel();
    
        $this->data['types'] = $type_id->findAll();
        $this->data['races'] = $race_id->findAll();
        return view('warrior/prueba', $this->data); 
    }


    public function create()
    {
    if ($this->request->isAJAX()) {
        $dataModel = $this->getDataModel();

        // Manejo de imagen
        $img = $this->request->getFile('imagen');
        if ($img && $img->isValid() && !$img->hasMoved()) {
            $newName = $img->getRandomName();
            $img->move(ROOTPATH . 'public/uploads/', $newName);
            $dataModel["imagen"] = $newName;
        }

        if ($this->warrior->insert($dataModel)) {
            $data["message"] = "success";
            $data["response"] = ResponseInterface::HTTP_OK;
            $data["data"] = $dataModel;
            $data["csrf"] = csrf_hash();
        } else {
            $data["message"] = "Error al crear usuario";
            $data["response"] = ResponseInterface::HTTP_NO_CONTENT;
            $data["data"] = "";
        }
    } else {
        $data["message"] = "Error Ajax";
        $data["response"] = ResponseInterface::HTTP_CONFLICT;
        $data["data"] = "";
    }

        echo json_encode($data);
    }
    
    public function singleWarrior($id = null) 
    { 
        if ($this->request->isAJAX()) { 

            if ($data[$this->model] = $this->warrior->where($this->primaryKey, $id)->first()) { 
                $data['message'] = 'success'; 
                $data['response'] = ResponseInterface::HTTP_OK; 
                $data['csrf'] = csrf_hash(); 
            } else { 
                $data['message'] = 'Error retrieving warrior'; 
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
                'total_power' => $this->request->getVar('total_power'), 
                'total_magic' => $this->request->getVar('total_magic'), 
                'health' => $this->request->getVar('health'), 
                'speed' => $this->request->getVar('speed'), 
                'intelligence' => $this->request->getVar('intelligence'), 
                'status' => $this->request->getVar('status'), 
                'type_id' => $this->request->getVar('type_id'), 
                'race_id' => $this->request->getVar('race_id'), 
                'image' => $this->request->getVar('image'), 
                'updated_at' => $today 
            ]; 
            
            if ($this->warrior->update($id, $dataModel)) { 
                $data['message'] = 'success'; 
                $data['response'] = ResponseInterface::HTTP_OK; 
                $data['data'] = $dataModel; 
                $data['csrf'] = csrf_hash(); 
            } else { 
                $data['message'] = 'Error updating'; 
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

            if ($this->warrior->where($this->primaryKey, $id)->delete($id)) { 
                $data['message'] = 'success'; 
                $data['response'] = ResponseInterface::HTTP_OK; 
                $data['data'] = "OK"; 
                $data['csrf'] = csrf_hash(); 
            } else { 
                $data['message'] = 'Error deleting warrior'; 
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
            'warrior_id' => $this->request->getVar('warrior_id'), 
            'name' => $this->request->getVar('name'), 
            'total_power' => $this->request->getVar('total_power'), 
            'total_magic' => $this->request->getVar('total_magic'), 
            'health' => $this->request->getVar('health'), 
            'speed' => $this->request->getVar('speed'), 
            'intelligence' => $this->request->getVar('intelligence'), 
            'status' => $this->request->getVar('status'), 
            'type_id' => $this->request->getVar('type_id'), 
            'race_id' => $this->request->getVar('race_id'), 
            'image' => $this->request->getVar('image'), 
            'update_at' => $this->request->getVar('update_at') 
        ]; 
        return $data; 
    }

    
    
    public function store3()
    { 
     
       
        $file = $this->request->getFile('image'); // Obtener el archivo
      
        if ($file && $file->isValid() && !$file->hasMoved()) {
            $newName = $file->getRandomName(); // Generar un nombre aleatorio
            $file->move('uploads/', $newName); // Guardar en la carpeta 'uploads/'
            $photoPath = 'uploads/' . $newName; // Ruta de la imagen
         
           
        } else {
            $photoPath = null; // Si no hay imagen válida, dejar null
        }
    
        $data = [
            'name' => $this->request->getVar('name'), 
            'total_power' => $this->request->getVar('total_power'), 
            'total_magic' => $this->request->getVar('total_magic'), 
            'health' => $this->request->getVar('health'), 
            'speed' => $this->request->getVar('speed'), 
            'intelligence' => $this->request->getVar('intelligence'), 
            'status' => $this->request->getVar('status'), 
            'type_id' => $this->request->getVar('type_id'), 
            'race_id' => $this->request->getVar('race_id'), 
            'image' => $photoPath,
            'update_at' => date("Y-m-d H:i:s")
        ];
    
        if ($this->warrior->insert($data)) {
         
            
        } else {
            error_log("Error en inserción: " . print_r($data, true));
        }
    }
    
    public function updateImage()
{
    if ($this->request->isAJAX()) {

        $id = $this->request->getVar('id'); // ✅ coincide con el input hidden

        // Verificar si el guerrero existe
        $warrior = $this->warrior->find($id);
        if (!$warrior) {
            return $this->response->setJSON([
                'message' => 'Guerrero no encontrado',
                'response' => ResponseInterface::HTTP_NOT_FOUND
            ]);
        }

        // Obtener imagen con el nombre correcto
        $img = $this->request->getFile('imagen'); // ✅ coincide con el name del input

        if ($img && $img->isValid() && !$img->hasMoved()) {
            $newName = $img->getRandomName();
            $img->move(ROOTPATH . 'public/uploads/', $newName);

            // Actualizar en la base de datos
            $this->warrior->update($id, ['image' => $newName]);

            return $this->response->setJSON([
                'message' => 'success',
                'response' => ResponseInterface::HTTP_OK,
                'csrf' => csrf_hash(),
                'image' => $newName
            ]);
        } else {
            return $this->response->setJSON([
                'message' => 'Error al subir imagen',
                'response' => ResponseInterface::HTTP_NO_CONTENT
            ]);
        }
    }

    return $this->response->setJSON([
        'message' => 'Petición inválida',
        'response' => ResponseInterface::HTTP_BAD_REQUEST
    ]);
}


}