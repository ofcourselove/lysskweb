<?php
//微信
$str="/sq_1.php";

$str_url=urlencode($str);

$appid = "wx0000000000000000";
$url = 'https://open.weixin.qq.com/connect/oauth2/authorize?appid='.$appid.'&redirect_uri='.$str_url.'&response_type=code&scope=snsapi_userinfo&state=STATE#wechat_redirect';

header("Location:".$url);


?>
