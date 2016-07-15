<?php
namespace Admin\Controller;

use Admin\Controller;

class AdminController extends BaseController
{
    public function index()
    {
      $admin = session('uid');
      if ($admin!=1) {   //只有超级管理员能访问此页
        $this->error('无访问权限', U('/Admin'));
      }
      parent::index();
    }
    public function _before_del()
    {
        $id = (int) I('id');

        if ($id == 1) {
            $this->error('默认管理员不可被删除');
        }
    }

    public function insert()
    {
        $model = D('Admin');

        $result = $model->insert(I('post.'));
        if ($result) {
            $this->success('操作成功', U('Admin/index'));
        } else {
            $this->error($model->getError());
        }
    }

    public function update()
    {
        $model = D('Admin');

        $result = $model->update(I('post.'));

        if ($result !== false) {
            $this->success('操作成功', U('Admin/index'));
        } else {
            $this->error('操作失败');
        }
    }
    /*****
    * 对管理员权限的操作
    *
    ******/
    public function level()
    {
      $id = I('id');
      $select = I('select');//获取用户设置的level值
      $model = D('Admin');
      $list = $model->where('id='.$id)->find();
      $level = $list['level'];//从数据库提去level值
      $level =explode(',',$level);//数据库中字符串变成数组
      if (!empty($select)) {
         for ($i=0; $i < count($select) ; $i++) {
               if (!in_array($select[$i],$level)) { //检测数据库level中是否已存在
                   array_push($level,$select[$i]);  //如果没有压入数组中
               }
         }
         $level = implode(',',$level);  //数组变字符串存到数据库
         $state = $model->where('id='.$id)->setField('level',$level);
        if ($state) {
          $this->success('操作成功', U('Admin/index'));
        } else {
          $this->error('操作失败');
        }
      }
      $this->assign('list',$list);
      $this->assign('level',$level);
      $this->display();
    }
}
