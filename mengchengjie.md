#账号密码
* 微信公众平台：
    * 18561893237@163.com
    * 710708asd
* 阿里云
    * 18561893237@163.com
    * 710708ljg




* 修改
    * 底部客服更换成“我要推广”--->article. OK
    * 编辑器图片不正常。ok
    * 首页显示文章分类 OK
    * 浏览一次赚一次钱。
    * 发布金额合计 OK 
    * 充值问题 OK 
    




    * 发布功能，加下拉选项。
    * 分享之后才能到账。
    * 师父提层不对。
    * 分享后才能继续提层赚钱。
    





# 开发说明
* 用户中心： /mobile/user.php; action_default(); /Volumes/18554898815/WORK/mackBook/tinaWWW/php/xjdDemo/mobile/themesmobile/68ecshopcom_mobile/user_clips.dwt;
* 设置：/mobile/user.php?act=profile; action_profile(); user_transaction.dwt; 
* 绑定手机： /security.php?act=mobile_binding； mobile_binding（）； user_security.dwt

* 同步首页 UCenter : 




# 后台管理
* 用户编辑：goods.php?act=edit&goods_id=312&extension_code=   admin/goods.php---->goods_info.htm
* 用户列表： admin/users.php?act=list  user_list()  affiliate_list.htm
* 批量删除会员： admin/users.php?act=batch_remove action_batch_remove() no template.
* 编辑用户信息： admin/users.php?act=edit&id=311 action_edit()  user_info.htm
* 更新操作： admin/users.php?act=update&id=311 action_update() no template.
* 调节用户资金： admin/account_log.php?act=add&user_id=312 $_REQUEST['act']=='add' account_info.htm
* 调节操作： admin/account_log.php?act=insert&user_id=312 $_REQUEST['act']=='insert' no template.





* Ucenter
    * admin/app.php
    * model/app.php
    * model/misc.php
    * model/note.php



# 数据库更改
* ecs_users
    * 字段email 改为 allow Null
    




     /* 火一五信息科技 huo15.com 充值跳转 日期：2017/5/16 */
      var urlParamMoney=getUrlParam('money');
      if (urlParamMoney) {
        window.location.href="./user.php?act=account_deposit&money="+urlParamMoney;
      }


      //获取url中的参数
      function getUrlParam(name) {
        var reg = new RegExp("(^|&)" + name + "=([^&]*)(&|$)"); //构造一个含有目标参数的正则表达式对象
        var r = window.location.search.substr(1).match(reg);  //匹配目标参数
        if (r != null) return unescape(r[2]); return null; //返回参数值
      }
    /* 火一五信息科技 huo15.com 充值跳转 日期：2017/5/16 end */