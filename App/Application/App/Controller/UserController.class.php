<?php
namespace App\Controller;

class UserController extends CheckBaseController
{
    /**
     * 绑定或更换手机
     * @return [type] [description]
     */
    public function changeMobile()
    {
        $mobile = I('post.mobile');

        if (empty($mobile)) {
            $this->apiError(10001, 'mobile不可为空');
        }

        $model = D('User');

        $map['id'] = $this->user_id;

        $result = $model->where($map)->setField('mobile', $mobile);
        if ($result) {
            $this->apiSuccess();
        } else {
            $this->apiError();
        }
    }

    public function bindAlipay()
    {
        $alipay_account = I('post.alipay_account');
        $alipay_name    = I('post.alipay_name');

        if (empty($alipay_account)) {
            $this->apiError(10001, 'alipay_account不可为空');
        }
        if (empty($alipay_name)) {
            $this->apiError(10002, 'alipay_name不可为空');
        }

        $map['id']              = $this->user_id;
        $data['alipay_account'] = $alipay_account;
        $data['alipay_name']    = $alipay_name;

        $result = $model->where($map)->save($data);
        if ($result) {
            $this->apiSuccess();
        } else {
            $this->apiError();
        }
    }

    public function bindWeixin()
    {
        $openid = I('post.openid');

        if (empty($openid)) {
            $this->apiError(10010, '缺少openid');
        }
        $model  = D('User');
        $result = $model->bind_weixin($this->user_id, $openid);
        if ($result) {
            $this->apiSuccess();
        } else {
            $this->apiError();
        }
    }

    public function changePassword()
    {
        $old_password = I('post.old_password');
        $password     = I('post.password');
        $rep_password = I('post.rep_password');

        if (empty($old_password)) {
            $this->apiError(10001, '原密码不可为空');
        }
        if (empty($password)) {
            $this->apiError(10002, '新密码不可为空');
        }
        if (empty($rep_password)) {
            $this->apiError(10003, '请再次输入密码');
        }
        if ($rep_password != $password) {
            $this->apiError(10004, '两次密码不一致');
        }

        $model     = D('User');
        $map['id'] = $this->user_id;
        $info      = $model->where($map)->find();
        if ($info['password'] != md5($old_password)) {
            $this->apiError(10005, '原始密码不正确');
        }

        $data['password'] = md5($password);

        $result = $model->where($map)->save($data);

        if ($result) {
            $this->apiSuccess();
        } else {
            $this->apiError();
        }
    }

    /**
     * 申请提现接口
     * @return [type] [description]
     */
    public function withdraw()
    {
        $amount   = I('amount', '');
        $pay_type = I('pay_type', '');

        if (empty($amount)) {
            $this->apiError(10001, '缺少amount');
        }

        if (empty($pay_type)) {
            $this->apiError(10002, '缺少pay_type');
        }

        // 查询余额
        $userModel = D('User');

        $map['id'] = $this->user_id;

        $balance = $userModel->where($map)->getField('balance');

        if ($amount > $balance) {
            $this->apiError(10003, '余额不足');
        }

        $model = D('WithdrawLog');

        $result = $model->insert($this->user_id, $amount, $pay_type);
        // 扣除余额
        $userModel->deductBalance($this->user_id, $amount, 8, '提现');
        if ($result) {
            $this->apiSuccess();
        } else {
            $this->apiError(10000);
        }
    }

    public function withdraw_list()
    {
        $model          = D('WithdrawLog');
        $page_index     = (int) I('page_index', 1);
        $page_size      = (int) I('page_size', 10);
        $map['user_id'] = $this->user_id;

        $list          = $model->where($map)->order('create_time desc')->limit($page_index . ',' . $page_size)->select();
        $count         = $model->where($map)->count();
        $data['list']  = $list;
        $data['count'] = $count;
        $this->apiSuccess($data);
    }

    public function getSubIncome()
    {
        $model = D('User');

        $map['invote_user_id'] = $this->user_id;

        $info = $model->where($map)->field('sum(`income`) as income')->find();
        $income = $info['income'];

        $this->apiSuccess($income);
    }

}
