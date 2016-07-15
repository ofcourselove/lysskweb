<?php
namespace Admin\Controller;

use Admin\Controller;

class UserController extends BaseController
{
	public function index()
	{
		$imodel = D('sign');
		$sign_num = $imodel->field('sign_num,id,user_id')->order('user_id desc')->select();
		$this->assign('sign',$sign_num);//将查处的sign表的值传到前端
	  parent::index();//继续使用父类的index方法

	}
	public function prentice()//徒弟
	{
		$user_id = (int) I('user_id');
    	$model = D('user');
    	$list = $model->where('id='.$user_id)->order('id ')->select();
    	$prentice_id = $list['0']['prentice_id'];
			// print_r($prentice_id);
    	$imodel = D('BalanceLog');
    	$list = $imodel->field("count(*) as count,user_id")->where('user_id in('.$prentice_id.') and type=4')->
    	group('user_id ')->select();//获得徒弟提问数
			// echo $imodel->getLastSql();
			// print_r($list);die;
    	$sum = 0.025;//每次提问徒弟获得0.1 师父获得0.1*25% 为0.025
    	$this->assign('sum',$sum);
    	$this->assign('list', $list);
        $this->display('prentice');
	}
	public function recommend()//推荐
	{
		$user_id = (int) I('user_id');
    	$model = D('user');
    	$list = $model->where('id='.$user_id)->order('id ')->select();
    	$prentice_id = $list['0']['prentice_id'];//获得徒弟id
    	print_r($prentice_id);
    	$list = $model->where('id in('.$prentice_id.')')->order('id')->select();//获得徒弟信息
    	// print_r($list);
    	$this->assign('list', $list);
	    $this->display('recommend');
	}
	// public function iindex()
	// {
	// 			$this->index();
	// }
}
