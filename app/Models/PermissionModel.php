<?php

namespace App\Models;

use App\Models\Model;
use Core\Database;
use App\Entities\PermissionEntity;

class PermissionModel extends Model {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    /**
     * Kiểm tra xem vai trò của người dùng có quyền thực hiện hành động trên tài nguyên không.
     *
     * @param string $role_id Vai trò của người dùng.
     * @param string $resource Tài nguyên cần kiểm tra (vd: 'users', 'reports').
     * @param string $action Hành động cần kiểm tra (vd: 'create', 'read').
     * @return bool True nếu có quyền, False nếu không.
     */
    public function hasPermission(string $role_id, string $resource, string $action): bool {
        $stmt = $this->db->prepare("
            SELECT COUNT(*) 
            FROM permissions 
            WHERE role_id = :role_id AND resource = :resource AND action = :action
        ");
        $stmt->execute([
            ':role_id' => $role_id,
            ':resource' => $resource,
            ':action' => $action
        ]);

        return $stmt->fetchColumn() > 0;
    }

    /**
     * Chuyển dữ liệu từ cơ sở dữ liệu thành UserEntity.
     */
    protected function mapToEntity(array $data): PermissionEntity {
        return new PermissionEntity(
            $data['id'] ?? null,
            $data['role_id'] ?? null,
            $data['resource'] ?? null,
            $data['action'] ?? null,
        );
    }
}
