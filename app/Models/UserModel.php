<?php

namespace App\Models;

use App\Entities\UserEntity;
use Core\Database;
use App\Models\Model;

class UserModel extends Model{
    private $db;
    public function __construct($db) {
        $this->db = $db;
    }

    /**
     * Lấy người dùng theo email.
     *
     * @param string $email
     * @return array|null Thông tin người dùng hoặc null nếu không tồn tại.
     */
    public function findByEmail($email) {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE email = :email");
        $stmt->execute([':email' => $email]);
        $result = $stmt->fetch();

        if ($result) {
            return $this->mapToEntity($result);
        }
        return null; // Không tìm thấy user
    }

    /**
     * Chuyển dữ liệu từ cơ sở dữ liệu thành UserEntity.
     */
    protected function mapToEntity(array $data): UserEntity {
        return new UserEntity(
            $data['id'] ?? null,
            $data['email'] ?? null,
            $data['user_name'] ?? null,
            $data['role_id']?? null
        );
    }
}
