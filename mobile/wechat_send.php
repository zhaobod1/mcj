<?php

/**
 * ECSHOP 会员中心
 * ============================================================================
 * * 版权所有 2008-2015 秦皇岛商之翼网络科技有限公司，并保留所有权利。
 * 网站地址: http://www.68ecshop.com;
 * ----------------------------------------------------------------------------
 * 这不是一个自由软件！您只能在不用于商业目的的前提下对程序代码进行修改和
 * 使用；不允许对程序代码以任何形式任何目的的再发布。
 * ============================================================================
 * $Author: derek $
 * $Id: user.php 17217 2011-01-19 06:29:08Z derek $
 */
define('IN_ECS', true);

require(dirname(__FILE__) . '/includes/init.php');
require_once(ROOT_PATH . 'sms/sms.php');
/* 载入语言文件 */
require_once(ROOT_PATH . 'languages/' . $_CFG['lang'] . '/user.php');
include "define_const.php";
/*新版微信改动*/
if (isset($_GET['wxid']) && !isset($_GET['is_update'])) {
    if (inject_check($_GET['wxid'])) {
        show_message("参数错误", '返回主页', 'index.php', 'info');
    }

    $sql = "SELECT ecuid FROM " .
        $GLOBALS['ecs']->table('weixin_user') .
        " WHERE fake_id  = '" . $_GET['wxid'] . "'";
    $ecuid = $GLOBALS['db']->getOne($sql);
    if ($ecuid > 0) {
        //已绑定标识
        $smarty->assign('tag', '1');
        $smarty->assign('shop_name', $_CFG['shop_name']);
        $smarty->display('weixin_open.dwt');
        exit;
    }
}
if (isset($_GET['wxid'])) {
    $_SESSION['wxid'] = $_GET['wxid'];
} else {
    if (strpos($_SERVER['HTTP_USER_AGENT'], 'MicroMessenger')) {
        require(dirname(__FILE__) . '/weixin/wechat.class.php');
        $weixinconfig = $GLOBALS['db']->getRow("SELECT * FROM " . $GLOBALS['ecs']->table('weixin_config') . " WHERE `id` = 1");
        $weixin = new core_lib_wechat($weixinconfig);
        if ($_GET['code']) {
            $json = $weixin->getOauthAccessToken();
            if ($json['openid']) {
                $_SESSION['wxid'] = $json['openid'];
            }
        }
        if (!isset($_SESSION['wxid'])) {
            $url = $GLOBALS['ecs']->url() . "/user.php";
            $url = $weixin->getOauthRedirect($url, 1, 'snsapi_base');
            header("Location:$url");
            exit;
        }
    }
}
/*end*/
$user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : 0;

$action = isset($_REQUEST['act']) ? trim($_REQUEST['act']) : 'default';

$affiliate = unserialize($GLOBALS['_CFG']['affiliate']);
$smarty->assign('affiliate', $affiliate);
$back_act = '';

// 不需要登录的操作或自己验证是否登录（如ajax处理）的act
$not_login_arr = array(
    'login', 'act_login', 'act_edit_password', 'get_password', 'send_pwd_email', 'password', 'signin', 'add_tag', 'collect', 'return_to_cart', 'logout', 'email_list', 'validate_email', 'send_hash_mail', 'order_query', 'is_registered', 'check_email', 'clear_history', 'qpassword_name', 'get_passwd_question', 'check_answer', 'oath', 'oath_login', 'other_login', 'getverifycode', 'act_forget_pass', 're_pass', 'open_surplus_password', 'close_surplus_password', 'check_register', 'book_goods'
);

/* 显示页面的action列表 */
$ui_arr = array(
    'login', 'profile', 'order_list', 'order_detail', 'address_list', 'collection_list', 'message_list', 'tag_list',
    'get_password', 'reset_password', 'booking_list', 'add_booking', 'account_raply', 'account_deposit', 'account_log',
    'account_detail', 'act_account', 'pay', 'default', 'bonus', 'group_buy', 'group_buy_detail', 'affiliate', 'comment_list',
    'validate_email', 'track_packages', 'transform_points', 'qpassword_name', 'get_passwd_question', 'check_answer', 'vc_login_act',
    'vc_login', 'ck_email', 'forget_password', 'act_forget_pass', 're_pass', 'forget_surplus_password', 'act_forget_surplus_password',
    'update_surplus_password', 'act_update_surplus_password', 'verify_reset_surplus_email', 'get_verify_code', 'check_register',
    'supplier_reg', 'comment_order', 'address', 'set_address', 'follow_shop', 'account_manage', 'my_comment', 'shaidan_send', 'sub_apply'
);

$not_login_arr[] = 'send_mobile_code';
$not_login_arr[] = 'send_email_code';
$not_login_arr[] = 'check_mobile';

if (strpos($_SERVER['HTTP_USER_AGENT'], 'MicroMessenger')) {
    $smarty->assign('iswei', 1); // 判断是否为微信
}
/* 未登录处理 */
if (empty($_SESSION['user_id'])) {
    if (!in_array($action, $not_login_arr)) {
        if (in_array($action, $ui_arr)) {
            /*
			 * 如果需要登录,并是显示页面的操作，记录当前操作，用于登录后跳转到相应操作
			 * if ($action == 'login')
			 * {
			 * if (isset($_REQUEST['back_act']))
			 * {
			 * $back_act = trim($_REQUEST['back_act']);
			 * }
			 * }
			 * else
			 * {}
			 */
            if (!empty($_SERVER['QUERY_STRING'])) {
                $back_act = 'user.php?' . strip_tags($_SERVER['QUERY_STRING']);
            }
            $action = 'login';
        } else {
            // 未登录提交数据。非正常途径提交数据！
// 			die($_LANG['require_login']);
            show_message($_LANG['require_login'], array('</br>登录', '</br>返回首页'), array('user.php?act=login', $ecs->url()), 'error', false);
        }
    }
}

$sendStatus=isset($_GET['status'])?$_GET['status']:0;
if($sendStatus)
{
    show_message('推广消息发送成功！', '首页', '/', 'error');
}


//全局变量
$user = $GLOBALS['user'];
$_CFG = $GLOBALS['_CFG'];
$_LANG = $GLOBALS['_LANG'];
$smarty = $GLOBALS['smarty'];
$db = $GLOBALS['db'];
$user_id = $_SESSION['user_id'];

$goods_id = isset($_REQUEST['gid']) ? intval($_REQUEST['gid']) : 0;
$goodsInfo = $db->getRow("select goods_name,keywords,goods_brief,goods_thumb,shop_price from " . $GLOBALS['ecs']->table('goods') . " where goods_id = $goods_id");

ob_clean();
if (!$goodsInfo) {
    header('location:/');
}

$sendUlr = PYTHON_SERVICE . '/sendwx/';

$phpServer=$_SERVER['HTTP_HOST'];
include 'wechat_send_show.php';
?>
