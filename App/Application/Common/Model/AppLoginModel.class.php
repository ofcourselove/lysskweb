<?php
namespace Common\Model;

use Think\Model;

class AppLoginModel extends Model
{
    protected $tableName = 'app_login';

    public function insert($device_id, $user_id = 0)
    {
        $data['device_id']   = $device_id;
        $data['user_id']     = $user_id;
        $data['session_id']  = md5($device_id);
        $data['create_time'] = time();
        $data['modify_time'] = time();

        $result = $this->add($data);

        if ($result) {
            return md5($device_id);
        } else {
            return false;
        }
    }

    public function getBySessionId($session_id)
    {
        $map['session_id'] = $session_id;

        return $this->get($map);
    }

    public function getByDeviceId($device_id)
    {
        $map['device_id'] = $device_id;

        return $this->get($map);
    }

    public function get($map)
    {
        $info = $this->where($map)->find();

        if ($info) {
            return $info;
        } else {
            return false;
        }
    }

    public function update($session_id, $user_id)
    {
        $map['session_id'] = $session_id;

        $data['user_id']     = $user_id;
        $data['modify_time'] = time();

        $result = $this->where($map)->save($data);

        return $result;
    }
}
