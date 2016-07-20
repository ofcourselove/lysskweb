<?php
namespace Admin\Controller;

use Admin\Controller\BaseController;
use Common\Helper\Page;

class CategoryController extends BaseController
{
    public function _search()
    {
        $map = array();
        $pid = (int) I('pid', 0);
        if ($pid != 0) {
            $map['pid'] = $pid;
        } else {
            $map['pid'] = 0;
        }
        return $map;
    }
    public function index()
    {
      $model = D('Admin');
      $check = $model->check(14);
      if (!$check) {
<<<<<<< HEAD
        $this->error('无访问权限');
=======
        $this->error('无访问权限', U('/Admin/admin'));
>>>>>>> 15e37d68e0dc17d8168f481f5fea2cd0eb207a06
      }
      parent::index();
    }
    public function add()
    {
      $model = D('Admin');
      $check = $model->check(11);
      if (!$check) {
        $this->error('无访问权限', U('/Admin/category'));
      }
      parent::insert();
    }
    public function edit()
    {
      $model = D('Admin');
      $check = $model->check(13);
      if (!$check) {
        $this->error('无访问权限', U('/Admin/category'));
      }
      parent::edit();
    }
    public function del()
    {
      $model = D('Admin');
      $check = $model->check(12);
      if (!$check) {
        $this->error('无访问权限', U('/Admin/category'));
      }
      parent::del();
    }
}
