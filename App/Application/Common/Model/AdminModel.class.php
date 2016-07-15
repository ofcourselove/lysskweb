<?php
namespace Common\Model;

use Think\Model;

class AdminModel extends Model
{
    protected $tableName = 'admin';
    protected $_validate = array(
        array('username', 'require', '请输入用户名', 1),
        array('nickname', 'require', '请输入昵称', 1),
        array('username', '', '用户名已存在', 1, 'unique', 1),
    );

    public function login($username, $password)
    {
        $map['username'] = $username;

        $info = $this->where($map)->find();
        if (!$info) {
            $this->error = '用户名不存在';
            return false;
        }

        if (md5($password) != $info['password']) {
            $this->error = '密码不正确';
            return false;
        }

        return $info;
    }

    public function insert($data)
    {

        if (!$this->create($data, 1)) {
            return false;
        }
        if (empty($data['password'])) {
            $this->error('请输入密码');
            return false;
        }

        $this->password = md5(I('post.password'));

        $result = $this->add();
        return $result;
    }

    public function update($data)
    {
        if (!$this->create($data, 2)) {
            return false;
        }

        $map['id'] = $data['id'];

        if (!empty($data['password'])) {
            $this->password = md5($data['password']);
        } else {
            unset($this->data['password']);
        }

        $result = $this->where($map)->save();
        return $result;
    }
    /*****
    * 对管理员权限检测函数
    *
    ******/
    public function check($date)
    {
      $admin = session('uid');
  		$list = $this->where('id='.$admin)->find();
  		$level = $list['level'];//从数据库取出level值
      if ($level=='0') {
          return true;
      }
      $level = explode(',',$level);
      if (in_array($date,$level)) {
          return true;
      }else {
          return false;
      }
    }

}
