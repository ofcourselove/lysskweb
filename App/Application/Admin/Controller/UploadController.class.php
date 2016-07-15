<?php
namespace Admin\Controller;

use Admin\Controller\BaseController;

class UploadController extends BaseController
{

    public function uploadImg()
    {
        $info = $this->upload();

        if (is_string($info)) {
            $output['status'] = 0;
            $output['info']   = $info;
            die(json_encode($output));
        }
        $info = array_shift($info);

        $path = './Upload/' . $info['savepath'] . $info['savename'];

        $output['status'] = 1;
        $output['info']   = $path;
        die(json_encode($output));
    }

    private function upload()
    {
        $upload           = new \Think\Upload(); // 实例化上传类
        $upload->maxSize  = 3145728; // 设置附件上传大小
        $upload->exts     = array('jpg', 'gif', 'png', 'jpeg'); // 设置附件上传类型
        $upload->savePath = ''; // 设置附件上传目录
        // 上传文件
        $info = $upload->upload($_FILES);
        if (!$info) {
            return $upload->getError();
        } else {
            return $info;
        }
    }
}
