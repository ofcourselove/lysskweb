<?php
namespace App\Controller;

use App\Controller\BaseController;
use Common\Helper\Sms;

class LoginController extends BaseController
{
    public function register()
    {
        $model = D('User');
        $code = I('post.code');
        $mobile = I('mobile');
        if (empty($code)) {
            $this->apiError(10004, 'code empty');
        }
        $smsModel = D('SmsCode');
        $checkCode = $smsModel->check($mobile, $code);
        if (!$checkCode) {
            $this->apiError(10005, '验证码验证失败');
        }

        $result = $model->register(I('post.'));
        if ($result) {
            //首次注册奖励
            $model->addBalance($result, C('register'), 1, '首次注册奖励');
            //写入登录表
            $LoginModel = D('AppLogin');
            $this->update($this->session_id, $result);
            $info = $model->get($result);
            $this->apiSuccess($info);
        } else {
            $error = $model->getError();
            $this->apiError($error['error_code'], $error['error_msg']);
        }
    }

    public function login()
    {
        $username = I('post.username');
        $password = I('post.password');

        $model = D('User');

        $result = $model->login($username, $password);

        if (!$result) {
            $error = $model->getError();
            $this->apiError($error['error_code'], $error['error_msg']);
        }

        $LoginModel = D('AppLogin');
        $this->update($this->session_id, $result['id']);
        $this->apiSuccess($result);
    }

    public function weixin_login()
    {
        $data = I('post.');

        $model = D('User');

        $result = $model->weixin_login($data);

        if (!$result) {
            $error = $model->getError();
            $this->apiError($error['error_code'], $error['error_msg']);
        }
        $this->update($this->session_id, $result['id']);
        $this->apiSuccess($result);
    }

    public function logout()
    {
        $this->update($this->session_id, 0);
        $this->apiSuccess();
    }

    public function forgetPassword()
    {

        $mobile       = I('post.mobile');
        $password     = I('post.password');
        $rep_password = I('post.rep_password');
        $code = I('post.code');

        if (empty($password)) {
            $this->apiError(10002, 'password empty');
        }

        if (empty($rep_password)) {
            $this->apiError(10007, 'rep_password不可为空');
        }
        if ($password != $rep_password) {
            $this->apiError(10008, '两次输入的密码不一致');
        }
        if (empty($mobile)) {
            $this->apiError(10001, 'mobile empty');
        }
        if (empty($code)) {
            $this->apiError(10003, 'code empty');
        }
        $smsModel = D('SmsCode');

        $code_result = $smsModel->check($mobile, $code);
        if (!$code_result) {
            $this->apiError(10004, 'code error');
        }

        $model  = D('User');
        $result = $model->updatePassword($mobile, $password);

        if ($result) {
            $this->apiSuccess();
        } else {
            $error = $model->getError();
            $this->apiError($error['error_code'], $error['error_msg']);
        }
    }

    public function sendSms()
    {
        $mobile = I('mobile');
        if (empty($mobile)) {
            $this->apiError(10001, 'mobile empty');
        }
        $code = rand(1000, 9999);
        $content = '您本次操作的验证码是'.$code;
        $sms = new Sms();

        $send_result = $sms->send($mobile, $content);
        if ($send_result) {
            $model = D('SmsCode');
            $model->insert($mobile, $content, $code);
            $this->apiSuccess();
        } else {
            $this->apiError(10000, $sms->getError());
        }
    }
}
