<?php

namespace App\Controllers;

use App\Models\JugadorModel;
use CodeIgniter\Controller;
use CodeIgniter\HTTP\ResponseInterface;
use App\Helpers\JwtHelper;

class JugadorController extends Controller
{
    protected $jugadorModel;
    protected $data;
    protected $primaryKey = "jugador_id";
    


    public function __construct()
    {
        $this->jugadorModel = new JugadorModel();
        $this->data = [];
        $this->model = "jugadorModel";
    }

    public function login()
    {
        $username = $this->request->getVar('username');
        $password = $this->request->getVar('password');
    
        $jugador = $this->jugadorModel->where('jugador_name', $username)->first();
    
        if ($jugador && password_verify($password, $jugador['jugador_password'])) {
            $token = JwtHelper::generateToken([
                'id' => $jugador['jugador_id'],
                'name' => $jugador['jugador_name']
            ]);

            $session = session();
            $session->set([
                'token' => $token,
                'jugador_id_fk' => $jugador['jugador_id'], // Se guarda el ID en sesión
                'jugador_role' => $jugador['roles_fk'] // Guardar el rol en sesión
            ]);
            
            // Redirigir al usuario a la vista de jugador
            return redirect()->to('/auth/profile');
            
        } else {
            return redirect()->to('/auth/login')->with('error', 'Credenciales incorrectas');
        }
    }

    public function loginView()
    {
        return view('login/login_view'); 
    }
    
    public function registerView()
    {
    $roleModel = new \App\Models\RoleModel();
    $statusModel = new \App\Models\JugadorStatusModel();

    $this->data['roles'] = $roleModel->findAll();
    $this->data['estados'] = $statusModel->findAll();

    return view('login/register', $this->data);
    }

public function store()
{
    $data = [
        'jugador_name' => $this->request->getPost('jugador_name'),
        'jugador_password' => password_hash($this->request->getPost('jugador_password'), PASSWORD_DEFAULT),
        'roles_fk' => 1,
        'jugador_status_fk' => 1,
        'update_at' => date("Y-m-d H:i:s")
    ];

    if ($this->jugadorModel->insert($data)) {
        return redirect()->to('/auth/login')->with('success', 'Jugador registrado exitosamente');
    } else {
        return redirect()->back()->withInput()->with('error', 'Error al registrar el jugador');
    }
}
    

    public function verificarSesion()
    {
        $token = $this->request->getHeaderLine('Authorization');

        if (!$token) {
            return $this->response->setJSON(['error' => 'Token no proporcionado'], 401);
        }

        try {
            $token = str_replace('Bearer ', '', $token);
            $jugadorData = JwtHelper::verifyToken($token);

            return $this->response->setJSON(['jugador' => $jugadorData]);
        } catch (\Exception $e) {
            return $this->response->setJSON(['error' => 'Token inválido o expirado'], 401);
        }
    }

    public function index()
    {
    $token = session()->get('token');

    if (!$token) {
        return redirect()->to('/auth/login')->with('error', 'Acceso no autorizado');
    }

    try {
        $jugadorData = JwtHelper::verifyToken($token);

        $this->data['title'] = "JUGADOR";
        $this->data[$this->model] = $this->jugadorModel->orderBy($this->primaryKey, 'ASC')->findAll();

        $roleModel = new \App\Models\RoleModel();
        $statusModel = new \App\Models\JugadorStatusModel();

        $this->data['roles'] = $roleModel->findAll();
        $this->data['estados'] = $statusModel->findAll();

        return view('jugador/jugador_view', $this->data);
    } catch (\Exception $e) {
        return redirect()->to('/auth/login')->with('error', 'Token inválido o expirado');
    }
}



    public function create() 
    { 
        if ($this->request->isAJAX()) { 
            $dataModel = $this->getDataModel(); 

            if ($this->jugadorModel->insert($dataModel)) { 
                return $this->response->setJSON(['message' => 'success', 'csrf' => csrf_hash()], ResponseInterface::HTTP_OK);
            } else { 
                return $this->response->setJSON(['message' => 'Error creating user'], ResponseInterface::HTTP_NO_CONTENT);
            } 
        } else { 
            return $this->response->setJSON(['message' => 'Error Ajax'], ResponseInterface::HTTP_CONFLICT);
        } 
    }

    public function singleJugador($id = null) 
    { 
        if ($this->request->isAJAX()) { 

            if ($data[$this->model] = $this->jugadorModel->where($this->primaryKey, $id)->first()) { 
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
            $id = $this->request->getVar($this->primaryKey);
            
            $dataModel = [
                'jugador_name' => $this->request->getVar('jugador_name'), 
                'jugador_password' => password_hash($this->request->getVar('jugador_password'), PASSWORD_DEFAULT),
                'roles_fk' => $this->request->getVar('roles_fk'), 
                'jugador_status_fk' => $this->request->getVar('jugador_status_fk'), 
                'update_at' => date("Y-m-d H:i:s")
            ]; 
            
            if ($this->jugadorModel->update($id, $dataModel)) { 
                return $this->response->setJSON(['message' => 'success', 'csrf' => csrf_hash()], ResponseInterface::HTTP_OK);
            } else { 
                return $this->response->setJSON(['message' => 'Error updating jugador'], ResponseInterface::HTTP_NO_CONTENT);
            } 
        } else { 
            return $this->response->setJSON(['message' => 'Error Ajax'], ResponseInterface::HTTP_CONFLICT);
        } 
    }

    public function delete($id = null) 
    { 
        try { 
            if ($this->jugadorModel->where($this->primaryKey, $id)->delete($id)) { 
                return $this->response->setJSON(['message' => 'success', 'csrf' => csrf_hash()], ResponseInterface::HTTP_OK);
            } else { 
                return $this->response->setJSON(['message' => 'Error deleting jugador'], ResponseInterface::HTTP_CONFLICT);
            } 
        } catch (\Exception $e) { 
            return $this->response->setJSON(['message' => $e->getMessage()], ResponseInterface::HTTP_CONFLICT);
        } 
    }

    private function getDataModel() 
    { 
        return [ 
            'jugador_id' => $this->request->getVar('jugador_id'), 
            'jugador_name' => $this->request->getVar('jugador_name'), 
            'jugador_email' => $this->request->getVar('jugador_email'), 
            'jugador_password' => password_hash($this->request->getVar('jugador_password'), PASSWORD_DEFAULT),
            'roles_fk' => $this->request->getVar('roles_fk'), 
            'jugador_status_fk' => $this->request->getVar('jugador_status_fk'), 
            'update_at' => date("Y-m-d H:i:s")
        ]; 
    }
}
