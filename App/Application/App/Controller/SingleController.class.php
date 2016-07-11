<?php
namespace App\Controller;
use App\Controller\BaseController;

class SingleController extends BaseController
{
    public function info()
    {
        $id = (int)I('id');

        $model = D('Single');

        $map['id'] = $id;

        $info = $model->where($map)->find();
        $this->apiSuccess($info);
    }
}