<?php
namespace Common\Wechat;
/**
 *微信支付
 */
class Pay
{

	function pay($openids,$amount,$desc='测试')
	{
			require_once ('/api_test.php');
			$appid = "wxc5ea396b77bc9630";
			$secret = "8b11ee67b860e8727a9bda1b3e2be221";
			$mch_appid=$appid;
			$mchid='1298185701';//商户号
			$nonce_str='qyzf'.rand(100000, 999999);//随机数
			$partner_trade_no='HW'.time().rand(10000, 99999);//商户订单号
			$openid=$openids;//用户唯一标识
			$check_name='NO_CHECK';//校验用户姓名选项，NO_CHECK：不校验真实姓名 FORCE_CHECK：强校验真实姓名（未实名认证的用户会校验失败，无法转账）OPTION_CHECK：针对已实名认证的用户才校验真实姓名（未实名认证用户不校验，可以转账成功）
			$re_user_name='测试';//用户姓名
			$amount=$amount;//金额（以分为单位，必须大于100）
			$desc=$desc;//描述  暂时为测试
			$spbill_create_ip=$_SERVER["REMOTE_ADDR"];//请求ip
			//封装成数据
			$dataArr=array();
			$dataArr['amount']=$amount;
			$dataArr['check_name']=$check_name;
			$dataArr['desc']=$desc;
			$dataArr['mch_appid']=$mch_appid;
			$dataArr['mchid']=$mchid;
			$dataArr['nonce_str']=$nonce_str;
			$dataArr['openid']=$openid;
			$dataArr['partner_trade_no']=$partner_trade_no;
			$dataArr['re_user_name']=$re_user_name;
			$dataArr['spbill_create_ip']=$spbill_create_ip;

			$sign=getSign($dataArr);

			// echo "-----<br/>签名：".$sign."<br/>*****";//die;
			$data="<xml>
			<mch_appid>".$mch_appid."</mch_appid>
			<mchid>".$mchid."</mchid>
			<nonce_str>".$nonce_str."</nonce_str>
			<partner_trade_no>".$partner_trade_no."</partner_trade_no>
			<openid>".$openid."</openid>
			<check_name>".$check_name."</check_name>
			<re_user_name>".$re_user_name."</re_user_name>
			<amount>".$amount."</amount>
			<desc>".$desc."</desc>
			<spbill_create_ip>".$spbill_create_ip."</spbill_create_ip>
			<sign>".$sign."</sign>
			</xml>";
			// var_dump($data);

			$ch = curl_init ();
			$MENU_URL="https://api.mch.weixin.qq.com/mmpaymkttransfers/promotion/transfers";
			curl_setopt ( $ch, CURLOPT_URL, $MENU_URL );
			curl_setopt ( $ch, CURLOPT_CUSTOMREQUEST, "POST" );
			curl_setopt ( $ch, CURLOPT_SSL_VERIFYPEER, FALSE );
			curl_setopt ( $ch, CURLOPT_SSL_VERIFYHOST, FALSE );

			$zs1="/apiclient_cert.pem";
			$zs2="/apiclient_key.pem";
			curl_setopt($ch,CURLOPT_SSLCERT,$zs1);
			curl_setopt($ch,CURLOPT_SSLKEY,$zs2);
			// curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (compatible; MSIE 5.01;
			// Windows NT 5.0)');
			curl_setopt ( $ch, CURLOPT_FOLLOWLOCATION, 1 );
			curl_setopt ( $ch, CURLOPT_AUTOREFERER, 1 );
			curl_setopt ( $ch, CURLOPT_POSTFIELDS, $data );
			curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, true );

			$info = curl_exec ( $ch );

			if (curl_errno ( $ch )) {
				echo 'Errno' . curl_error ( $ch );
			}
			curl_close ( $ch );
			// echo "-----<br/>请求返回值：";
			// var_dump($info);
			// echo "<br/>*****";die;
  }
}

?>
