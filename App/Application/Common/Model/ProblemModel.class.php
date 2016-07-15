<?php
namespace Common\Model;

use Common\Model\BaseModel;

class ProblemModel extends BaseModel
{
    protected $tableName = 'problem';

    protected $_validate = array(
        array('title', 'require', 10001, 1),
        array('desc', 'require', 10002, 1),
    );

    protected $_auto = array(
        array('status', 0),
        array('create_time', 'time', 1, 'function'),
        array('modify_time', 'time', 3, 'function'),
    );

    protected $_error_msg = array(
        10000 => '操作失败',
        10001 => 'title不可为空',
        10002 => 'desc不可为空',
        10003 => 'problem_id不可为空',
    );

    public function lists($map = array(), $page_index = 1, $page_size = 10)
    {
        $map['status'] = 1;
        $page_index    = ($page_index - 1) * $page_size;
        $list          = $this->where($map)->limit($page_index . ',' . $page_size)->select();
        return $list;
    }

    public function status($id, $status)
    {
        $map['id'] = $id;

        return $this->where($map)->setField('status', $status);
    }

    public function get($map = array())
    {
        $map['status'] = 1;
        return $this->where($map)->find();
    }
}
