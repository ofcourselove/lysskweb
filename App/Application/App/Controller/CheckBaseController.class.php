<?php
namespace App\Controller;

use App\Controller\BaseController;

class CheckBaseController extends BaseController
{
    public function _initialize()
    {
        parent::_initialize();

        if (empty($this->user_id)) {
            $this->apiError(11000, '用户未登录');
        }
    }
}
