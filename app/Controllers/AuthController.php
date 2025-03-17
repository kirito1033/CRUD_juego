<?php

namespace App\Controllers;

use App\Models\JugadorModel;
use CodeIgniter\Controller;
use Firebase\JWT\JWT;

class AuthController extends Controller
{
    public function process_login()
    {
        $jugadorModel = new JugadorModel();
        $request = $this->request->getJSON();
        
        $username = $request->username;
        $password = $request->password;

        $jugador = $jugadorModel->where('jugador_name', $username)->first();

        if (!$jugador || !password_verify($password, $jugador['jugador_password'])) {
            return $this->response->setJSON(['error' => 'Usuario o contraseña incorrectos'])->setStatusCode(401);
        }

        $key = "crudproject"; 
        $payload = [
            'iat' => time(),
            'exp' => time() + 3600, 
            'data' => [
                'id' => $jugador['jugador_id'],
                'username' => $jugador['jugador_name']
            ]
        ];

        $token = JWT::encode($payload, $key, 'HS256');

        return $this->response->setJSON(['token' => $token]);
    }
}