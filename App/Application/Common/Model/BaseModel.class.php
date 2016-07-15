<?php
namespace Common\Model;

use Think\Model;

class BaseModel extends Model
{
    public function getError()
    {
        return array(
            'error_code' => $this->error,
            'error_msg'  => $this->_error_msg[$this->error],
        );
    }

    public function insert($data)
    {
        if (!$this->create($data)) {
            return false;
        }

        $result = $this->add($data);
        if ($result) {
            return true;
        }

        $this->error = 10000;
        return false;
    }

    public function update($id, $data)
    {
        if (!$this->create($data, 2)) {
            return false;
        }
        $map['id'] = $id;
        $result    = $this->where($map)->save($data);
        if ($result) {
            return true;
        }
        $this->error = 10000;
        return false;
    }

    public function lists($map = array(), $order = '', $page_index = 1, $page_size = 10)
    {
        if ($page_inde == 1) {
            $list = $this->where($map)->order($order)->limit($page_index . ',' . $page_size)->select();
        } else {
            $list = $this->where($map)->order($order)->select();
        }

        $count = $this->where($map)->count();
        return array(
            'list'  => $list,
            'count' => $count,
        );
    }

    public function get($map = array())
    {
        return $this->where($map)->find();
    }
}
