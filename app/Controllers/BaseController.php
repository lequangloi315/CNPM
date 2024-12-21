<?php

namespace App\Controllers;

use App\Controllers\Controller;
use Core\Database;

class BaseController extends Controller {
    protected $db;
    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
    }

    protected function DB() {
        return Database::getInstance()->getConnection();
    }

    /**
     * Lấy danh sách từ bảng trong cơ sở dữ liệu, có hỗ trợ lọc.
     *
     * @param string $table Tên bảng.
     * @param array $conditions Mảng điều kiện (cột => giá trị).
     * @return array Kết quả truy vấn.
     */
    protected function getList(string $table, array $conditions = []): array {
        $query = "SELECT * FROM $table";
        $params = [];

        // Thêm điều kiện WHERE nếu có
        if (!empty($conditions)) {
            $whereClauses = [];
            foreach ($conditions as $column => $value) {
                $whereClauses[] = "$column = :$column";
                $params[":$column"] = $value;
            }
            $query .= " WHERE " . implode(' AND ', $whereClauses);
        }
        $stmt = $this->DB()->prepare($query);
        $stmt->execute($params);
        return $stmt->fetchAll();
    }
}
