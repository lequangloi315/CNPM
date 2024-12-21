<?php

namespace Core;

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class JWTHandler {
    private $secret;

    public function __construct() {
        $this->secret = $_ENV['JWT_SECRET'];
    }

    public function generateToken($payload, $expiry = 3600) {
        $payload['iat'] = time();
        $payload['exp'] = time() + $expiry;
        return JWT::encode($payload, $this->secret, 'HS256');
    }

    public function decodeToken($token) {
        return (array) JWT::decode($token, new Key($this->secret, 'HS256'));
    }
}
