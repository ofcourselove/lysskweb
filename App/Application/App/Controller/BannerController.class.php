<?php
namespace App\Controller;

use App\Controller\BaseController;

class BannerController extends BaseController
{
    public function gets()
    {
        $id        = (int) I('get.id');
        $model     = D('Banner');
        $map['id'] = $id;

        $info = $model->get($map);
        if ($info) {
            $this->apiSuccess($info);
        } else {
            $error = $model->getError();
            $this->apiError($error['error_code'], $error['error_msg']);
        }
    }

    public function lunbo()
    {
        $model = D('Banner');
        $map['is_lunbo'] = 1;

        $list = $model->where($map)->select();
        $this->apiSuccess($list);
    }
}
