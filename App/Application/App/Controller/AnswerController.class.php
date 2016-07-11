<?php
namespace App\Controller;

use App\Controller\BaseController;

class AnswerController extends BaseController
{
    public function lists()
    {
        $problem_id = (int) I('get.problem_id');
        $page_index = (int) I('get.page_index', 1);
        $page_size  = (int) I('get.page_size', 10);

        if (empty($problem_id)) {
            $this->apiError(10004, 'problem_id不可为空');
        }

        $model = D('Answer');
        $data  = $model->listsByProblemId($problem_id, $page_index, $page_size);

        if ($data['count'] > 0) {
            $this->apiSuccess($data);
        } else {
            $this->apiError(10000, '请求失败或数据为空');
        }
    }

    public function insert()
    {
        if (!IS_POST) {
            $this->apiError(10000, '操作失败');
        }

        $data            = I('post.');
        $data['user_id'] = $this->user_id;

        $model = D('Answer');

        $result = $model->insert($data);
        if (!$result) {
            $error = $model->getError();
            $this->apiError($error['error_code'], $error['error_msg']);
        } else {
            $this->apiSuccess();
        }
    }
}
