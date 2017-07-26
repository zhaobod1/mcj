<?php
define('IN_ECS', true);

require(dirname(__FILE__) . '/includes/init.php');
require(dirname(__FILE__) . '/includes/lib_v_user.php');
require(dirname(__FILE__) . '/weixin/wechat.class.php');

// 获得网页版的二维码供扫描
include  $_SERVER['DOCUMENT_ROOT'].'/mobile/wechat/functions.php';
include "define_const.php";
$id=isset($_GET['id'])?$_GET['id']:0;

$url = PYTHON_SERVICE.'/check_login/?id='.$id;
$host=PYTHON_SERVICE;
$src=$host.'/static/'.$id.'_qr.png';
$goodsId=0;
if($id)
{
    $arr=array();
    $goodsId=isset($_GET['gid'])?$_GET['gid']:0;
    $data=fetch($host.'/login/?id='.$id,$arr);
    $dataArray=json_decode($data,true);

}else {
    die('NO USER');
}



//$smarty = $GLOBALS['smarty'];
//$smarty->assign('check_url',$url);
//$smarty->assign('img_url',$src);

//print_r($smarty);
//$smarty->display('wechat_login_erweima.dwt');
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="initial-scale=1.0, maximum-scale=1.0, user-scalable=0"/>
    <title>推广二维码</title>
    <!--v_shop.css-->
    <link href="themesmobile/68ecshopcom_mobile/css/v_user.css" type="text/css" rel="stylesheet">
    <script type="text/javascript" src="themesmobile/68ecshopcom_mobile/js/jquery.js"></script>
</head>
<body style=" background:#f5f5f5">


<!--header-->
<div class="top">
    <dl>
        <dt><a href="javascript:history.back(-1)"></a></dt>
        <dd>推广二维码</dd>
    </dl>
</div>
<!--main-->
<div class="erwei">
    <h4>扫一扫下面的二维码，在手机上确认微信网页版登录</h4>
    <em><img src="<?=$src?>" /></em>
<!--    <div class="link">-->
<!--        <span id="search_text" onClick="choose_attr(0)" class="search_text">确认登录，微信推广</span>-->
<!--    </div>-->
</div>

<script src="/mobile/wechat_html/js/jquery.min.js"></script>
<script>

    function choose_attr(num){
        window.location.href="/mobile/wechat_send.php?gid=<?=$goodsId?>"+"&id=<?=$id?>";
    }

    var count = 0;
    function ajaxGet() {
        $.get(
            "<?=$url?>",      //url地址
            {},
            function (data) { //回传函数
                var dataObject = JSON.parse(data);
                console.log(data)
                if (dataObject.code == 200) {
                    location.href = '/mobile/wechat_send.php?gid=<?=$goodsId?>'+'&id=<?=$id?>';
                } else {

                    if (count == 10) {
                        console.log('10');
                       // $('#show_title').text('请您扫描二维码进行登录');
                    } else {
                        count++;
                    }
                }
            },
            "text")
    }

    var intervalId=setInterval('ajaxGet()', 2000); //指定1秒刷新一次
</script>

<!-----底部悬浮菜单---->
<!-- #BeginLibraryItem "/library/vshop_footer.lbi" --><!-- #EndLibraryItem -->
</body>
</html>
