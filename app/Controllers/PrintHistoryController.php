<?php

namespace App\Controllers;

use Core\Request;
use Core\Response;
use Core\ValidateRequest;
use Core\ValidationException;
use App\Models\PrintHistoryModel;
use App\Entities\PrintHistoryEntity;
use App\Controllers\BaseController;

class PrintHistoryController extends BaseController {

    public function __construct() {
        $this->printerHistoryModel = new PrintHistoryModel($this->DB());
    }

    public function getPrintHistorys() {
        $user = $_SESSION['user'];
        $permission = $_SESSION['current_permission'] ?? null;
        $conditions = [];

        if ($permission === 'view_own') {
            // Nếu quyền là `view_own`, chỉ lọc theo owner_id
            $conditions['user_id'] = $user['id'];
        }

        // Lấy danh sách từ bảng `print_history` với điều kiện
        $responeData = $this->printerHistoryModel->getPrintHistorys($conditions);

        Response::json(200, $responeData, "Lấy danh sách lịch sử in thành công");
    }

    public function addPrintHistory() {
        $request = new Request; 
        $data = $request->getBody();
        try {
            // Khởi tạo lớp validate và áp dụng luật
            $validator = new ValidateRequest($data);
            $validator->validate([
                'user_id' => 'required',
                'printer_id' => 'required',
                'file_name' => 'required',
                'pages' => 'required',
            ]);
           
        } catch (ValidationException $e) {
            // Xử lý lỗi xác thực
            Response::json(422, [
                'errors' => $e->getValidationErrors()
            ], 'Validation failed');
        }

        $entity = new PrintHistoryEntity();
        $entity->setUserId($data['user_id']);
        $entity->setPrinterId($data['printer_id']);
        $entity->setFileName($data['file_name']);
        $entity->setPages($data['pages']);

        $this->printerHistoryModel->addPrintHistory($entity);
        Response::json(200, [], "Thêm lịch sử in thành công");
    }
}
