<?php
namespace Admin\Controller;

use Admin\Controller\BaseController;

class BannerController extends BaseController
{
  public function index(){
    $model = D('Admin');
    $check = $model->check(54);
    if (!$check) {
<<<<<<< HEAD
      $this->error('无访问权限');
=======
      $this->error('无访问权限', U('/Admin'));
>>>>>>> 15e37d68e0dc17d8168f481f5fea2cd0eb207a06
    }
    parent::index();
  }
  public function add(){
    $model = D('Admin');
    $check = $model->check(51);
    if (!$check) {
      $this->error('无访问权限', U('/Admin/banner'));
    }
<<<<<<< HEAD
    parent::add();
=======
    parent::insert();
>>>>>>> 15e37d68e0dc17d8168f481f5fea2cd0eb207a06
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
