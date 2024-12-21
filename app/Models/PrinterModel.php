<?php

namespace App\Models;

use App\Entities\PrinterEntity;
use Core\Database;
use App\Models\Model;

/**
 * Class PrinterModel
 * Quản lý các thao tác cơ sở dữ liệu liên quan đến máy in.
 */
class PrinterModel extends Model {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function addPrinter(PrinterEntity $printer) {
        $name = $printer->getName();
        $status = $printer->getStatus();

        $sql = "INSERT INTO printers (printer_name, status) VALUES (?, ?)";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([$name, $status]);
    }
    public function updatePrinter(PrinterEntity $entity) {
        $sql = "UPDATE printers SET printer_name = :printer_name, status = :status, ip_address = :ip_address WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $printerName = $entity->getName();
        $status = $entity->getStatus();
        $id = $entity->getId();
        $ipAddress = $entity->getIp();
    
        // Truyền tham số bằng biến
        $stmt->bindParam(':printer_name', $printerName);
        $stmt->bindParam(':status', $status);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':ip_address', $ipAddress);
    
        $stmt->execute();
        return $stmt->rowCount(); // Trả về số dòng bị ảnh hưởng
    }
    public function getPrinters(array $conditions = []) {
        $sql = "SELECT p.printer_name , p.status, t.tray_name, t.total_page FROM printers p
            LEFT JOIN trays t ON t.printer_id = p.id";
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
        // Khởi tạo mảng kết quả
        $printers = [];
        // Map dữ liệu
        foreach ($results as $row) {
            $name = $row['printer_name'];
            $status = $row['status'];
            $tray_name = $row['tray_name'];
            $total_page = $row['total_page'];

            // Nếu chưa tồn tại key `name` trong kết quả, khởi tạo
            if (!isset($printers[$name])) {
                $printers[$name] = [
                    'printerName' => $name,
                    'status' => $status,
                    'tray' => []
                ];
            }

            // Nếu tray_name và total_page không null, thêm vào `tray`
            if ($tray_name !== null && $total_page !== null) {
                $printers[$name]['tray'][] = [
                    'tray_name' => $tray_name,
                    'total_page' => $total_page,
                ];
            }
        };
        // Chuyển mảng kết quả từ key-value thành mảng chỉ số
        $printers = array_values($printers);
        return $printers;
    }

    /**
     * Chuyển dữ liệu từ cơ sở dữ liệu thành PrinterEntity.
     */
    protected function mapToEntity(array $data): PrinterEntity {
        return new PrinterEntity(
            $data['id'] ?? null,
            $data['name'] ?? null,
            $data['status'] ?? null
        );
    }
}
?>
