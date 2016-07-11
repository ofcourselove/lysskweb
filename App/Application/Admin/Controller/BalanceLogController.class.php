<?php
namespace Admin\Controller;

use Admin\Controller\BaseController;

class BalanceLogController extends BaseController
{
    public function _search()
    {
        $user_id = (int) I('user_id');

        $map['user_id'] = $user_id;
        return $map;
    }
}
