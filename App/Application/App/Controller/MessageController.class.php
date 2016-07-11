<?php
namespace App\Controller;

use App\Controller\CheckBaseController;

class MessageController extends CheckBaseController
{
    public function lists()
    {
        $page_index = (int) I('page_index');
        $page_size  = (int) I('page_size');

        $model = D('Message');
        $model->init($this->user_id);
        $map['ml.user_id'] = $this->user_id;

        $data = $model->lists($map, 'is_read asc', $page_index, $page_size);

        $this->apiSuccess($data);
    }

    public function info()
    {
        $id = I('id');

        $model = D('Message');

        $map['id'] = $id;

        $info = $model->info($map);

        $this->apiSuccess($info);
    }
}
