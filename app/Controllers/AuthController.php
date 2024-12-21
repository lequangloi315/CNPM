<?php
namespace App\Controllers;

use Core\Request;
use Core\Response;
use Core\JWTHandler;
use App\Models\UserModel;
use App\Controllers\BaseController;

class AuthController extends BaseController{
    private $userModel;

    public function __construct() {
        $this->userModel = new UserModel($this->DB());
    }

    public function login(Request $request) {
        $email = $request->getParam('email') ?? '';
        $userEntity = $this->userModel->findByEmail($email);

        if ($userEntity) {
            $user = $userEntity->toArray();
            $jwtHandler = new JWTHandler();
            
            $id = $user['id'];
            $username = $user['user_name'];
            $email = $user['email'];
            $roleId = $user['role_id'];
            $payload = [
                'id' => $id,
                'user_name' =>  $username,
                'email' => $email,
                'role_id' => $roleId
            ];
            $token = $jwtHandler->generateToken($payload);        
      
            $responeData = [
                'token' => $token,
                'user' => [
                    'id' => $id,
                    'userName' =>  $username,
                    'email' => $email,
                    'roleId' => $roleId
                ]
            ];
            
            Response::json(200, $responeData, 'Đăng nhập thành công');
        } else {
            Response::json(401, null, 'Email không đúng');
        }
    }
}
