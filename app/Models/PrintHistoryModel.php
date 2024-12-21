<?php

namespace App\Models;

use App\Entities\PrintHistoryEntity;
use App\Models\Model;

/**
 * Class PrintHistoryModel
 * Quản lý các thao tác cơ sở dữ liệu liên quan đến lịch sử in.
 */
class PrintHistoryModel extends Model {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function addPrintHistory(PrintHistoryEntity $history) {
        $userId = $history->getUserId();
        $printerId = $history->getPrinterId();
        $fileName = $history->getFileName();
        $pages = $history->getPages(); 
        $sql = "INSERT INTO print_history (user_id, printer_id, file_name, pages) VALUES (?,?,?,?)";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([$userId, $printerId, $fileName, $pages]);
    }

    public function getPrintHistorys(array $conditions = []) {
        $sql = "SELECT ph.id, u.user_name, p.printer_name as printer_name, ph.file_name, ph.pages, ph.created_at FROM print_history ph
            LEFT JOIN printers p ON p.id = ph.printer_id
            LEFT JOIN users u ON u.id = ph.user_id ";
        $params = array();
        // Thêm điều kiện WHERE nếu có
        if (!empty($conditions)) {
            $whereClauses = [];
            foreach ($conditions as $column => $value) {
                $whereClauses[] = "$column = :$column";
                $params[":$column"] = $value;
            }
            $sql .= " WHERE " . implode(' AND ', $whereClauses);
        }
        $stmt = $this->db->prepare($sql);
        $stmt->execute($params);
        $results = $stmt->fetchAll();
        $printers = [];
        foreach ($results as $result) {
            $printer = $this->mapToEntity($result);
            $printers[] = $printer;
        }

        return $printers;
    }

    /**
     * Chuyển dữ liệu từ cơ sở dữ liệu thành PrintHistoryEntity.
     */
    public function mapToEntity(array $data) {
        return [
            'id' => $data['id'] ?? null,
            'userName' => $data['username'] ?? null,
            'printerName' => $data['printer_name'] ?? null,
            'fileName' => $data['file_name'] ?? null,
            'pages' => $data['pages'] ?? null,
            'createdAt' => $data['created_at'] ?? null,
        ];
    }
}
?>
