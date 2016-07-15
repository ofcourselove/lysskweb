<?php
namespace Admin\Controller;

use Common\Helper\Page;
use Think\Controller;

class BaseController extends Controller
{
    protected $has_page = 1;
    public function _initialize()
    {
        if (!session('uid')) {
            redirect(U('Login/index'));
        }
    }

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
            $data  = $model->lists($map, 'id desc', '', $page_index, $page_size);
            $list  = $data['list'];
            $count = $data['count'];
        } else {
            if ($page_index) {
                $page_index = ($page_index - 1) * $page_size;
                $list       = $model->where($map)->order('id desc')->limit($page_index . ',' . $page_size)->select();

            } else {
                $list = $model->where($map)->order('id desc')->select();
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

    public function add()
    {
        $this->display();
    }

    public function edit()
    {
        $model = D(CONTROLLER_NAME);

        $id = (int) I('get.id');

        $map['id'] = $id;
        $info      = $model->where($map)->find();
        $this->assign('vo', $info);
        $this->display('add');
    }

    public function insert()
    {
        $model = D(CONTROLLER_NAME);

        if (!$model->create()) {
            $error = $model->getError();
            $this->error($error['error_msg']);
        }

        $result = $model->add();
        if ($result) {
            $this->success('操作成功', U(CONTROLLER_NAME . '/index'));
        } else {
            $this->error('操作失败');
        }
    }

    public function update()
    {
        $model = D(CONTROLLER_NAME);

        if (!$model->create()) {
            $error = $model->getError();
            $this->error($error['error_msg']);
        }

        $id = (int) I('id');

        $map['id'] = $id;

        $result = $model->where($map)->save();

        if ($result) {
            $this->success('操作成功', U(CONTROLLER_NAME . '/index'));
        } else {
            $this->error('操作失败');
        }
    }

    public function del()
    {
        $model = D(CONTROLLER_NAME);

        $id = (int) I('id');

        $map['id'] = $id;

        $result = $model->where($map)->delete();

        if ($result) {
            $this->success('操作成功', U(CONTROLLER_NAME . '/index'));
        } else {
            $this->error('操作失败');
        }
    }
}
