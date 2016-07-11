<?php
namespace Admin\Controller;

use Admin\Controller;

class ArticleController extends BaseController
{
    public function _before_add()
    {
        $category_list = D('Category')->select();
        $category_list = $this->tree($category_list);
        $this->assign('category_list', $category_list);

    }

    public function _before_edit()
    {
        $this->_before_add();
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
}
