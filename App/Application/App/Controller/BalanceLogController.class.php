<?php
namespace App\Controller
use App\Controller\CheckBaseController;

class BalanceLogController extends CheckBaseController
{
    public function lists()
    {
        $option_type = I('get.option_type');
        $page_index  = (int) I('get.page_index');
        $page_size   = (int) I('get.page_size');

        $map = array('in', $option_type);

        $model = D('BalanceLog');
        $data  = $model->lists($map, 'id desc', $page_index, $page_size);

        $this->apiSuccess($data);
    }
}
