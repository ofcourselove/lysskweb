<?php
namespace App\Controller;

use App\Controller\BaseController;

class CategoryController extends BaseController
{
    public function lists()
    {
        $pid = I('post.pid', 0);
        $map['pid'] = $pid;

        $model = D('Category');

        $list = $model->lists($map);

        if ($list) {
            $this->apiSuccess($list);
        } else {
            $this->apiError(10000, '请求失败');
        }
    }
}
