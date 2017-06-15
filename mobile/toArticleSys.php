<?php
/**
 * Created by 火一五信息科技有限公司.
 * Tel :15288986891
 * QQ  :3186355915
 * web :http://host.huo15.com
 * User: zhaobo
 * Date: 2017/5/6
 * Time: 上午11:32
 */

require 'includes/ucenterInit.php';

if (!isset($_SESSION['user_id'])) {
	show_message("非法操作！！","返回首页",'index.php');
	die;
}


$uCenter = $GLOBALS['uCenter'];
/* //测试接口
 * $res = $uCenter->test('uc_user_checkphone', array(
	'phone'=>'123456'
));*/

$username=isset($_SESSION['user_name'])? $_SESSION['user_name']:0;

$sql = "select mobile_phone, user_money, user_name from " . $GLOBALS['ecs']->table('users') . " where user_name='" . $username . "'";
$row = $GLOBALS['db']->getRow($sql);

$arg=array(
	'username'=>$row['user_name'],
	'mobile_phone'=>$row['mobile_phone'],
	'user_money'=>$row['user_money'],
);
/*
$res = $uCenter->edit_user($arg,1);
if (!$res) {
	show_message("同步数据失败，请重试，或者联系管理员解决错误。");
	die;
}
*/
//$username, $password, $rember=0
$data = $uCenter->test('uc_get_user',$arg['username']);
if ($data) {
	list($uid, $username, $email) = $data;

	$res = $uCenter->test('uc_user_synlogin', $uid);
	$GLOBALS['synlogin']=$res;
}
//ecs_header("Location: http://article.mengchengjie.com\n");







	/*
 * array(15) {
  ["from_ad"]=&gt;
  int(0)
  ["referer"]=&gt;
  string(6) "本站"
  ["login_fail"]=&gt;
  int(0)
  ["last_time"]=&gt;
  string(10) "1494054699"
  ["last_ip"]=&gt;
  string(12) "39.89.53.104"
  ["wxid"]=&gt;
  string(28) "obACNsyWlHQvqsTHhlkPzwsIDE0s"
  ["VT_MOBILE_VALIDATE"]=&gt;
  string(11) "18554898815"
  ["captcha_word"]=&gt;
  string(16) "MjIxY2ViYWVlNA=="
  ["security_validate"]=&gt;
  bool(false)
  ["user_id"]=&gt;
  string(3) "295"
  ["admin_id"]=&gt;
  string(1) "0"
  ["user_name"]=&gt;
  string(13) "如初wx_9905"
  ["user_rank"]=&gt;
  string(1) "1"
  ["discount"]=&gt;
  float(1)
  ["email"]=&gt;
  string(0) ""
}
int(-7)

 */
