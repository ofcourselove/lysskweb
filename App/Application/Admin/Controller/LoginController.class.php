<?php
namespace Admin\Controller;

use Think\Controller;

class LoginController extends Controller
{
    public function index()
    {
        if (session('uid')) {
            redirect(U('Index/index'));
        }

        $this->display();
    }

    public function login()
    {
        if (!IS_POST) {
            $this->error('非法请求');
        }
        $username = I('post.username');
        $password = I('post.password');

        $model = D('Admin');

        $info = $model->login($username, $password);

        if (!$info) {
            $this->error($model->getError());
        }

        session('uid', $info['id']);
        session('nickname', $info['nickname']);

        $this->success('登录成功', U('Index/index'));
    }

    public function logout()
    {
        session(null);
        session_regenerate_id();
        redirect(U('Login/index'));
    }
}
