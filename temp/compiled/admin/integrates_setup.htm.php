<!-- $Id: integrates_setup.htm 15132 2008-10-29 08:54:47Z testyang $ -->
<?php echo $this->fetch('pageheader.htm'); ?>
<!-- start integrate setup form -->
<!--<?php if ($this->_var['code'] != 'ucenter' || empty ( $this->_var['cfg']['uc_id'] )): ?>-->
<div style="border: 1px solid #CC0000;background-color:#FFFFCE;color:#CE0000;padding:4px" ><?php echo $this->_var['lang']['db_notice']; ?></div>
<!--<?php endif; ?>-->
<div class="main-div">
  <!--<?php if ($this->_var['code'] == 'ucenter'): ?>-->
  <!--<?php if (! empty ( $this->_var['cfg']['uc_id'] ) && ! empty ( $this->_var['cfg']['uc_key'] )): ?>-->
  <div id="tabbar-div">
    <p>
      <span class="tab-front" id="ucenter-tab"><?php echo $this->_var['lang']['ucenter_tab_base']; ?></span>
      <span class="tab-back" id="feed-tab"><?php echo $this->_var['lang']['ucenter_tab_show']; ?></span>
    </p>
  </div>
  <div id="tabbody-div">
    <form name="theForm" action="integrate.php" method="post">
        <table width="90%" id="ucenter-table">
          <tr>
            <td class="label"><?php echo $this->_var['lang']['ucenter_lab_id']; ?></td>
            <td><input type="text" name="cfg[uc_id]" value="<?php echo $this->_var['cfg']['uc_id']; ?>" /><span class="notice-span" <?php if ($this->_var['help_open']): ?>style="display:block" <?php else: ?> style="display:none" <?php endif; ?> id="noticeGoodsSN"><?php echo $this->_var['lang']['ucenter_notice_id']; ?></span></td>
          </tr>
          <tr>
            <td class="label"><?php echo $this->_var['lang']['ucenter_lab_key']; ?></td>
            <td><input type="text" name="cfg[uc_key]" value="<?php echo $this->_var['cfg']['uc_key']; ?>" /><span class="notice-span" <?php if ($this->_var['help_open']): ?>style="display:block" <?php else: ?> style="display:none" <?php endif; ?> id="noticeGoodsSN"><?php echo $this->_var['lang']['ucenter_notice_key']; ?></span></td>
          </tr>
          <tr>
            <td class="label"><?php echo $this->_var['lang']['ucenter_lab_url']; ?></td>
            <td><input type="text" name="cfg[uc_url]" value="<?php echo $this->_var['cfg']['uc_url']; ?>" /><span class="notice-span" <?php if ($this->_var['help_open']): ?>style="display:block" <?php else: ?> style="display:none" <?php endif; ?> id="noticeGoodsSN"><?php echo $this->_var['lang']['ucenter_notice_url']; ?></span></td>
          </tr>
          <tr>
            <td class="label"><?php echo $this->_var['lang']['ucenter_lab_ip']; ?></td>
            <td><input type="text" name="cfg[uc_ip]" value="<?php echo $this->_var['cfg']['uc_ip']; ?>" /><span class="notice-span" <?php if ($this->_var['help_open']): ?>style="display:block" <?php else: ?> style="display:none" <?php endif; ?> id="noticeGoodsSN"><?php echo $this->_var['lang']['ucenter_notice_ip']; ?></span></td>
          </tr>
          <tr>
            <td class="label"><?php echo $this->_var['lang']['ucenter_lab_connect']; ?></td>
            <td><input type="radio" id="ucenter_connect_1" name="cfg[uc_connect]" value="mysql" <?php if ($this->_var['cfg']['uc_connect'] == "mysql"): ?>checked="checked"<?php endif; ?> /><label for="ucenter_connect_1"><?php echo $this->_var['lang']['ucenter_opt_database']; ?></label><input type="radio" id="ucenter_connect_2" name="cfg[uc_connect]" value="post" <?php if ($this->_var['cfg']['uc_connect'] != "mysql"): ?>checked="checked"<?php endif; ?> /><label for="ucenter_connect_2"><?php echo $this->_var['lang']['ucenter_opt_interface']; ?></label><span class="notice-span" <?php if ($this->_var['help_open']): ?>style="display:block" <?php else: ?> style="display:none" <?php endif; ?> id="noticeGoodsSN"><?php echo $this->_var['lang']['ucenter_notice_connect']; ?></span></td>
          </tr>
          <tbody id="uc_db" style="display:none">
          <tr>
            <td class="label"><?php echo $this->_var['lang']['ucenter_lab_db_host']; ?></td>
            <td><input type="text" name="cfg[db_host]" value="<?php echo $this->_var['cfg']['db_host']; ?>" /><span class="notice-span" <?php if ($this->_var['help_open']): ?>style="display:block" <?php else: ?> style="display:none" <?php endif; ?> id="noticeGoodsSN"><?php echo $this->_var['lang']['ucenter_notice_db_host']; ?></span></td>
          </tr>
          <tr>
            <td class="label"><?php echo $this->_var['lang']['ucenter_lab_db_user']; ?></td>
            <td><input type="text" name="cfg[db_user]" value="<?php echo $this->_var['cfg']['db_user']; ?>" /></td>
          </tr>
          <tr>
            <td class="label"><?php echo $this->_var['lang']['ucenter_lab_db_pass']; ?></td>
            <td><input type="password" name="cfg[db_pass]" value="<?php echo $this->_var['cfg']['db_pass']; ?>" /></td>
          </tr>
          <tr>
            <td class="label"><?php echo $this->_var['lang']['ucenter_lab_db_name']; ?></td>
            <td><input type="text" name="cfg[db_name]" value="<?php echo $this->_var['cfg']['db_name']; ?>" /></td>
          </tr>
          <tr>
            <td class="label"><?php echo $this->_var['lang']['ucenter_lab_db_pre']; ?></td>
            <td><input type="text" name="cfg[db_pre]" value="<?php echo $this->_var['cfg']['db_pre']; ?>" /></td>
          </tr>
          <tr>
            <td class="label"><?php echo $this->_var['lang']['ucenter_lab_credit_0']; ?></td>
            <td><input type="text" name="cfg[uc_lang][credits][0][0]" value="<?php echo $this->_var['cfg']['uc_lang']['credits']['0']['0']; ?>" /></td>
          </tr>
          <tr>
            <td class="label"><?php echo $this->_var['lang']['ucenter_lab_credit_1']; ?></td>
            <td><input type="text" name="cfg[uc_lang][credits][1][0]" value="<?php echo $this->_var['cfg']['uc_lang']['credits']['1']['0']; ?>" /></td>
          </tr>
          </tbody>
        </table>
        <table width="90%" id="feed-table" style="display:none">
          <tr>
            <td class="label"><?php echo $this->_var['lang']['ucenter_lab_tag_number']; ?></td>
            <td><input type="text" name="cfg[tag_number]" value="<?php echo $this->_var['cfg']['tag_number']; ?>" /></td>
          </tr>
        </table>
        <div class="button-div">
            <input type="hidden" name="cfg[uc_lang][exchange]" value="<?php echo $this->_var['cfg']['uc_lang']['exchange']; ?>" />
            <input type="submit" value="<?php echo $this->_var['lang']['button_force_save_config']; ?>" class="button" />
            <input type="reset" value="<?php echo $this->_var['lang']['button_reset']; ?>" class="button" />
            <input type="hidden" name="code" value="<?php echo $this->_var['code']; ?>" />
            <input type="hidden" name="act" value="save_uc_config" />
        </div>
    </form>
  </div>
  <?php echo $this->smarty_insert_scripts(array('files'=>'tab.js')); ?>
  <!--<?php else: ?>-->
  <form action="integrate.php" method="post" name="theForm">
  <table cellspacing="1" cellpadding="3" width="100%">
    <tr>
      <td class="label"><?php echo $this->_var['lang']['uc_lab_url']; ?></td>
      <td><input type="text" name="uc_url" value="" /></td>
    </tr>
    <tr id="ucip" style="display:none">
        <td class="label"><?php echo $this->_var['lang']['uc_lab_ip']; ?></td>
        <td align="left"><input name="uc_ip" type="text" id="uc_ip"  value="" /><span class="notice-span" <?php if ($this->_var['help_open']): ?>style="display:block" <?php else: ?> style="display:none" <?php endif; ?> id="noticeGoodsSN"><?php echo $this->_var['lang']['uc_notice_ip']; ?></span></td>
    </tr>
    <tr>
      <td class="label"><?php echo $this->_var['lang']['uc_lab_pass']; ?></td>
      <td><input type="password" name="uc_pass" value="" /><span id="ucfounderpwnotice" style="color:#FF0000"></span></td>
    </tr>
    <tr>
      <td colspan="2" align="center">
        <input type="button" value="<?php echo $this->_var['lang']['button_next']; ?>" onclick="save_uc_config(0)" class="button" />
        <input type="button" value="<?php echo $this->_var['lang']['button_force_save_config']; ?>" onclick="save_uc_config(1)" class="button" />
        <input type="reset" value="<?php echo $this->_var['lang']['button_reset']; ?>" class="button" />
        <input type="hidden" name="code" value="<?php echo $this->_var['code']; ?>" />
        <input type="hidden" name="save" value="0" />
        <input type="hidden" name="ucconfig" value="" />
        <input type="hidden" name="act" value="save_uc_config_first" />
      </td>
    </tr>
  </table>
  </form>
  <!--<?php endif; ?>-->
  <!--<?php else: ?>-->
  <form action="integrate.php" method="post" name="theForm" onsubmit="return validate();">
  <table cellspacing="1" cellpadding="3" width="100%">
    <tr>
      <td class="label"><?php echo $this->_var['lang']['lable_db_host']; ?></td>
      <td><input type="text" name="cfg[db_host]" value="<?php echo $this->_var['cfg']['db_host']; ?>" /><?php echo $this->_var['lang']['require_field']; ?></td>
    </tr>
    <tr>
      <td class="label"><?php echo $this->_var['lang']['lable_db_user']; ?></td>
      <td><input type="text" name="cfg[db_user]" value="<?php echo $this->_var['cfg']['db_user']; ?>" /><?php echo $this->_var['lang']['require_field']; ?></td>
    </tr>
    <tr>
      <td class="label"><?php echo $this->_var['lang']['lable_db_pass']; ?></td>
      <td><input type="password" name="cfg[db_pass]" value="<?php echo $this->_var['cfg']['db_pass']; ?>" /><?php echo $this->_var['lang']['require_field']; ?></td>
    </tr>
    <tr>
      <td class="label"><?php echo $this->_var['lang']['lable_db_name']; ?></td>
      <td><input type="text" name="cfg[db_name]" value="<?php echo $this->_var['cfg']['db_name']; ?>" /><?php echo $this->_var['lang']['require_field']; ?></td>
    </tr>
    <tr>
      <td class="label"><a href="javascript:showNotice('noticeGoodsSN');" title="<?php echo $this->_var['lang']['form_notice']; ?>"><img src="images/notice.gif" width="16" height="16" border="0" alt="<?php echo $this->_var['lang']['form_notice']; ?>"></a><?php echo $this->_var['lang']['lable_db_chartset']; ?></td>
      <td><select name="cfg[db_charset]"><?php echo $this->html_options(array('options'=>$this->_var['set_list'],'selected'=>$this->_var['cfg']['db_charset'])); ?></select><input type="checkbox" name="cfg[is_latin1]" value="1" <?php if ($this->_var['cfg']['is_latin1']): ?>checked="checked"<?php endif; ?> /><?php echo $this->_var['lang']['lable_is_latin1']; ?><?php echo $this->_var['lang']['require_field']; ?>
      <span class="notice-span" <?php if ($this->_var['help_open']): ?>style="display:block" <?php else: ?> style="display:none" <?php endif; ?> id="noticeGoodsSN"><?php echo $this->_var['lang']['notice_latin1']; ?></span>
      </td>
    </tr>
    <tr>
      <td class="label"><?php echo $this->_var['lang']['lable_prefix']; ?></td>
      <td><input type="text" name="cfg[prefix]" value="<?php echo $this->_var['cfg']['prefix']; ?>" /></td>
    </tr>
    <tr>
      <td class="label"><?php echo $this->_var['lang']['lable_url']; ?></td>
      <td><input type="text" name="cfg[integrate_url]" value="<?php echo $this->_var['cfg']['integrate_url']; ?>"  size="40" /><?php echo $this->_var['lang']['require_field']; ?></td>
    </tr>
    <?php if (isset ( $this->_var['cfg']['cookie_prefix'] )): ?>
    <tr>
      <td class="label"><?php echo $this->_var['lang']['cookie_prefix']; ?></td>
      <td><input type="text" name="cfg[cookie_prefix]" value="<?php echo $this->_var['cfg']['cookie_prefix']; ?>" /><?php echo $this->_var['lang']['require_field']; ?></td>
    </tr>
    <?php endif; ?>
    <?php if (isset ( $this->_var['cfg']['cookie_salt'] )): ?>
    <tr>
      <td class="label"><?php echo $this->_var['lang']['cookie_salt']; ?></td>
      <td><input type="text" name="cfg[cookie_salt]" value="<?php echo $this->_var['cfg']['cookie_salt']; ?>" /><?php echo $this->_var['lang']['require_field']; ?></td>
    </tr>
    <?php endif; ?>
    <tr>
      <td colspan="2" align="center">
        <?php if ($this->_var['save'] == 0): ?>
        <input type="submit" value="<?php echo $this->_var['lang']['button_next']; ?>" class="button" />
        <input type="button" value="<?php echo $this->_var['lang']['button_force_save_config']; ?>" onclick="saveConfig('<?php echo $this->_var['lang']['save_confirm']; ?>')" class="button" />
        <?php else: ?>
        <input type="submit" value="<?php echo $this->_var['lang']['button_save_config']; ?>" class="button" />
        <?php endif; ?>
        <input type="reset" value="<?php echo $this->_var['lang']['button_reset']; ?>" class="button"  />
        <input type="hidden" name="code" value="<?php echo $this->_var['code']; ?>" />
        <input type="hidden" name="act" value="check_config" />
        <input type="hidden" name="save" id="ECS_SAVE" value="<?php echo empty($this->_var['save']) ? '0' : $this->_var['save']; ?>">
      </td>
    </tr>
  </table>
  </form>
  <!--<?php endif; ?>-->
</div>
<!-- end integrate setup form -->
<?php echo $this->smarty_insert_scripts(array('files'=>'../js/utils.js,validator.js')); ?>

<script language="JavaScript">
<!--
onload = function()
{
    // 开始检查订单
    startCheckOrder();
}

function saveConfig(str)
{
  if (!validate())
  {
    return;
  }
  var save = document.getElementById('ECS_SAVE');
  if (confirm(str))
  {
    save.value = 1;
    document.forms['theForm'].submit();
  }
  else
  {
    save.value = 0;
  }
}

var uc_1 = Utils.$('ucenter_connect_1');
var uc_2 = Utils.$('ucenter_connect_2');

if (uc_1)
{
    uc_1.onclick = function ()
    {
        if (this.checked === true)
        {
            Utils.$('uc_db').style.display = '';
        }
    }
}
if (uc_2)
{
    uc_2.onclick = function ()
    {
        if (this.checked === true)
        {
            Utils.$('uc_db').style.display = 'none';
        }
    }
}

function ucenter_connect()
{
    if (uc_1)
    {
        if (uc_1.checked === true)
        {
            Utils.$('uc_db').style.display = '';
        }
        else
        {
            Utils.$('uc_db').style.display = 'none';
        }
    }
}

function save_uc ()
{
}

function save_uc_config (save)
{
    var frm = document.forms['theForm'];
    frm.save.value = save;
    var params="ucapi=" + frm.uc_url.value + "&" + "ucip=" + frm.uc_ip.value + "&" + "ucfounderpw=" + frm.uc_pass.value + "&" + "code=" + frm.code.value;
    Ajax.call("./integrate.php?act=setup_ucenter", params, showSaveResponse, 'POST', 'JSON');
}

function showSaveResponse (res)
{
    if (res.error !== 0)
    {
        if (res.error == 2)
        {
            Utils.$("ucip").style.display = '';
        }
        Utils.$("ucfounderpwnotice").innerHTML= res.message;
    }
    else
    {
        var frm = document.forms['theForm'];
        frm.ucconfig.value = res.message;
        frm.submit();
    }
}

if (Browser.isIE)
{
    window.attachEvent("onload", ucenter_connect);
}
else
{
    window.addEventListener("load", ucenter_connect, false);
}

/**
 * 验证表单输入的内容
 */
function validate()
{
    var validator = new Validator('theForm');
    validator.required("cfg[db_host]", no_host);
    validator.required("cfg[db_user]", no_user);
    validator.required("cfg[db_name]", no_name);
    validator.required("cfg[integrate_url]", no_integrate_url);

    return validator.passed();
}
//-->
</script>

<?php echo $this->fetch('pagefooter.htm'); ?>