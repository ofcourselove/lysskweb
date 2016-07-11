<?php
namespace Admin\Controller;

use Admin\Controller;

class AdminController extends BaseController
{
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
}
