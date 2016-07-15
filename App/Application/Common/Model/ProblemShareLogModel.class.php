<?php
namespace Common\Model;

use Common\Model\BaseModel;

class ProblemShareLogModel extends BaseModel
{
    protected $tableName = 'problem_share_log';

    protected $_error_msg = array(
        10000 => '操作失败',
    );

    /**
     * 写入转发记录
     * @param  [type]  $problem_id [description]
     * @param  [type]  $user_id    [description]
     * @param  integer $type       [description]
     * @return [type]              [description]
     */
    public function insert($problem_id, $user_id, $type = 1)
    {
        $info = $this->get($problem_id, $user_id, $type);
        if ($info) {
            return $info['id'];
        }
        $data['problem_id']  = $problem_id;
        $data['user_id']     = $user_id;
        $data['type']        = $type;
        $data['create_time'] = time();

        $result = $this->add($data);

        if ($result) {
            return $result;
        }
        $this->error = 10000;
        return false;
    }

    public function get($problem_id, $user_id, $type = '')
    {
        $map['problem_id'] = $problem_id;
        $map['user_id']    = $user_id;
        if (!empty($map)) {
            $map['type'] = $type;
        }

        $info = $this->where($map)->find();
        if ($info) {
            return true;
        } else {
            return false;
        }
    }
}
