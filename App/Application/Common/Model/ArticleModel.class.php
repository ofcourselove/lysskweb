<?php
namespace Common\Model;

use Common\Model\BaseModel;

class ArticleModel extends BaseModel
{
    protected $tableName = 'article';

    protected $_validate = array(
        array('category_id', 'require', 10001, 1),
        array('title', 'require', 10002, 1),
        array('content', 'require', 10003, 1),
    );

    protected $_auto = array(
        array('click_count', 0),
        array('create_time', 'time', 1, 'function'),
        array('modify_time', 'time', 3, 'function'),
    );

    protected $_error_msg = array(
        10001   => '请选择栏目',
        10002   => '标题不可为空',
        10003   => '内容不可为空',
        10000   =>  '操作失败',
    );

    public function lists($map=array(), $page_index = 1, $page_size = 10)
    {
        $page_index = ($page_index - 1) * $page_size;
        $table = '__ARTICLE__ as a';
        $join = '__CATEGORY__ as c on a.category_id = c.id';
        $fields = array(
            'a.id' => 'id',
            'a.category_id' => 'category_id',
            'a.title' => 'title',
            'a.type' => 'type',
            'a.click_count' => 'click_count',
            'a.thumb' => 'thumb',
            'a.create_time' => 'create_time',
            'c.name' => 'category_name',
        );
        $list = M()->table($table)->join($join)->field($fields)->where($map)->order('a.id desc')->select();
        $count = M()->table($table)->join($join)->where($map)->count();
        return array(
            'list' => $list,
            'count' => $count,
        );
    }

    public function get($map=array())
    {
        return $this->where($map)->find();
    }

    public function addClick($id)
    {
        $map['id'] = $id;
        $data['click_count'] = array('exp', 'click_count+1');

        return $this->where($map)->save($data);
    }
}
