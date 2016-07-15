<?php
namespace Common\Helper;

use Common\Helper\Curl;

class Sms
{
    const API_URL = 'http://wapi.c123.cn/tx/?';
    const uid     = '50122498';
    const pwd     = '123456';
    protected $error = array(
        100 => '发送成功',
        101 => '验证失败',
        102 => '短信不足',
        103 => '操作失败',
        104 => '非法字符',
        105 => '内容过多',
        106 => '号码过多',
        107 => '频率过快',
        108 => '号码内容空',
        109 => '账号冻结',
        110 => '禁止频繁单条发送',
        111 => '系统暂定发送',
        112 => '号码错误',
        113 => '定时时间格式不对',
        114 => '账号被锁，10分钟后登录',
        115 => '连接失败',
        116 => '禁止接口发送',
        117 => '绑定IP不正确',
        118 => '系统升级',
    );

    public function send($mobile, $content)
    {
        $data['uid']     = self::uid;
        $data['pwd']     = md5(self::pwd);
        $data['mobile']  = $mobile;
        $data['content'] = $content;

        $url = self::API_URL.http_build_query($data);

        $curl = new Curl();
        $result = $curl->get($url);
        if ($result == 100) {
            return true;
        } else {
            $this->error_code = $result;
            return false;
        }
    }

    public function getError()
    {
        return $this->error[$this->error_code];
    }
}
