<?php

namespace Core;

class Request {
    private $method;
    private $uri;
    private $headers;
    private $body;

    public function __construct() {
        $this->method = $_SERVER['REQUEST_METHOD'];
        $this->uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $this->headers = getallheaders();
        $this->body = $this->getRequestBody();
    }

    /**
     * Lấy phương thức HTTP (GET, POST, PUT, DELETE).
     */
    public function getMethod(): string {
        return $this->method;
    }

    /**
     * Lấy URI của request.
     */
    public function getUri(): string {
        return $this->uri;
    }

    /**
     * Lấy headers từ request.
     */
    public function getHeaders(): array {
        return $this->headers;
    }

    /**
     * Lấy giá trị của một header cụ thể.
     */
    public function getHeader(string $key): ?string {
        return $this->headers[$key] ?? null;
    }

    /**
     * Lấy toàn bộ body của request.
     */
    private function getRequestBody() {
        $input = file_get_contents('php://input');
        return json_decode($input, true) ?: $_POST;
    }

    /**
     * Lấy dữ liệu từ body của request.
     */
    public function getBody(): array {
        return $this->body;
    }

    /**
     * Lấy một tham số cụ thể từ body.
     */
    public function getParam(string $key, $default = null) {
        return $this->body[$key] ?? $default;
    }

    /**
     * Lấy tham số từ query string (GET).
     */
    public function getQueryParam(string $key, $default = null) {
        return $_GET[$key] ?? $default;
    }
}
