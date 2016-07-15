<?php
namespace App\Controller;

use App\Controller\BaseController;

class InitController extends BaseController
{
    /**
     * 获取session_id
     * @return [type] [description]
     */
    public function getSessionId()
    {
        $device_id = I('get.device_id');
        if (empty($device_id)) {
            $this->apiError(10001, 'device_id empty');
        }

        // 判断是否有写入信息
        $loginModel = D('AppLogin');
        $userModel  = D('User');
        $login_info = $loginModel->getByDeviceId($device_id);

        if (!$login_info) {
            $result = $loginModel->insert($device_id);
            if ($result) {
                $json_data['is_login']   = 0;
                $json_data['session_id'] = $result;
                $this->apiSuccess($json_data);
            } else {
                $this->apiError(1000, 'netword error');
            }
        }

        if (empty($login_info['user_id'])) {
            $json_data['is_login']   = 0;
            $json_data['session_id'] = $login_info['session_id'];
            $this->apiSuccess($json_data);
        }

        $user_info = $userModel->get($login_info['user_id']);
        if (!$user_info) {
            $json_data['is_login']   = 0;
            $json_data['session_id'] = $login_info['session_id'];
            $this->apiSuccess($json_data);
        }
        $json_data['is_login']   = 1;
        $json_data['session_id'] = $login_info['session_id'];
        $json_data['user_info']  = $user_info;
        $this->apiSuccess($json_data);
    }
}
