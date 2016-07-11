<?php
namespace Common\Model;

use Common\Model\BaseModel;

class MessageModel extends BaseModel
{
    protected $tableName = 'Message';
    protected $_auto     = array(
        array('type', 1, 1, 'string'),
        array('create_time', 'time', 1, 'function'),
    );

    public function insert($title, $content)
    {
        $data['title']       = $title;
        $data['content']     = $content;
        $data['type']        = 1;
        $data['create_time'] = time();

        $result = $this->add($data);

        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    public function send($title, $content, $user_id)
    {
        $data['title']   = $title;
        $data['content'] = $content;
        $data['type']    = 2;

        $log_data['user_id']     = $user_id;
        $log_data['create_time'] = time();

        $this->startTrans();
        $result                 = $this->add($data);
        $log_data['message_id'] = $result;
        $log_result             = $this->add($data);

        if ($result !== false && $log_result !== false) {
            $this->commit();
            return true;
        } else {
            $this->rollback();
            return false;
        }
    }

    public function lists($map = array(), $order = 'is_read asc', $page_index = 1, $page_size = 10)
    {
        $table  = '__MESSAGE_LOG__ as ml';
        $join   = '__MESSAGE__ as m on ml.message_id = m.id';
        $fields = array(
            'ml.id'         => 'id',
            'ml.message_id' => 'message_id',
            'ml.user_id'    => 'user_id',
            'ml.is_read'    => 'is_read',
            'ml.read_time'  => 'read_time',
            'm.title'       => 'title',
            'm.content'     => 'content',
            'm.type'        => 'type',
            'm.create_time' => 'create_time',
        );

        if ($page_index == 0) {
            $list = M()->table($table)->join($join)->field($fields)->select();
        } else {
            $page_index = ($page_index - 1) * $page_size;
            $list       = M()->table($table)->join($join)->field($fields)->limit($page_index . ',' . $page_size)->select();
        }
        $count = M()->table($table)->join($join)->count();
        return array(
            'list'  => $list,
            'count' => $count,
        );
    }

    public function info()
    {
        $table  = '__MESSAGE_LOG__ as ml';
        $join   = '__MESSAGE__ as m on ml.message_id = m.id';
        $fields = array(
            'ml.id'         => 'id',
            'ml.message_id' => 'message_id',
            'ml.user_id'    => 'user_id',
            'ml.is_read'    => 'is_read',
            'ml.read_time'  => 'read_time',
            'm.title'       => 'title',
            'm.content'     => 'content',
            'm.type'        => 'type',
            'm.create_time' => 'create_time',
        );

        $info = M()->table($table)->join($join)->field($fields)->find();

        return $info;
    }

    public function init($user_id)
    {
        $model = D('MessageLog');

        $map['user_id'] = $user_id;

        $last_time = $model->where($map)->getField('create_time');

        $where = array();
        if (!empty($last_time)) {
            $where['create_time'] = array('egt', $last_time);
            $where['type']        = 1;

            $list = $this->where($where)->field('id, title, content, create_time')->select();
            if ($list) {
                $data = array();
                foreach ($list as $_k => $_v) {
                    $_data['message_id']  = $_v['id'];
                    $_data['user_id']     = $user_id;
                    $_data['is_read']     = 0;
                    $_data['read_time']   = null;
                    $_data['create_time'] = time();
                    array_push($data, $_data);
                }

                $result = $model->addAll($data);
            }
        } else {
            $where['type'] = 1;

            $list = $this->where($where)->field('id, title, content, create_time')->select();
            if ($list) {
                $data = array();
                foreach ($list as $_k => $_v) {
                    $_data['message_id']  = $_v['id'];
                    $_data['user_id']     = $user_id;
                    $_data['is_read']     = 0;
                    $_data['read_time']   = null;
                    $_data['create_time'] = time();
                    array_push($data, $_data);
                }

                $result = $model->addAll($data);
            }
        }
    }
}
