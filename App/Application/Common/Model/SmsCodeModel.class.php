<?php
namespace Common\Model;
use Common\Model\BaseModel;

class SmsCodeModel extends BaseModel
{
    protected $tableName = 'sms_code';

    public function insert($mobile, $content, $code)
    {
        $data['mobile'] = $mobile;
        $data['content'] = $content;
        $data['code'] = $code;

        $result = $this->add($data);
        return $result;
    }

    public function check($mobile, $code)
    {
        $map['mobile'] = $mobile;
        $map['code'] = $code;

        $info = $this->where($map)->find();
        if ($info) {
            return true;
        } else {
            return false;
        }
    }
}