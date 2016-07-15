<?php
namespace Common\Model;

use Common\Model\BaseModel;

class WithdrawLogModel extends BaseModel
{
    protected $tableName = 'withdraw_log';

    public function insert($user_id, $amount, $pay_type)
    {
        $data['user_id']     = $user_id;
        $data['amount']      = $amount;
        $data['pay_type']    = $pay_type;
        $data['status']      = 0;
        $data['create_time'] = time();
        $result              = $this->add($data);

        return $result;
    }

    public function lists($map = array(), $order = 'l.status desc', $field = '', $page_index = 1, $page_size = 10)
    {
        $table  = '__WITHDRAW_LOG as l';
        $join   = '__USER__ as u on u.id = l.user_id';
        $fields = array(
            'l.id'          => 'id',
            'l.user_id'     => 'user_id',
            'l.amount'      => 'amount',
            'l.pay_type'    => 'pay_type',
            'l.status'      => 'status',
            'l.create_time' => 'create_time',
            'u.username'    => 'username',
        );

        $list  = M()->table($table)->join($join)->field($fields)->order($order)->limit($page_index . ',' . $page_size)->select();
        $count = M()->table($table)->join($join)->count();

        return array('list' => $list, 'count' => $count);
    }

    public function status($id, $status)
    {
        $map['id'] = $id;
        $result    = $this->where($map)->setField('status', $status);
        return $result;
    }
}
