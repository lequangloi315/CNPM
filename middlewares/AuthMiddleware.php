<?php

namespace Middlewares;

use Core\JWTHandler;
use Core\Response;

class AuthMiddleware {
    public static function handle() {
        $headers = getallheaders();
        if (!isset($headers['Authorization'])) {
            Response::json(401, null, 'Unauthorized');
        }

        $token = str_replace('Bearer ', '', $headers['Authorization']);
        try {
            $decoded = (new JWTHandler())->decodeToken($token);
      
            $_SESSION['user'] = $decoded;
        } catch (\Exception $e) {
            Response::json(401, null, 'Token không hợp lệ, kiểm tra lại The authorization header');
        }
    }
}
