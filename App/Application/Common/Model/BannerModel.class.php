<?php
namespace Common\Model;

use Common\Model\BaseModel;

class BannerModel extends BaseModel
{
    protected $tableName = 'banner';
    protected $_validate = array(
        array('name', 'require', 10001, 1),
        array('content', 'require', 10002, 1),
    );
    protected $_auto = array(
        array('create_time', 'time', 1, 'function'),
        array('modify_time', 'time', 3, 'function'),
    );
    protected $_error_msg = array(
        10000 => '操作失败',
        10001 => '请输入广告位标题',
        10002 => '请输入广告内容',
    );
}
