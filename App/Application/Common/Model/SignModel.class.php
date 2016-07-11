<?php
namespace Common\Model;

use Common\Model\BaseModel;

class SignModel extends BaseModel
{
    protected $tableName = 'sign';

    public function insert($user_id)
    {
        $data['user_id'] = $user_id;
        $data['create_time'] = time();

        $result = $model->add($data);
        if ($result) {
            return true;
        } else {
            return false;
        }
    }
}
