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
        $page_index = (int) I('p', 1);
        $page_size  = (int) I('page_size', 10);

        if ($this->has_page == 0) {
            $page_index = 0;
        }

        $model = D('Category');

        $map = array();
        if (method_exists($this, '_search')) {
            $map = $this->_search();
        }

        if (method_exists($model, 'lists')) {
            $data  = $model->lists($map, 'sort desc', '', $page_index, $page_size);
            $list  = $data['list'];
            $count = $data['count'];
        } else {
            if ($page_index) {
                $page_index = ($page_index - 1) * $page_size;
                $list       = $model->where($map)->order('sort desc')->limit($page_index . ',' . $page_size)->select();

            } else {
                $list = $model->where($map)->order('sort desc')->select();
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
}
