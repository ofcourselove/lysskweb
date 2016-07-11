<?php
namespace App\Controller;

use Think\Controller;

class BaseController extends Controller
{
    public function _initialize()
    {
        if (CONTROLLER_NAME != 'Init') {
            $session_id = I('session_id');
            if (empty($session_id)) {
                $this->apiError(10000, 'session_id empty');
            }
        }

        $this->session_id = $session_id;

        // 根据session_id 获取登录信息
        $model = D('AppLogin');
        $login_info = $model->getBySessionId($session_id);
        if ($login_info['user_id']) {   //判断是否登录
            $this->user_id = $login_info['user_id'];
        }
    }

    public function apiSuccess($data = '')
    {
        $json['error'] = 0;
        $json['msg'] = '请求成功';
        if (!empty($data)) {
            $json['data'] = $data;
        }
        die(json_encode($json));
    }

    public function apiError($code=10000, $msg = '请求失败', $data = array())
    {
        $json['error'] = $code;
        if (!empty($msg)) {
            $json['msg'] = $msg;
        }
        if (!empty($data)) {
            $json['data'] = $data;
        }

        die(json_encode($json));
    }
}
