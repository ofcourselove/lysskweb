<?php
namespace Common\Model;

use Common\Model\BaseModel;

class CategoryModel extends BaseModel
{
    protected $tableName = 'category';

    protected $_validate = array(
        array('name', 'require', 10001, 1),
        array('name', '', 10002, 1, 'unique', 1),
    );

    protected $_auto = array(
        array('sort', 0),
        array('create_time', 'time', 1, 'function'),
        array('modify_time', 'time', 3, 'function'),
    );

    protected $_error_msg = array(
        10001 => '栏目名称不可为空',
        10002 => '栏目已存在',
        10000 => '操作失败',
    );

    public function lists($map = array(), $order = 'sort desc')
    {

        $list  = $this->where($map)->order($order)->select();
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
