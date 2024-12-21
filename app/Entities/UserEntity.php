<?php

namespace App\Entities;

use App\Entities\Entity;

class UserEntity extends Entity {
    private $id;
    private $email;
    private $user_name;
    private $role_id;

    public function __construct($id = null, $email = null, $user_name = null, $role_id = null) {
        $this->id = $id;
        $this->email = $email;
        $this->user_name = $user_name;
        $this->role_id = $role_id;
    }

    // Getter và Setter
    public function getId() { return $this->id; }
    public function setId($id) { $this->id = $id; }

    public function getEmail() { return $this->email; }
    public function setEmail($email) { $this->email = $email; }

    public function getUserName() { return $this->user_name; }
    public function setUserName($user_name) { $this->user_name = $user_name; }

    public function getRoleId() { return $this->role_id; }
    public function setRoleId(array $role_id) { $this->role_id = $role_id; }

    public function toArray() {
        return [
            'id' => $this->id ?? null,
            'email' => $this->email ?? null,
            'user_name' => $this->user_name ?? null,
            'role_id' => $this->role_id ?? null
        ];
    }
}
