<?php
namespace Common\Model;

class AnswerModel extends Model
{
    protected $tableName = 'answer';

    protected $_validate = array(
        array('problem_id', 'require', 10001, 1),
        array('answer', 'require', 10002, 1),
        array('user_id', 'checkUser', 10003, 1, 'callback'),
    );

    protected $_auto = array(
        array('status', 0),
        array('create_time', 'time', 1, 'function'),
        array('modify_time', 'time', 3, 'function'),
    );

    protected $_error_msg = array(
        10001 => '非法提交',
        10002 => '答案不可为空',
        10003 => '不可自问自答',
        10004 => 'problem_id不可为空',
    );

    protected function checkUser()
    {
        $problem_id   = I('post.problem_id');
        $problemModel = D('Problem');
        $map['id']    = $problem_id;

        $info = $problemModel->where($map)->find();
        if ($info) {
            return false;
        }
        return true;
    }

    public function listsByProblemId($problem_id, $page_index = 1, $page_size = 10)
    {
        $map['problem_id'] = $problem_id;
        return $this->lists($map, $page_index, $page_size);
    }

    public function lists($map = array(), $page_index = 1, $page_size = 10)
    {
        $map['status'] = 1;
        $page_index    = ($page_index - 1) * $page_size;
        $list          = $this->where($map)->limit($page_index . ',' . $page_size)->select();
        return $list;
    }

    public function get($map = array())
    {
        $map['status'] = 1;
        return $this->where($map)->find();
    }
}
