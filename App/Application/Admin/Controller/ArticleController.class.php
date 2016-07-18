<?php
namespace Admin\Controller;

use Admin\Controller;

class ArticleController extends BaseController
{
    public function _before_add()
    {
        $model = D('Admin');
        $check = $model->check(31);
        if (!$check) {
          $this->error('无访问权限', U('/Admin'));
        }
        $category_list = D('Category')->select();
        $category_list = $this->tree($category_list);
        $this->assign('category_list', $category_list);

    }

    public function _before_edit()
    {
        $model = D('Admin');
        $check = $model->check(33);
        if (!$check) {
          $this->error('无访问权限', U('/Admin/article'));
        }

        $this->_before_add();
    }
    public function del()
    {
        $model = D('Admin');
        $check = $model->check(32);
        if (!$check) {
          $this->error('无访问权限', U('/Admin'));
        }
        parent::del();

    }

    private static function tree($list, $pid = 0, $level = 0, $html = '--')
    {
        static $tree = array();
        foreach ($list as $v) {
            if ($v['pid'] == $pid) {
                $v['sort'] = $level;
                $v['html'] = str_repeat($html, $level);
                $tree[]    = $v;
                self::tree($list, $v['id'], $level + 1);
            }
        }
        return $tree;
    }
    public function index()
    {
      $model = D('Admin');
			$check = $model->check(34);
			if (!$check) {
				$this->error('无访问权限');
			}
      $model = D('article');
      $list = $model->join('left join ly_category on ly_article.category_id=ly_category.id')->select();
      // echo $model->getLastSql(); die;
      // print_r($list);die;
      $this->assign('list', $list);
      $this->display('index');
    }
    public function article_list()
    {
        $user_id = (int) I('user_id');
        $model = D('article_share_log');
        $list = $model->field('article_id')->where('user_id='.$user_id)->order('id ')->select();
        $article_id = $list['0']['article_id'];//获得文章id
        $imodel = D('article');
        $list = $imodel->where('id in('.$article_id.')')->order('id')->select();//获得文章信息
        $this->assign('list', $list);
        $this->display('article_list');
    }
}
