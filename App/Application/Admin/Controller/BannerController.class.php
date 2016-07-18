<?php
namespace Admin\Controller;

use Admin\Controller\BaseController;

class BannerController extends BaseController
{
  public function index(){
    $model = D('Admin');
    $check = $model->check(54);
    if (!$check) {
      $this->error('无访问权限');
    }
    parent::index();
  }
  public function add(){
    $model = D('Admin');
    $check = $model->check(51);
    if (!$check) {
      $this->error('无访问权限', U('/Admin/banner'));
    }
    parent::add();
  }
  public function edit(){
    $model = D('Admin');
    $check = $model->check(53);
    if (!$check) {
      $this->error('无访问权限', U('/Admin/banner'));
    }
    parent::edit();
  }
  public function del(){
    $model = D('Admin');
    $check = $model->check(52);
    if (!$check) {
      $this->error('无访问权限', U('/Admin/banner'));
    }
    parent::del();
  }
}
