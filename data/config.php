<?php
/**
 * Created by iMac
 * config
 * 火一五信息科技有限公司
 * 联系方式:15288986891
 * QQ:3186355915
 * web:http://host.huo15.com
 * 日期：2017/1/22
 */
function huo15_get_client_ip()
{
	if ($_SERVER['REMOTE_ADDR']) {
		$cip = $_SERVER['REMOTE_ADDR'];
	} elseif (getenv("REMOTE_ADDR")) {
		$cip = getenv("REMOTE_ADDR");
	} elseif (getenv("HTTP_CLIENT_IP")) {
		$cip = getenv("HTTP_CLIENT_IP");
	} else {
		$cip = "unknown";
	}
	return $cip;
}



// database host
$db_host = "hdm174585311.my3w.com:3306";

// database name
$db_name = "hdm174585311_db";

// database username
$db_user = "hdm174585311";

// database password
$db_pass = "huo15com";

// table prefix
$prefix = "ecs_";

$timezone = "PRC";

$cookie_path = "/";

$cookie_domain = "";

$session = "1440";

define('EC_CHARSET', 'utf-8');

if (!defined('ADMIN_PATH')) {
	define('ADMIN_PATH', 'admin');
}

define('AUTH_KEY', 'this is a key');

define('OLD_AUTH_KEY', '');

define('API_TIME', '2017-06-14 14:20:08');


/**
 * 0 关闭debug
 * 1 显示错误信息
 * 2 关闭缓存
 * 4 显示debug页面
 * 8 记录sql查询
 *
 * 所有的调试模式都开启：
 * 15 = 1 + 2 + 4 + 8
 */

define('DEBUG_MODE', '1');


?>
