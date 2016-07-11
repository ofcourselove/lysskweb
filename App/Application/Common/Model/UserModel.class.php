<?php
namespace Common\Model;

use Common\Model\BaseModel;

class UserModel extends BaseModel
{
    protected $tableName = 'user';
    protected $error_msg = '';

    protected $_validate = array(
        array('mobile', 'require', 10001, 1),
        array('password', 'require', 10002, 1),
        array('mobile', '', 10003, 0, 'unique', 1),
    );

    protected $_auto = array(
        array('balance', 0, 1, 'string'),
        array('income', 0, 1, 'string'),
        array('create_time', 'time', 1, 'function'),
        array('modify_time', 'time', 3, 'function'),
    );

    protected $_error_msg = array(
        10001 => 'mobile empty',
        10002 => 'password empty',
        10003 => 'mobile已存在',
        10004 => 'mobile不存在',
        10005 => 'password错误',
        10006 => '微信登陆缺少openid',
        10000 => 'system error',
        10007 => 'rep_password不可为空',
        10008 => '两次输入的密码不一致',
        10009 => '微信号已绑定过',
        10010 => '缺少openid',
    );

    public function get($user_id)
    {
        $map['id'] = $user_id;

        $info = $this->where($map)->find();
        return $info;
    }
    public function getByOpenId($openid)
    {
        $map['openid'] = $openid;

        return $this->where($map)->find();
    }

    public function register($data)
    {
        if (!$this->create($data)) {
            return false;
        }
        $this->password = md5($data['password']);
        $this->username = $data['mobile'];
        $result         = $this->add();

        if ($result) {
            // 发展下线奖励
            if (!empty($data['invite_user_id'])) {
                $this->addBalance($data['invite_user_id'], C('subordinate'), 6, '发展下线(' . $data['username'] . ')奖励');
            }
            return $result;
        }
        $this->error = 10000;
        return false;
    }

    public function login($username, $password)
    {
        if (empty($username)) {
            $this->error = 10001;
            return false;
        }
        if (empty($password)) {
            $this->error = 10002;
            return false;
        }
        $map['mobile'] = $username;

        $info = $this->where($map)->find();
        if (!$info) {
            $this->error = 10004;
            return false;
        }
        if (md5($password) != $info['password']) {
            $this->error = 10005;
            return false;
        }
        return $info;
    }

    public function updatePassword($mobile, $password)
    {
        $map['mobile']    = $mobile;
        $data['password'] = md5($password);

        $result = $this->where($map)->save($data);

        if ($result) {
            return true;
        }
        $this->error = 10000;
        return false;
    }

    public function weixin_login($data)
    {
        if (!isset($data) && empty($data['openid'])) {
            $this->error = 10006;
            return false;
        }
        $info = $this->getByOpenId($data['openid']);
        if ($info) {
            return $info;
        }

        $data['username'] = $data['openid'];
        $data['password'] = md5(123456);
        $data['thumb']    = $data['headimgurl'];
        $data['mobile']   = '';

        $result = $this->register($data);
        if ($result) {
            $info = $this->get($result);
            return $info;
        } else {
            $this->error = 10000;
            return false;
        }
    }

    public function bind_weixin($user_id, $openid)
    {
        $map['openid'] = $openid;

        $info = $this->where($map)->find();
        if ($info) {
            $this->error = 10009;
            return false;
        }

        unset($map);
        $map['id']      = $user_id;
        $data['openid'] = $openid;

        $result = $this->where($map)->save($data);

        if ($result) {
            return true;
        }
        $this->error = 10000;
        return false;
    }

    public function addBalance($user_id, $balance, $option_type, $remark = '')
    {
        $map['id']       = $user_id;
        $data['balance'] = array('exp', 'balance+' . $balance);
        $data['income']  = array('exp', 'income+' . $balance);

        $BalanceLogModel = D('BalanceLog');
        $this->startTrans();
        $addLog = $BalanceLogModel->addLog($user_id, $balance, 1, $option_type, $remark);

        if ($result !== false && $addLog !== false) {
            $this->commit();
            return true;
        } else {
            $this->rollback();
            return false;
        }
    }

    public function deductBalance($user_id, $balance, $option_type, $remark = '')
    {
        $map['user_id'] = $user_id;

        $data['balance'] = array('exp', 'balance-' . $balance);

        $BalanceLogModel = D('BalanceLog');
        $this->startTrans();
        $result = $this->where($map)->save($data);
        $addLog = $BalanceLogModel->addLog($user_id, $balance, 2, $option_type, $remark);

        if ($result !== false && $addLog !== false) {
            $this->commit();
            return true;
        } else {
            $this->rollback();
            return false;
        }
    }
}
