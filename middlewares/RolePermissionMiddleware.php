<?php

namespace Middlewares;

use Core\Response;
use App\Models\PermissionModel;
use App\Controllers\BaseController;

class RolePermissionMiddleware extends BaseController {
    private $permissionModel;
    private $requiredRole;
    private $requiredResource;
    private $requiredActions;

    public function __construct($resource, $actions = []) {
        $this->permissionModel = new PermissionModel($this->DB());
        $this->requiredResource = $resource;
        $this->requiredActions = $actions;
    }

    public function handle() {
        if (!isset($_SESSION['user'])) {
            Response::json(401, null, 'Unauthorized: User not logged in');
        }

        $user = $_SESSION['user'];

        // Kiểm tra nếu người dùng có quyền `view` hoặc `view_own`
        foreach ($this->requiredActions as $action) {
            if ($this->permissionModel->hasPermission($user['role_id'], $this->requiredResource, $action)) {
                // Lưu quyền vào session để Controller sử dụng
                $_SESSION['current_permission'] = $action;
                return;
            }
        }
    }
}
