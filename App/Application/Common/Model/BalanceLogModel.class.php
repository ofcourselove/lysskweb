<?php
namespace Common\Model;

use Think\Model;

class BalanceLogModel extends Model
{
    protected $tableName = 'balance_log';

    public function addLog($user_id, $balance, $type, $option_type, $remark = '')
    {
        $data['user_id']     = $user_id;
        $data['balance']     = $balance;
        $data['type']        = $type;
        $data['option_type'] = $option_type;
        $data['remark']      = $remark;
        $data['create_time'] = time();

        $result = $this->add($data);

        if ($result) {
            return true;
        } else {
            return false;
        }
    }
}
