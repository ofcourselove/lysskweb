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
    public function withdraw_list()//提现金额
    {
    	$user_id = (int) I('user_id');
      $map['user_id'] = $user_id;
    	$model = D('BalanceLog');
    	$list = $model->where($map)->order('id ')->select();
    	$this->assign('list', $list);
        $this->display('index');
    }
    public function  recharge_list()//康转币数
    {
    	$user_id = (int) I('user_id');
    	$model = D('BalanceLog');
    	$list = $model->where('user_id='.$user_id . ' and type=11 ')->select();
    	$this->assign('list', $list);
        $this->display('index');
    }
    public function play_tour()//打赏
    {
    	$user_id = (int) I('user_id');
    	$model = D('BalanceLog');
    	$list = $model->where('user_id='.$user_id . ' and type=9 ')->select();
    	$this->assign('list', $list);
        $this->display('index');
    }
}
