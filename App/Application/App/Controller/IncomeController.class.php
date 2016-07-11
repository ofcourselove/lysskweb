<?php
namespace App\Controller;

use App\Controller\BaseController;

class IncomeController extends BaseController
{
    public function index()
    {
        $page_index = (int)I('page_index', 1);
        $page_size = (int)I('page_size', 10);

        $model = M('user');

        $list = $model->order('income desc')->select();
        $user_id = array_column($list, 'id');

        $map['user_id'] = array('in', $user_id);

        $invite_list = $model->field('count(invite_user_id) as count, invite_user_id')->group('invite_user_id')->where($map)->select();
        $invite_list = array_column($invite_list, null, 'invite_user_id');
        foreach ($list as $_k => $_v) {
            if (isset($invite_list[$_v['id']])) {
                $list[$_k]['subordinate'] = $invite_list[$_v['id']]['count'];
            } else {
                $list[$_k]['subordinate'] = 0;
            }
        }
        $count = $model->count();
        $data['page_index'] = $page_index;
        $data['page_size'] = $page_size;
        $data['list'] = $list;
        $data['count'] = $count;

        $this->apiSuccess($data);
    }
}
