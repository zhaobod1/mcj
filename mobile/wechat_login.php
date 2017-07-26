<?php
include  $_SERVER['DOCUMENT_ROOT'].'/mobile/wechat/functions.php';
$id=isset($_GET['id'])?$_GET['id']:0;
$url = 'http://127.0.0.1:8089/check_login/?id='.$id;
$host='http://127.0.0.1:8089';
$src=$host.'/static/'.$id.'_qr.png';

if($id)
{
    $arr=array();
    $data=fetch($host.'/login/?id='.$id,$arr);
    $dataArray=json_decode($data,true);
    if($dataArray and $dataArray['code']==200)
    {
      echo "get QR SUCCESS";
    }
}else {
    die('NO USER');
}

?>

<html>
<head>
    <title>please scan QR code</title>
    <script src="/mobile/wechat_html/js/jquery.min.js"></script>
    <script language="JavaScript">
        //window.location.reload();
        //获得status ，200 跳转 至列表页
        //$.get()方法
        var count = 0;
        function ajaxGet() {
            $.get(
                "<?=$url?>",      //url地址
                {},
                function (data) { //回传函数
                   var dataObject = JSON.parse(data);
                      console.log(data)
                    if (dataObject.code == 300) {
                        location.href = '/mobile/wechat/memberlist.php?id=<?=$id?>';
                    } else {

                        if (count == 10) {
                            $('#show_title').text('请您扫描二维码进行登录');
                        } else {
                            count++;
                        }
                    }

                },
                "text")
        }


       // var intervalId=setInterval('ajaxGet()', 2000); //指定1秒刷新一次
    </script>
</head>
<body>
<h1 id="show_title">scan</h1>

<a href="/mobile/wechat/memberlist.php?id=<?=$id?>" role="button" class="btn btn-success btn-sm pull-left">确认</a>
<img src="<?=$src?>" alt="请扫描微信二维码"/>

</body>
</html>
