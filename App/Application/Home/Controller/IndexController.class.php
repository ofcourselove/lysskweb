<?php
// 本类由系统自动生成，仅供测试用途
namespace Home\Controller;
use Think\Action;
use Common\Helper\Sms;
class IndexController extends Action {
    public function index()
    {
        $mobile = '18500402623';
        $content = 'test';

        $sms = new Sms();
        $result = $sms->send($mobile, $content);
        dump($result);
    }
}