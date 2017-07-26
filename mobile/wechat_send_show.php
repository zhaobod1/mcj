<!DOCTYPE html >
<html>
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width">
<title> <?=$goodsInfo['keywords']?> </title>
<meta name="Keywords" content="{$keywords}" />
<meta name="Description" content="{$description}" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="viewport" content="initial-scale=1.0, maximum-scale=1.0, user-scalable=0"/>
<link rel="stylesheet" type="text/css" href="themesmobile/68ecshopcom_mobile/css/public.css"/>
<link rel="stylesheet" type="text/css" href="themesmobile/68ecshopcom_mobile/css/user.css"/> 
<script type="text/javascript" src="themesmobile/68ecshopcom_mobile/js/jquery.js"></script>
<script type="text/javascript" src="themesmobile/68ecshopcom_mobile/js/jquery.more.js"></script>
    <script type="text/javascript" src="themesmobile/68ecshopcom_mobile/js/mobile.js" ></script>
</head>
<body class="body_bj">
      <header>
      <div class="tab_nav">
        <div class="header">
          <div class="h-left"><a class="sb-back" href="javascript:history.back(-1)" title="返回"></a></div>
          <div class="h-mid">微信推广</div>
          <div class="h-right">
            <aside class="top_bar">
              <div onClick="show_menu();$('#close_btn').addClass('hid');" id="show_more"><a href="javascript:;"></a> </div>
            </aside>
          </div>
        </div>
      </div>
      </header>
      <div class="goods_nav hid" id="menu">
          <div class="Triangle">
              <h2></h2>
          </div>
          <ul>
              <li><a href="index.php"><span class="menu1"></span><i>首页</i></a></li>
              <li><a href="catalog.php"><span class="menu2"></span><i>分类</i></a></li>
              <li><a href="flow.php"><span class="menu3"></span><i>购物车</i></a></li>
              <li style=" border:0;"><a href="user.php"><span class="menu4"></span><i>我的</i></a></li>
          </ul>
      </div>
<div id="tbh5v0">
		<!--全局导航-Start-->
        <div style="height:50px; line-height:50px; clear:both;"></div>
        <div class="v_nav">
        <div class="vf_nav">
        <ul>
        <li> <a href="./">
            <i class="vf_1"></i>
            <span>首页</span></a></li>
        <li><a href="tel:{insert name='ecsmart_tel'}">
            <i class="vf_2"></i>
            <span>客服</span></a></li>
        <li><a href="catalog.php">
            <i class="vf_3"></i>
            <span>分类</span></a></li>
        <li>
        <a href="flow.php">
           <em class="global-nav__nav-shop-cart-num" id="ECS_CARTINFO" style="right:9px;"></em>
           <i class="vf_4"></i>
           <span>购物车</span>

           </a></li>
        <li><a href="user.php">
            <i class="vf_5"></i>
            <span>我的</span></a></li>
        </ul>
        </div>
        </div>

<!--顶部切换--->
<ul class="order_listtop">
</ul>
<div class="order_tishi">点击发送按钮，推广消息。</div>


    <div id="J_ItemList" class="order">
      <ul class="single_item info" id="more_element_2">  <div class="order_list">
               <a href="user.php?act=order_detail&amp;order_id=199">
                    <div class="order_list_goods">
              <dl>
                <dt><img src="./../<?=$goodsInfo['goods_thumb']?>"></dt>
                <dd class="name"><strong><?=$goodsInfo['goods_name']?>(...</strong><span>

                      <?=$goodsInfo['goods_brief']?>

                </span></dd>
                <dd class="pice">￥<?=$goodsInfo['shop_price']?><em></em></dd>
                </dl>
                </div>
                        </a>
                <div class="anniu" style="width:95%;">
                    <a id="send_wchat">发送</a>     </div>
          </div>
      </ul>

    </div>





</div>

<script language="javascript">
    $("#send_wchat").click(function ()
    {
        $.ajax({
            url: "<?=$sendUlr?>",
            type: "post",
            dataType: "json",
            data: JSON.stringify({"goods_name": "<?=$goodsInfo['goods_name']?>", "goods_biref": "<?=$goodsInfo['goods_brief']?>","goods_thumb": "./../<?=$goodsInfo['goods_thumb']?>",
                "shop_price": <?=$goodsInfo['shop_price']?>,"goods_url":'<?=$phpServer?>/mobile/goods.php?u=<?=$user_id?>&id=<?=$goods_id?>',"uid":'<?=$user_id?>'
            }),
            success: function (data) {
                if (data.code == 200) {
                    window.location.href = "/mobile/wechat_send.php?status=1";
                } else {
                    window.location.href = "/";
                }
            }
        });

    });
</script>
</body>
</html>