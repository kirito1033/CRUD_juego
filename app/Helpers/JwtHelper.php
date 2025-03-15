<?php

namespace App\Helpers;

use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use App\Config\JWT as JWTConfig;
use Exception;

class JwtHelper
{
    public static function generateToken($userData)
    {
        $key = JWTConfig::$key;
        $payload = [
            'iat' => time(),  // Tiempo en que se creó el token
            'exp' => time() + JWTConfig::$expireTime, // Expiración
            'data' => $userData
        ];

        return JWT::encode($payload, $key, 'HS256');
    }

    public static function verifyToken($token)
    {
        try {
            $decoded = JWT::decode($token, new Key(JWTConfig::$key, 'HS256'));
            return (array) $decoded->data; // Retorna la información del usuario
        } catch (Exception $e) {
            return false; // Token inválido o expirado
        }
    }
}