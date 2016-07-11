<?php
namespace App\Controller;

use App\Controller\CheckBaseController;

class SignController extends CheckBaseController
{
    public function sign()
    {
        $model  = D('Sign');
        $result = $model->insert($this->user_id);

        if ($result) {
            $this->apiSuccess();
        } else {
            $this->apiError();
        }
    }

    public function checkSign()
    {
        $model = M('Sign');

        $map['user_id'] = $this->user_id;
        $map['FROM_UNIXTIME(`create_time`, "%Y-%m-%d")'] = date('Y-m-d', time());

        $info = $model->where($map)->find();
        if ($info) {
            $this->apiSuccess();
        }
        $this->apiError();
    }
}
