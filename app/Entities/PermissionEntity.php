<?php

namespace App\Entities;

use App\Entities\Entity;

/**
 * Class PrinterEntity
 * Đại diện cho dữ liệu của một máy in.
 */
class PermissionEntity extends Entity {
    private $id;
    private $role_id;
    private $resource;
    private $action;

    /**
     * Constructor của PermissionEntity.
     *
     * @param int|null $id ID của phân quyền (null nếu là phân quyền mới).
     * @param string|null $name name của máy in.
     * @param string|null $status trạng thái của máy in.
     */
    public function __construct($id = null, $role_id = null, $resource = null, $action) {
        $this->id = $id;
        $this->role_id = $role_id;
        $this->resource = $resource;
        $this->action = $action;
    }

      /**
     * Lấy ID của máy in.
     *
     * @return int|null ID của máy in.
     */
    public function getId() { return $this->id; }

    /**
     * Thiết lập ID cho máy in.
     *
     * @param int $id ID của máy in.
     */
    public function setId($id) { $this->id = $id; }

    public function getRoleId() { return $this->role_id; }
    public function setRoleId(array $role_id) { $this->role_id = $role_id; }

    /**
     * Lấy tên của Module.
     *
     * @return string|null tên của máy in.
     */
    public function getResource() { return $this->resource; }

    /**
     * Thiết lập tên của Module.
     *
     * @param string $resource tên của Module.
     */
    public function setResource($resource) { $this->resource = $resource; }

    /**
     * Lấy hành động của Module.
     *
     * @return string|null hành động của Module.
     */
    public function getAction() { return $this->action; }

    /**
     * Thiết lập  hành động của Module.
     *
     * @param string $action hành động của Module.
     */
    public function setAction($status) { $this->action = $action; }

    
    /**
     * Trả về thông tin quyền dưới dạng mảng.
     *
     * @return array Mảng chứa thông tin máy in.
     */
    public function toArray() {
        return [
            'id' => $this->id,
            'role_id' => $this->role_id,
            'resource' => $this->resource,
            'action' => $this->action,
        ];
    }
}
?>
