<?php

namespace Core;

class Response {
    public static function json($status, $data = null, $message = '') {
        header('Content-Type: application/json');
        http_response_code($status);
        echo json_encode([
            'status' => $status < 300 ? 'success' : 'error',
            'data' => $data,
            'message' => $message
        ]);
        exit;
    }
}
