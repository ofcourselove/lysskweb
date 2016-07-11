<?php
namespace Admin\Controller;

use Admin\Controller;
use Common\Helper\Page;

class WithdrawLogController extends BaseController
{
    public function index()
    {
        $page_index = (int) I('p', 1);
        $page_size  = (int) I('page_size', 10);

        if ($this->has_page == 0) {
            $page_index = 0;
        }

        $model = D(CONTROLLER_NAME);

        $map = array();
        if (method_exists($this, '_search')) {
            $map = $this->_search();
        }

        if (method_exists($model, 'lists')) {
            $data  = $model->lists($map, 'status asc', '', $page_index, $page_size);
            $list  = $data['list'];
            $count = $data['count'];
        } else {
            if ($page_index) {
                $page_index = ($page_index - 1) * $page_size;
                $list       = $model->where($map)->order('status asc')->limit($page_index . ',' . $page_size)->select();

            } else {
                $list = $model->where($map)->order('status asc')->select();
            }
            $count = $model->where($map)->count();
        }
        if ($this->has_page) {
            $page      = new Page($count, $page_size);
            $page_list = $page->show();

            $this->assign('page_list', $page_list);
        }
        $this->assign('list', $list);
        $this->assign('count', $count);
        $this->assign('page_size', $page_size);
        $this->display();
    }

    public function status()
    {
        $status = (int) I('status');
        $model  = D('WithdrawLog');

        $map['id'] = (int) I('id');

        $info = $model->where($map)->find();

        $model->startTrans();
        $result = $model->where($map)->setField($status);

        if ($result) {
            switch ($status) {
                case 1:
                    $balance_result = true;
                    break;
                case 2:    //审核驳回返还提现金额
                    $userModel = D('User');

                    $balance_result = $userModel->addBalance($info['user_id'], $info['amount'], 9, '提现审核驳回退款');
                    break;
            }
            if ($balance_result) {
                $model->commit();
                $this->success('操作成功');
            } else {
                $model->rollback();
                $this->error('操作失败');
            }
        } else {
            $this->error('操作失败');
        }
    }
}
