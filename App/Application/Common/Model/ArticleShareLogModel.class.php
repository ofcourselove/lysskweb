<?php
namespace Common\Model;

use Common\Model\BaseModel;

class ArticleShareLogModel extends BaseModel
{
    protected $tableName = 'article_share_log';

    protected $_error_msg = array(
        10000   => '操作失败',
    );

    /**
     * 写入分享记录
     * @param  [type]  $article_id [description]
     * @param  [type]  $user_id    [description]
     * @param  integer $type       [description]
     * @return [type]              [description]
     */
    public function insert($article_id, $user_id, $type=1)
    {
        $info = $this->get($article_id, $user_id, $type);
        if ($info) {
            return $info['id'];
        }
        $data['article_id'] = $article_id;
        $data['user_id'] = $user_id;
        $data['type'] = $type;
        $data['create_time'] = time();

        $result = $this->add($data);

        if ($result) {
            return $result;
        }
        $this->error = 10000;
        return false;
    }

    public function get($article_id, $user_id, $type='')
    {
        $map['article_id'] = $article_id;
        $map['user_id'] = $user_id;
        if (!empty($map)) {
            $map['type'] = $type;
        }

        $info = $this->where($map)->find();
        if ($info) {
            return true;
        } else {
            return false;
        }
    }
}