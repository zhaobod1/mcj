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
 //测试接口
$profile=array(
	"username"=>"如初wx_4907",
	"mobile_phone"=>'18554898815'
);
 $res = $uCenter->edit_user($profile);

 echo $res;


