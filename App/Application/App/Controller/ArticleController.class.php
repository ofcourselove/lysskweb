<?php
namespace App\Controller;

use App\Controller\BaseController;

class ArticleController extends BaseController
{
    public function lists()
    {
        $page_index  = (int) I('post.page_index', 1);
        $page_size   = (int) I('post.page_size', 10);
        $category_id = (int) I('post.category_id', '');
        $type        = (int) I('post.type', '');

        if ($page_index - 1 < 0) {
            $this->apiError(10001, 'page_index参数错误');
        }
        if ($page_size <= 0) {
            $this->apiError(10002, 'page_size参数错误');
        }

        $map = array();
        if (!empty($category_id)) {
            $map['a.category_id'] = $category_id;
        }
        if (!empty($type)) {
            $map['a.type'] = $type;
        }

        $model = D('Article');

        $data = $model->lists($map, $page_index, $page_size);

        $data['page_index'] = $page_index;
        $data['page_size']  = $page_size;

        $this->apiSuccess($data);
    }

    public function gets()
    {
        $id = (int) I('get.id');

        $map['id'] = $id;

        $model = D('Article');

        $info = $model->get($map);

        if ($info) {
            $model->addClick($id);
            $this->apiSuccess($info);
        }
        $this->apiError(10003, '数据为空');
    }
}
