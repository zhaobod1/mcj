<?php

include  $_SERVER['DOCUMENT_ROOT'].'/mobile/wechat/functions.php';
define(WECHAT_APP_ROOT,'/mobile/wechat_html/');

$arr=array();
//$data=fetch('http://127.0.0.1:8089/frinds/',$arr);
//var_dump($data);
$username='';
$page=1;
$limit=10;
$list=array();
$list['data']=array();

for($x=0;$x<1000;$x++)
{
    $list['data'][$x]['id']=$x;
    $list['data'][$x]['username']='username'.$x;
    $list['data'][$x]['sex']=0;
    $list['data'][$x]['state']=0;
}



$list['count']=100;
$count=10;
?>

<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- 上述3个meta标签*必须*放在最前面，任何其他内容都*必须*跟随其后！ -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="/img/ico/favicon.ico">

    <title>鼎商动力后台管理系统 V1.1</title>

    <!-- Ploceidae core CSS -->
    <link href="<?=WECHAT_APP_ROOT?>css/ploceidae.css" rel="stylesheet">
    <!-- perfect-scrollbar CSS -->
    <link href="<?=WECHAT_APP_ROOT?>css/perfect-scrollbar.css" rel="stylesheet">
    <!-- iCheck checkbox-->
    <link rel="stylesheet" href="<?=WECHAT_APP_ROOT?>css/plugins/iCheck/flat/blue.css">
    <!-- datepicker 普通日期选择器-->
    <link rel="stylesheet" href="<?=WECHAT_APP_ROOT?>css/plugins/datepicker/datepicker3.css">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="<?=WECHAT_APP_ROOT?>js/html5shiv.min.js"></script>
    <script src="<?=WECHAT_APP_ROOT?>js/respond.min.js"></script>
    <![endif]-->
</head>

<body class="hold-transition skin-blue sidebar-mini sidebar-collapse">
<!-- Main Header -->
<div id="header">
    <?php include $_SERVER['DOCUMENT_ROOT']."/mobile/wechat/header.php";?>
</div>

<div class="wrapper">
    <!-- Left side column. contains the logo and sidebar -->
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper scroll_bar">
        <div class="content">
            <ol class="breadcrumb">
                <li><a href="javascript:;"><i class="icon-crown"></i> 微信群发</a></li>
                <li class="active"> 好友列表</li>
            </ol>
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h5 class="box-title">好友列表</h5>
                    <div class="box-tools">
                        <div class="has-feedback">
                            <a href="javascript:;" id="getMore" class="btn btn-primary btn-sm"><i class="icon-circle"></i> 发送</a>
                        </div>
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body no-padding">
                    <div class="mailbox-controls">
                        <form class="form-inline">
                            <!-- Check all button -->
                            <div class="form-group">
                                <label>关键字：</label>
                                <input type="text" name="username" value="<?=$username?>" class="form-control input-sm" placeholder="请输入关键字">
                            </div>
                            <a href="javascript:;" id="search" role="button" class="btn btn-primary btn-sm"><i class="icon-magnifier"></i> 搜索</a>
                        </form>
                    </div>
                    <div class="box-footer clearfix">
                        <a href="javascript:;" class="mailbox-messages btn btn-sm checkbox-toggle" style="padding-left: 0px;">
                            <label><input type="checkbox" id="cbAll" value="all"> 全选</label>
                        </a>
                        <!-- Check all button -->
                    </div>
                    <div class="table-responsive mailbox-messages">
                        <table class="table table-hover table-striped">
                            <tbody>
	                            <tr>
	                                <th width="5%">编号</th>
	                                <th class="text-left">好友名称</th>
	                                <th class="text-left">性别</th>
	                                <th class="text-center">好友备注</th>
	                            </tr>
                                <?php if(isset($list['data']) && $list['data'] and is_array($list['data'])){ ?>
                                    <?php foreach ($list['data'] as $key=>$value){ ?>
                                    <tr class="tableValue" data-id="<?=isset($value['id']) ? $value['id'] : '' ?>">
                                        <td><label><input type="checkbox" name='batchCheckBox'> <?=($page-1)>=0 ? ($page-1)*$limit+$key+1 : 0?></label></td>
                                        <td class="text-left">
                                            <div class="table-content">
                                                <div class="table-content-text">
                                                    <?=isset($value['username']) ? $value['username'] : ''?>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="text-left">
                                            <?php if(isset($value['sex'])){
                                                switch ($value['sex'])
                                                {
                                                    case 0:
                                                        echo '女';
                                                        break;
                                                    case 1:
                                                        echo '男';
                                                        break;
                                                    default:
                                                        echo '保密';
                                                        break;
                                                }
                                            } ?>
                                        </td>

                                        <td class=" text-center member_state">
                                            <div class="table-content">
                                                <div class="table-content-text">
                                                    <?=isset($value['username']) ? $value['username'] : ''?>
                                                </div>
                                            </div>
                                        </td>

                                    </tr>
                                        <?php } ?>
                                <?php } ?>
                            </tbody>
                        </table>
                        <!-- /.table -->
                    </div>
                    <!-- /.mail-box-messages -->
                </div>
                <?php if($count > 0){ ?>
                    <div class="box-footer clearfix">
                        <!-- Check all button -->
                        <ul class="pagination pagination-sm no-margin pull-right">
                            <?php if($pages['first']==$pages['last']){?>
                                <li class="disabled"><a href="javascript:;" aria-label="Previous"><span aria-hidden="true"><i class="icon-arrow-left"></i></span></a></li>
                                <li class="active"><a href="javascript:;">1 <span class="sr-only">(current)</span></a></li>
                                <li class="disabled"><a href="javascript:;" aria-label="Next"><span aria-hidden="true"><i class="icon-arrow-right"></i></span></a></li>
                            <?php }else{?>
                                <?php if($pageInfo->page<=1){?>
                                    <li class="disabled"><a href="javascript:;" aria-label="Previous"><span aria-hidden="true"><i class="icon-arrow-left"></i></span></a></li>
                                <?php }else{ ?>
                                    <li><a href="/Backstage/Member/memberList?page=<?=($pageInfo->page-1)?>&start_time=<?=$start_time?>&end_time=<?=$end_time?>&username=<?=$username?>" aria-label="Previous"><span aria-hidden="true"><i class="icon-arrow-left"></i></span></a></li>
                                <?php }?>
                                <?php if($pageInfo->page==1){?>
                                    <li class="active"><a href="/Backstage/Member/memberList?page=1&start_time=<?=$start_time?>&end_time=<?=$end_time?>&username=<?=$username?>"><?=$pages['first']?> <span class="sr-only">(current)</span></a></li>
                                <?php }else{ ?>
                                    <li><a href="/Backstage/Member/memberList?page=1&start_time=<?=$start_time?>&end_time=<?=$end_time?>&username=<?=$username?>"><?=$pages['first']?> <span class="sr-only">(current)</span></a></li>
                                <?php }?>
                                <?php if($pages['prev']){echo "<li class='more'><a href='javascript:;'>...</a></li>";} ?>

                                <?php foreach($pages['index'] AS $v){?>
                                    <?php if($pageInfo->page == $v){?>
                                        <li class="active"><a href="javascript:;"><?=$v?></a></li>
                                    <?php }else{ ?>
                                        <li><a href="/Backstage/Member/memberList?page=<?=$v?>&start_time=<?=$start_time?>&end_time=<?=$end_time?>&username=<?=$username?>"><?=$v?></a></li>
                                    <?php } ?>
                                <?php } ?>
                                <?php if($pages['next']){echo "<li class='more'><a href='javascript:;'>...</a></li>";} ?>

                                <?php if($pageInfo->page==$pages['last']){?>
                                    <li class="active"><a href="/Backstage/Member/memberList?page=<?=$pages['last']?>&start_time=<?=$start_time?>&end_time=<?=$end_time?>&username=<?=$username?>"><?=$pages['last']?></a></li>
                                <?php }else{ ?>
                                    <li><a href="/Backstage/Member/memberList?page=<?=$pages['last']?>&start_time=<?=$start_time?>&end_time=<?=$end_time?>&username=<?=$username?>"><?=$pages['last']?></a></li>
                                <?php } ?>

                                <?php if($pageInfo->page==$pages['last']){ ?>
                                    <li class="disabled"><a href="javascript:;" aria-label="Next"><span aria-hidden="true"><i class="icon-arrow-right"></i></span></a></li>
                                <?php }else{ ?>
                                    <li><a href="/Backstage/Member/memberList?page=<?=($pageInfo->page+1)?>&start_time=<?=$start_time?>&end_time=<?=$end_time?>&username=<?=$username?>" aria-label="Next"><span aria-hidden="true"><i class="icon-arrow-right"></i></span></a></li>
                                <?php } ?>
                            <?php }?>
                            <li>
                                <div class="input-group">
                                    <input type="text" class="form-control" id="num" onkeyup='value=value.replace(/^0/g,""); value=value.replace(/[^0-9]/g,"")'>
                                    <span class="input-group-btn" ><a class="btn btn-primary" href="javascript:;" onclick="Go()" >Go</a></span>
                                </div>
                            </li>
                        </ul>
                    </div>
                <?php } ?>


            </div>
        </div>
    </div>

    <!-- /.content-wrapper -->
</div>
<!-- Placed at the end of the document so the pages load faster -->
<script src="<?=WECHAT_APP_ROOT?>js/jquery.min.js"></script>
<!-- plugins -->
<script src="<?=WECHAT_APP_ROOT?>js/plugins/transition.js"></script>
<script src="<?=WECHAT_APP_ROOT?>js/plugins/dropdown.js"></script>
<script src="<?=WECHAT_APP_ROOT?>js/plugins/tab.js"></script>
<script src="<?=WECHAT_APP_ROOT?>js/plugins/tooltip.js"></script>
<script src="<?=WECHAT_APP_ROOT?>js/plugins/modal.js"></script>
<script src="<?=WECHAT_APP_ROOT?>js/plugins/iCheck/icheck.min.js"></script>
<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
<script src="<?=WECHAT_APP_ROOT?>js/ie10-viewport-bug-workaround.js"></script>
<!-- scrollbar -->
<script src="<?=WECHAT_APP_ROOT?>js/scrollbar/jquery.mousewheel.js"></script>
<script src="<?=WECHAT_APP_ROOT?>js/scrollbar/perfect-scrollbar.js"></script>
<!-- 普通日期选择器 -->
<script src="<?=WECHAT_APP_ROOT?>js/plugins/datepicker/datepicker.js"></script>
<script type="text/javascript">
    $(function(){
        // 外部文件引入
//        $("#header").load("header.html");
//        $("#left").load("left.html");

        // 表单全选
        $('#cbAll').on('ifChecked', function(event){
            $('input[name="batchCheckBox"]').iCheck('check');
        });
        $('#cbAll').on('ifUnchecked', function(event){
            $('input[name="batchCheckBox"]').iCheck('uncheck');
        });      
    });
        
    //Date range picker with time picker（普通日期选择器）
    $('.datepicker').datepicker({
        autoclose: true
    });
    // scrollbar 滚动条
    //------------------------------------------
    jQuery(document).ready(function ($) {
        "use strict";
        $('.scroll_bar').perfectScrollbar();
    });
    $(function () {
        // iCheck
        //------------------------------------------
        //Enable iCheck plugin for checkboxes
        //iCheck for checkbox and radio inputs
        $('.mailbox-messages input[type="checkbox"]').iCheck({
            checkboxClass: 'icheckbox_flat-blue',
            radioClass: 'iradio_flat-blue'
        });

        //Enable check and uncheck all functionality
        $(".checkbox-toggle").click(function () {
            var clicks = $(this).data('clicks');
            if (clicks) {
                //Uncheck all checkboxes
                $(".mailbox-messages input[type='checkbox']").iCheck("uncheck");
                $("i", this).removeClass("icon-check").addClass('icon-check-empty');
            } else {
                //Check all checkboxes
                $(".mailbox-messages input[type='checkbox']").iCheck("check");
                $("i", this).removeClass("icon-check-empty").addClass('icon-check');
            }
            $(this).data("clicks", !clicks);
        });
        // Tooltip
        //------------------------------------------
        $("[data-toggle='tooltip']").tooltip();
    });

    $('#search').click(function(){
        var start_time = $("input[name='start_time']").val();
        var end_time = $("input[name='end_time']").val();
        var username = $("input[name='username']").val();
        window.location.href = "/Backstage/Member/memberList?page=1&start_time="+start_time+"&end_time="+end_time+"&username="+username;
    })

    function Go(){
        var page = $("#num").val();
        var start_time = $("input[name='start_time']").val();
        var end_time = $("input[name='end_time']").val();
        var username = $("input[name='username']").val();
        if(page == ''){
            return false ;
        }
        var count =0;
        if(page > count){
            window.location.href = "/Backstage/Member/memberList?page="+count+"&start_time="+start_time+"&end_time="+end_time+"&username="+username;
        }else {
            window.location.href = "/Backstage/Member/memberList?page="+page+"&start_time="+start_time+"&end_time="+end_time+"&username="+username;
        }
    }

    $('#getMore').click(function () {

        $.post("/Backstage/Member/getMore",{},function(json){
            if(json.errcode == '601')
            {
                $('#modal2 .modal-body').find('h5').html(json.errmsg);
                $('#modal2 .modal-footer').html('<a href="javascript:;" role="button" class="btn btn-success btn-sm pull-center" data-dismiss="modal"">确认</a>');
                $('#modal2').modal();
                return;
            }else{
                return;
            }
        },'json')

    });

    $('.batchDo').click(function(){
        var state=$(this).attr('state');

        var arr = [];
        $('.tableValue').find('.icheckbox_flat-blue').each(function(i)
        {
            var imageId=$(this).parents('tr').attr('data-id');

            if($(this).attr('aria-checked') == "true"){
                arr.push(imageId);
            }
        })
        var paramStr = '';
        for(var i in arr)
        {
            paramStr += (arr[i] + ',');
        }

        if(!paramStr)
        {
            $('#modal .modal-body').find('h5').html("请选择会员");
            $('#modal .modal-footer').html('<a href="javascript:;" role="button" class="btn btn-success btn-sm pull-left" data-dismiss="modal">确认</a><a href="javascript:;" role="button" class="btn btn-warning btn-sm pull-right" data-dismiss="modal">放弃</a>');
            $('#modal').modal();
            return;
        }
        paramStr = paramStr.substr(0,paramStr.length-1);
        paramStr = "'"+paramStr + "'";
        $('#modal .modal-body').find('h5').html("你确认要执行此程序吗");
        $('#modal .modal-footer').html('<a href="javascript:;" onclick="doCmd('+paramStr+','+state+')" role="button" class="btn btn-success btn-sm pull-left" data-dismiss="modal">确认</a><a href="javascript:;" role="button" class="btn btn-warning btn-sm pull-right" data-dismiss="modal">放弃</a>');
        $('#modal').modal();
        return;
    })

    function doCmd(paramStr,state){

        $.post("/Backstage/Member/batchChangeStatus",{ids:paramStr,state:state},function(json){
            if(json.state == -1)
            {
                $('#modal2 .modal-body').find('h5').html(json.msg);
                $('#modal2 .modal-footer').html('<a href="javascript:;" role="button" class="btn btn-success btn-sm pull-center" data-dismiss="modal"">确认</a>');
                $('#modal2').modal();
                return;
            }else{
                window.location.reload()
                return;
            }
        },'json')
    }

    $('.member_state').click(function(){
        var value = $(this).attr('state');
        if(value == 1)
        {
            var state = 0;
        }else{
            var state = 1;
        }
        var id = $(this).parents('tr').attr('data-id');
        $.post("/Backstage/Member/batchChangeStatus",{ids:id,state:state},function(json){
            if(json.state == -1)
            {
                $('#modal2 .modal-body').find('h5').html(json.msg);
                $('#modal2 .modal-footer').html('<a href="javascript:;" role="button" class="btn btn-success btn-sm pull-center" data-dismiss="modal"">确认</a>');
                $('#modal2').modal();
                return;
            }else{
                window.location.reload()
                return;
            }
        },'json')
    })
</script>
<!-- AdminLTE App -->
<script src="<?=WECHAT_APP_ROOT?>js/app.js"></script>
</body>
</html>
