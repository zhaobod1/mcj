<?php

/**
 * ECSHOP 专题前台
 * ============================================================================
 * 版权所有 2005-2011 上海商派网络科技有限公司，并保留所有权利。
 * 网站地址: http://www.ecshop.com；
 * ----------------------------------------------------------------------------
 * 这不是一个自由软件！您只能在不用于商业目的的前提下对程序代码进行修改和
 * 使用；不允许对程序代码以任何形式任何目的的再发布。
 * ============================================================================
 * @author:     webboy <laupeng@163.com>
 * @version:    v2.1
 * ---------------------------------------------
 */

define('IN_ECS', true);
require(dirname(__FILE__) . '/includes/init.php');
require_once (ROOT_PATH . 'sms/sms.php');

if ((DEBUG_MODE & 2) != 2)
{
    $smarty->caching = true;
}

if (empty($_SESSION['user_id'])){
	$back_act = "user.php";
	if (!empty($_SERVER['QUERY_STRING']))
    {
      $back_act = 'apply_sub.php?' . strip_tags($_SERVER['QUERY_STRING']);
    }
    show_message('请先登陆！', array('返回上一页','点击去登陆'), array($back_act, 'user.php'), 'info');
}

//var_dump($_POST);die();
$userid = $_SESSION['user_id'];

$shownum = (isset($_REQUEST['shownum'])) ? intval($_REQUEST['shownum']) : 0;

$upload_size_limit = $_CFG['upload_size_limit'] == '-1' ? ini_get('upload_max_filesize') : $_CFG['upload_size_limit'];

if(isset($_POST['do']) && $_POST['do']){
	unset($apply,$save);
	if($shownum == 1){
		if($_POST['person'])
		{
			$save['country'] = isset($_POST['country']) ? intval($_POST['country']) : 1; 
			$save['province'] = isset($_POST['province']) ? intval($_POST['province']) : 0;
			$save['city'] = isset($_POST['city']) ? intval($_POST['city']) : 0;
			$save['district'] = isset($_POST['district']) ? intval($_POST['district']) : 0;
			$save['address'] = isset($_POST['address']) ? trim(addslashes(htmlspecialchars($_POST['address']))) : '';
			$save['full_name'] = isset($_POST['contacts_name']) ? trim(addslashes(htmlspecialchars($_POST['contacts_name']))) : '';
			$save['telephone'] = isset($_POST['contacts_phone']) ? trim(addslashes(htmlspecialchars($_POST['contacts_phone']))) : '';
			$save['email'] = isset($_POST['email']) ? trim($_POST['email']) : '';
            $save['level'] = isset($_POST['apply_type']) ? trim($_POST['apply_type']) : 1;


            if($save['level']==2)
            {

                $save['district']==0 and $save['district']=1;
            }else if($save['level']==3)
            {
                $save['district']==0 and $save['district']=1;
                $save['city']==0 and $save['city']=1;
            }
            //必填项验证
			$save1 = array_filter($save);
			if(count($save1)!=count($save)){
                    show_message('请认真填写必填申请资料！', '返回', 'apply_sub.php', 'wrong');
			}
			// 验证是否可以申请该地区分站
            $db = $GLOBALS['db'];
            $ecs = $GLOBALS['ecs'];
            $province=$save['province'];
            $city=$save['city'];
            $district=$save['district'];
            $level= $save['level'];
            $state=1;
            $is_unique=1;
            $isExist = $db->getOne('SELECT is_unique FROM ' . $ecs->table('substation_apply') . " WHERE state<13 and state>=11 and level='$level' and is_unique='$is_unique' and province='$province' and city='$city' and district=".$district);
            if($isExist)
            {
                show_message('抱歉，该地区已分站已存在！', '返回', 'user.php', 'wrong');
            }


            $save['member_id']=$userid;
            $save['created_at']=time();
             if($db->autoExecute($ecs->table('substation_apply'),$save)!==false)
             {

                 header("location:apply_sub.php");
                 //发送需要新审核短信
                 $mobile='18561893237';
                 $content='您好，你有一条新的分站申请需要审核 '.date('Y-m-d H:i:s',time());
                 $result = sendSMS($mobile, $content);
                 exit;
             }else{
                 show_message('操作失败！', '返回', 'apply_sub.php', 'wrong');
             }
		}
	}else if($shownum == 11){
         // 删除已提交的记录，
        $sql = 'UPDATE ' . $ecs->table('substation_apply') . ' SET state =-1 '.
            "WHERE member_id = '" . $userid . "'";
        $db->query($sql);
    }
}



if (!$smarty->is_cached($templates, $cache_id))
{ 

    /* 模板赋值 */
    assign_template();
    $position = assign_ur_here();
    $smarty->assign('page_title',       $position['title']);       // 页面标题
    $smarty->assign('ur_here',          $position['ur_here'] . '> ' . $topic['title']);     // 当前位置
    
}
ini_set('error_log', 'd:\wwwroot\mcj\wwwroot\log.txt');
$smarty->assign('piclimit',$upload_size_limit);
$smarty->assign('userid',intval($_SESSION['user_id']));
$smarty->display('apply_sub.dwt');

?>