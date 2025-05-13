<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;
use App\Helpers\JwtHelper;

class AuthGuard implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $session = session();

        // Buscar el token en cualquier posible variable de sesión
        $token = $session->get('token_jugador') 
              ?? $session->get('token_jugador1') 
              ?? $session->get('token_jugador2');

        if (!$token || !JwtHelper::verifyToken($token)) {
            return redirect()->to('/auth/login')->with('error', 'Acceso no autorizado');
        }

        // Permitir acceso si el token es válido
        return;
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // No se necesita lógica post-ejecución
    }
}
