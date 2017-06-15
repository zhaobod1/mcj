<?php
/**
 * Created by 火一五信息科技有限公司.
 * Tel :15288986891
 * QQ  :3186355915
 * web :http://host.huo15.com
 * User: zhaobo
 * Date: 2017/5/6
 * Time: 上午2:20
 */

include_once(ROOT_PATH . 'includes/modules/integrates/ucenter.php');

$cfg=array(
	"fix"=>1,
	"uc_id"=>"1",
	"uc_key"=>"gfj7s7u2V0F7N5844chcv5nep3S897zb702072b1f2p2saT2J5if368ce1o8G3U5",
	"uc_url"=>"http://u.mengchengjie.com/",
	"uc_ip"=>"211.149.214.242",
	"uc_connect"=>"mysql",
	"uc_charset"=>"utf-8",
	"db_host"=>"localhost",
	"db_user"=>"mcjcenter",
	"db_name"=>"mcjcenter",
	"db_pass"=>"huo15com",
	"db_pre"=>"uc_",
	"db_charset"=>"utf8",
	"uc_lang"=>array(
		"credits"=> array(
			0=>array(
				0=>"等级积分"
			),
			1=>array(
				0=>"等级积分"
			),
		),
		"exchange"=>"UCenter积分兑换",

	),
	"cookie_domain"=>"",
	"cookie_path"=>"/",
	"tag_number"=>"",
	"quiet"=>1,
);

$uCenter=new ucenter($cfg);

$GLOBALS['uCenter']=$uCenter;