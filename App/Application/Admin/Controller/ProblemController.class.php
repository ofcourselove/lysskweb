<?php
namespace Admin\Controller;

use Admin\Controller\BaseController;

class ProblemController extends BaseController
{
    public function status()
    {
        $id     = (int) I('id');
        $status = (int) I('status');

        $model = D('Problem');

        $map['id'] = $id;
        $result    = $model->where($map)->setField('status', $status);

        if ($result) {
            $this->success('操作成功');
        } else {
            $this->error('操作失败');
        }
    }
}
