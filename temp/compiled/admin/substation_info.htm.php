<!-- $Id: agency_info.htm 14216 2008-03-10 02:27:21Z testyang $ -->
<?php echo $this->fetch('pageheader.htm'); ?>
<?php echo $this->smarty_insert_scripts(array('files'=>'validator.js,../js/transport.org.js,../js/region.js')); ?>
<div class="main-div" style="padding:10px;background:#fff;">
<style type="text/css">
.store-joinin th{padding:10px;text-align:left;text-indent:10px;font-weight:bold;background:#F7F7F7;color:#1F84B0;margin-bottom:15px;}
.store-joinin td{padding:5px 1em}
</style>
  <!--如果公司类型不为空，显示公司申请的信息，如果为空显示个人申请的信息-->
  <?php if ($this->_var['supplier']['company_type']): ?>
<table border="0" cellpadding="0" cellspacing="0" class="store-joinin">
    <thead>
      <tr>
        <th colspan="2">公司及联系人信息</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td class="label">公司名称：</td>
        <td><input type="text" name="company_name" value="<?php echo htmlspecialchars($this->_var['supplier']['company_name']); ?>" style="float:left;" size="30" /></td>
      </tr>
      <tr>
        <td class="label">公司所在地：</td>
        <td>
		<select name="country" id="selCountries_0" onchange="region.changed(this, 1, 'selProvinces_0')" disabled>
		  <option value="0"><?php echo $this->_var['lang']['please_select']; ?><?php echo $this->_var['name_of_region']['0']; ?></option>
		  <!-- <?php $_from = $this->_var['country_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'country');if (count($_from)):
    foreach ($_from AS $this->_var['country']):
?> -->
		  <option value="<?php echo $this->_var['country']['region_id']; ?>" <?php if ($this->_var['supplier_country'] == $this->_var['country']['region_id']): ?>selected<?php endif; ?>><?php echo $this->_var['country']['region_name']; ?></option>
		  <!-- <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?> -->
		</select>
		<select name="province" id="selProvinces_0" onchange="region.changed(this, 2, 'selCities_0')" disabled>
		  <option value="0"><?php echo $this->_var['lang']['please_select']; ?><?php echo $this->_var['name_of_region']['1']; ?></option>
		  <!-- <?php $_from = $this->_var['province_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'province');if (count($_from)):
    foreach ($_from AS $this->_var['province']):
?> -->
		  <option value="<?php echo $this->_var['province']['region_id']; ?>" <?php if ($this->_var['supplier']['province'] == $this->_var['province']['region_id']): ?>selected<?php endif; ?>><?php echo $this->_var['province']['region_name']; ?></option>
		  <!-- <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?> -->
		</select>
		<select name="city" id="selCities_0" onchange="region.changed(this, 3, 'selDistricts_0')" disabled>
		  <option value="0"><?php echo $this->_var['lang']['please_select']; ?><?php echo $this->_var['name_of_region']['2']; ?></option>
		  <!-- <?php $_from = $this->_var['city_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'city');if (count($_from)):
    foreach ($_from AS $this->_var['city']):
?> -->
		  <option value="<?php echo $this->_var['city']['region_id']; ?>" <?php if ($this->_var['supplier']['city'] == $this->_var['city']['region_id']): ?>selected<?php endif; ?>><?php echo $this->_var['city']['region_name']; ?></option>
		  <!-- <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?> -->
		</select>
		<select name="district" id="selDistricts_0" <?php if (! $this->_var['district_list']): ?>style="display:none"<?php endif; ?> disabled>
		  <option value="0"><?php echo $this->_var['lang']['please_select']; ?><?php echo $this->_var['name_of_region']['3']; ?></option>
		  <!-- <?php $_from = $this->_var['district_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'district');if (count($_from)):
    foreach ($_from AS $this->_var['district']):
?> -->
		  <option value="<?php echo $this->_var['district']['region_id']; ?>" <?php if ($this->_var['supplier']['district'] == $this->_var['district']['region_id']): ?>selected<?php endif; ?>><?php echo $this->_var['district']['region_name']; ?></option>
		  <!-- <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?> -->
		</select>
		</td>
      </tr>
      <tr>
      	<td class="label">公司详细地址：</td>
        <td><input type="text" name="address" value="<?php echo htmlspecialchars($this->_var['supplier']['address']); ?>" style="float:left;" size="30" /></td>
      </tr>
      <tr>
        <td class="label">公司电话：</td>
        <td><input type="text" name="tel" value="<?php echo htmlspecialchars($this->_var['supplier']['tel']); ?>" style="float:left;" size="30" /></td>
      </tr>
      <tr>
        <td class="label">公司规模：</td>
        <td><input type="text" name="guimo" value="<?php echo htmlspecialchars($this->_var['supplier']['guimo']); ?>" style="float:left;" size="30" /></td>
      </tr>
      <tr>
        <td class="label">公司类型：</td>
        <td><input type="text" name="company_type" value="<?php echo htmlspecialchars($this->_var['supplier']['company_type']); ?>" style="float:left;" size="30" /></td>
      </tr>
      <tr>
        <td class="label">联系人姓名：</td>
        <td><input type="text" name="contacts_name" value="<?php echo htmlspecialchars($this->_var['supplier']['contacts_name']); ?>" style="float:left;" size="30" /></td>
      </tr>
      <tr>
        <td class="label">联系人电话：</td>
        <td><input type="text" name="contacts_phone" value="<?php echo htmlspecialchars($this->_var['supplier']['contacts_phone']); ?>" style="float:left;" size="30" /></td>
      </tr>
      <tr>
        <td class="label">电子邮箱：</td>
        <td><input type="text" name="email" value="<?php echo htmlspecialchars($this->_var['supplier']['email']); ?>" style="float:left;" size="30" /></td>
      </tr>
    </tbody>
  </table>


  <table border="0" cellpadding="0" cellspacing="0" class="store-joinin">
    <thead>
      <tr>
        <th colspan="2">营业执照信息（副本）</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td class="label">营业执照号：</td>
        <td><input type="text" name="business_licence_number" value="<?php echo htmlspecialchars($this->_var['supplier']['business_licence_number']); ?>" style="float:left;" size="30" /></td></tr><tr>
      </tr>
      <tr>
        <td class="label">法定经营范围：</td>
        <td><input type="text" name="business_sphere" value="<?php echo htmlspecialchars($this->_var['supplier']['business_sphere']); ?>" style="float:left;" size="30" /></td>
      </tr>
      <tr>
        <td class="label">营业执照号<br>电子版：</td>
        <td><?php if ($this->_var['supplier']['zhizhao']): ?><img src="../data/supplier/<?php echo $this->_var['supplier']['zhizhao']; ?>" width=50 height=50>&nbsp;&nbsp;<input type="button" onclick="window.open('../data/supplier/<?php echo $this->_var['supplier']['zhizhao']; ?>');" value="查看原图"><?php endif; ?></td>
      </tr>
    </tbody>
  </table>

  <table border="0" cellpadding="0" cellspacing="0" class="store-joinin">
    <thead>
      <tr>
        <th colspan="2">组织机构代码证</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td class="label">组织机构代码：</td>
        <td><input type="text" name="organization_code" value="<?php echo htmlspecialchars($this->_var['supplier']['organization_code']); ?>" style="float:left;" size="30" /></td>
      </tr>
      <tr>
        <td class="label">组织机构代码证<br>电子版：</td>
        <td><?php if ($this->_var['supplier']['organization_code_electronic']): ?><img src="../data/supplier/<?php echo $this->_var['supplier']['organization_code_electronic']; ?>" width=50 height=50>&nbsp;&nbsp;<input type="button" onclick="window.open('../data/supplier/<?php echo $this->_var['supplier']['organization_code_electronic']; ?>');" value="查看原图"><?php endif; ?></td>
      </tr>
    </tbody>
  </table>

  <table border="0" cellpadding="0" cellspacing="0" class="store-joinin">
    <thead>
      <tr>
        <th colspan="2">一般纳税人证明</td>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td class="label">一般纳税人证明：</td>
        <td><?php if ($this->_var['supplier']['general_taxpayer']): ?><img src="../data/supplier/<?php echo $this->_var['supplier']['general_taxpayer']; ?>" width=50 height=50>&nbsp;&nbsp;<input type="button" onclick="window.open('../data/supplier/<?php echo $this->_var['supplier']['general_taxpayer']; ?>');" value="查看原图"><?php endif; ?></td>
      </tr>
    </tbody>
  </table>

  <table border="0" cellpadding="0" cellspacing="0" class="store-joinin">
    <thead>
      <tr>
        <th colspan="2">税务登记证</td>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td class="label">税务登记证号：</td>
        <td><input type="text" name="tax_registration_certificate" value="<?php echo htmlspecialchars($this->_var['supplier']['tax_registration_certificate']); ?>" style="float:left;" size="30" /></td>
      </tr>
      <tr>
        <td class="label">纳税人识别号：</td>
        <td><input type="text" name="taxpayer_id" value="<?php echo htmlspecialchars($this->_var['supplier']['taxpayer_id']); ?>" style="float:left;" size="30" /></td>
      </tr>
      <tr>
        <td class="label">税务登记证号<br>电子版：</td>
        <td><?php if ($this->_var['supplier']['tax_registration_certificate_electronic']): ?><img src="../data/supplier/<?php echo $this->_var['supplier']['tax_registration_certificate_electronic']; ?>" width=50 height=50>&nbsp;&nbsp;<input type="button" onclick="window.open('../data/supplier/<?php echo $this->_var['supplier']['tax_registration_certificate_electronic']; ?>');" value="查看原图"><?php endif; ?></td>
      </tr>
    </tbody>
  </table>

  <form method="post" action="substations.php" name="theForm" enctype="multipart/form-data" onsubmit="return validate()">


  <table border="0" cellpadding="0" cellspacing="0" class="store-joinin">
    <thead>
      <tr>
        <th colspan="2">结算账号信息</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td class="label">银行开户名：</td>
        <td><input type="text" name="settlement_bank_account_name" value="<?php echo htmlspecialchars($this->_var['supplier']['settlement_bank_account_name']); ?>" style="float:left;" size="30" /></td>
      </tr>
      <tr>
        <td class="label">公司银行账号：</td>
        <td><input type="text" name="settlement_bank_account_number" value="<?php echo htmlspecialchars($this->_var['supplier']['settlement_bank_account_number']); ?>" style="float:left;" size="30" /></td>
      </tr>
      <tr>
        <td class="label">开户银行支行名称：</td>
        <td><input type="text" name="settlement_bank_name" value="<?php echo htmlspecialchars($this->_var['supplier']['settlement_bank_name']); ?>" style="float:left;" size="30" /></td>
      </tr>
      <tr>
        <td class="label">支行联行号：</td>
        <td><input type="text" name="settlement_bank_code" value="<?php echo htmlspecialchars($this->_var['supplier']['settlement_bank_code']); ?>" style="float:left;" size="30" /></td>
      </tr>
    </tbody>

  </table>

  <table border="0" cellpadding="0" cellspacing="0" class="store-joinin">
      <thead>
        <tr>
          <th colspan="2">店铺经营信息</td>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td class="label">供货商名称：</td>
          <td><input type="text" name="supplier_name" value="<?php echo htmlspecialchars($this->_var['supplier']['supplier_name']); ?>" style="float:left;" size="30" /></td>
        </tr>
        <tr>
          <td class="label">店铺等级：</td>
          <td>
              <!--
              <input type="text" name="rank_name" value="<?php echo htmlspecialchars($this->_var['supplier']['rank_name']); ?>" style="float:left;" size="30" />
              -->
              <select name="rank_id">
                  <?php echo $this->html_options(array('options'=>$this->_var['supplier_rank_list'],'selected'=>$this->_var['rank_id'])); ?>
              </select>
		  </td>
        </tr>
        <tr>
          <td class="label">店铺分类：</td>
          <td><input type="text" name="type_name" value="<?php echo htmlspecialchars($this->_var['supplier']['type_name']); ?>" style="float:left;" size="30" /></td>
        </tr>
        
        <!--
        <tr>
			<td class="label">结算类型：</td>
			<td>
				<select name="supplier_rebate_paytime" size=1>
				<option value="0">请选择</option>
				<option value="1" <?php if ($this->_var['supplier']['supplier_rebate_paytime'] == '1'): ?>selected<?php endif; ?>>周</option>
				<option value="2" <?php if ($this->_var['supplier']['supplier_rebate_paytime'] == '2'): ?>selected<?php endif; ?>>月</option>
				<option value="3" <?php if ($this->_var['supplier']['supplier_rebate_paytime'] == '3'): ?>selected<?php endif; ?>>季度</option>
				<option value="4" <?php if ($this->_var['supplier']['supplier_rebate_paytime'] == '4'): ?>selected<?php endif; ?>>年</option>
				</select>
			</td>
		</tr>
		-->
        
		<tr>
			<td class="label">平台使用费：</td>
			<td><input type="text" name="system_fee" value="<?php if ($this->_var['supplier']['system_fee'] > 0.00): ?><?php echo $this->_var['supplier']['system_fee']; ?><?php endif; ?>"></td>
		</tr>
		<tr>
		<td class="label">商家保证金：</td>
		<td><input type="text" name="supplier_bond" value="<?php if ($this->_var['supplier']['supplier_bond']): ?><?php echo $this->_var['supplier']['supplier_bond']; ?><?php endif; ?>"></td>
		</tr>
		<tr>
		<td class="label">分成百分比：</td>
		<td><input type="text" name="supplier_rebate" value="<?php if ($this->_var['supplier']['supplier_rebate']): ?><?php echo $this->_var['supplier']['supplier_rebate']; ?><?php endif; ?>">%</td>
		</tr>
		<tr>
		<td class="label">审核意见：</td><td><textarea name="supplier_remark" rows=4 cols=50><?php echo $this->_var['supplier']['supplier_remark']; ?></textarea></td>
		</tr>
		<tr>
		<td class="label">审核状态：</td><td>
		<select name="status" size=1><option value="0" <?php if ($this->_var['supplier']['status'] == '0'): ?>selected<?php endif; ?>>未审核</option><option value="1" <?php if ($this->_var['supplier']['status'] == '1'): ?>selected<?php endif; ?>>审核通过</option><option value="-1" <?php if ($this->_var['supplier']['status'] == '-1'): ?>selected<?php endif; ?>>审核不通过</option></select><span style="color:red"><br>1,店铺由<b>"审核通过"</b>变为<b>"审核不通过"</b>等同于关闭店铺，店铺相关商品下架，店铺街不再显示此店铺；<br>2,由<b>"审核不通过"</b>再次变为<b>"审核通过"</b>,相关商品需要手动上架，店铺街展示需要再次申请；<br>3,确定后，入驻商后台登陆密码将与前台登陆密码同步；</span></td>
		</tr>
      </tbody>
    </table>

	<table border="0" cellpadding="0" cellspacing="0" class="store-joinin">
	  <tr>
		<td align="center">
		  <input type="submit" class="button" value="<?php echo $this->_var['lang']['button_submit']; ?>" />
		  <input type="reset" class="button" value="<?php echo $this->_var['lang']['button_reset']; ?>" />
		  <input type="hidden" name="act" value="<?php echo $this->_var['form_action']; ?>" />
		  <input type="hidden" name="status_url" value="<?php echo $this->_var['supplier']['status']; ?>">
		  <input type="hidden" name="id" value="<?php echo $this->_var['supplier']['supplier_id']; ?>" />
          <input type="hidden" id="company" value="1">
		</td>
	  </tr>
	</table>

  </form>
  <?php else: ?>
    <form method="post" action="substations.php" name="theForm" enctype="multipart/form-data" onsubmit="return validate()">

    <table border="0" cellpadding="0" cellspacing="0" class="store-joinin">
    <thead>
      <tr>
        <th colspan="2">分站申请个人信息</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td class="label">申请区域：</td>
        <td>
		<select name="country" id="selCountries_0" onchange="region.changed(this, 1, 'selProvinces_0')" disabled>
		  <option value="0"><?php echo $this->_var['lang']['please_select']; ?><?php echo $this->_var['name_of_region']['0']; ?></option>
		  <!-- <?php $_from = $this->_var['country_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'country');if (count($_from)):
    foreach ($_from AS $this->_var['country']):
?> -->
		  <option value="<?php echo $this->_var['country']['region_id']; ?>" <?php if ($this->_var['supplier_country'] == $this->_var['country']['region_id']): ?>selected<?php endif; ?>><?php echo $this->_var['country']['region_name']; ?></option>
		  <!-- <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?> -->
		</select>
		<select name="province" id="selProvinces_0" onchange="region.changed(this, 2, 'selCities_0')" disabled>
		  <option value="0"><?php echo $this->_var['lang']['please_select']; ?><?php echo $this->_var['name_of_region']['1']; ?></option>
		  <!-- <?php $_from = $this->_var['province_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'province');if (count($_from)):
    foreach ($_from AS $this->_var['province']):
?> -->
		  <option value="<?php echo $this->_var['province']['region_id']; ?>" <?php if ($this->_var['supplier']['province'] == $this->_var['province']['region_id']): ?>selected<?php endif; ?>><?php echo $this->_var['province']['region_name']; ?></option>
		  <!-- <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?> -->
		</select>
		<select name="city" id="selCities_0" onchange="region.changed(this, 3, 'selDistricts_0')" disabled>
		  <option value="0"><?php echo $this->_var['lang']['please_select']; ?><?php echo $this->_var['name_of_region']['2']; ?></option>
		  <!-- <?php $_from = $this->_var['city_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'city');if (count($_from)):
    foreach ($_from AS $this->_var['city']):
?> -->
		  <option value="<?php echo $this->_var['city']['region_id']; ?>" <?php if ($this->_var['supplier']['city'] == $this->_var['city']['region_id']): ?>selected<?php endif; ?>><?php echo $this->_var['city']['region_name']; ?></option>
		  <!-- <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?> -->
		</select>
		<select name="district" id="selDistricts_0" <?php if (! $this->_var['district_list']): ?>style="display:none"<?php endif; ?> disabled>
		  <option value="0"><?php echo $this->_var['lang']['please_select']; ?><?php echo $this->_var['name_of_region']['3']; ?></option>
		  <!-- <?php $_from = $this->_var['district_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'district');if (count($_from)):
    foreach ($_from AS $this->_var['district']):
?> -->
		  <option value="<?php echo $this->_var['district']['region_id']; ?>" <?php if ($this->_var['supplier']['district'] == $this->_var['district']['region_id']): ?>selected<?php endif; ?>><?php echo $this->_var['district']['region_name']; ?></option>
		  <!-- <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?> -->
		</select>
		</td>
      </tr>
      <tr>
      	<td class="label">详细地址：</td>
        <td><input type="text" name="address" value="<?php echo htmlspecialchars($this->_var['supplier']['address']); ?>" style="float:left;" size="30" /></td>
      </tr>
      <tr>
        <td class="label">姓名：</td>
        <td><input type="text" name="contacts_name" value="<?php echo htmlspecialchars($this->_var['supplier']['full_name']); ?>" style="float:left;" size="30" /></td>
      </tr>
      <tr>
        <td class="label">联系人电话：</td>
        <td><input type="text" name="contacts_phone" value="<?php echo htmlspecialchars($this->_var['supplier']['telephone']); ?>" style="float:left;" size="30" /></td>
      </tr>
      <tr>
        <td class="label">电子邮箱：</td>
        <td><input type="text" name="email" value="<?php echo htmlspecialchars($this->_var['supplier']['email']); ?>" style="float:left;" size="30" /></td>
      </tr>
    </tbody>
  </table>

    <table border="0" cellpadding="0" cellspacing="0" class="store-joinin">

      <tbody>
        <tr>
            <td class="label">申请等级：</td>
            <td>
                <!--
                <input type="text" name="rank_name" value="<?php echo htmlspecialchars($this->_var['supplier']['rank_name']); ?>" style="float:left;" size="30" />
                -->
                <select name="rank_id">
                    <?php echo $this->html_options(array('options'=>$this->_var['supplier_rank_list'],'selected'=>$this->_var['rank_id'])); ?>
                </select>
            </td>
        </tr>

        
        <!--
		<tr>
			<td class="label">结算类型：</td>
			<td>
				<select name="supplier_rebate_paytime" size=1>
				<option value="0">请选择</option>
				<option value="1" <?php if ($this->_var['supplier']['supplier_rebate_paytime'] == '1'): ?>selected<?php endif; ?>>周</option>
				<option value="2" <?php if ($this->_var['supplier']['supplier_rebate_paytime'] == '2'): ?>selected<?php endif; ?>>月</option>
				<option value="3" <?php if ($this->_var['supplier']['supplier_rebate_paytime'] == '3'): ?>selected<?php endif; ?>>季度</option>
				<option value="4" <?php if ($this->_var['supplier']['supplier_rebate_paytime'] == '4'): ?>selected<?php endif; ?>>年</option>
				</select>
			</td>
		</tr>
        -->
        

		<tr>
		<td class="label">分成百分比：</td>
		<td><input type="text" name="supplier_rebate" value="<?php echo $this->_var['supplier']['profit']; ?>">%</td>
		</tr>
		<tr>
		<td class="label">审核意见：</td><td><textarea name="supplier_remark" rows=4 cols=50><?php echo $this->_var['supplier']['remark']; ?></textarea></td>
		</tr>
		<tr>
		<td class="label">审核状态：</td><td>
		<select name="status" size=1><option value="11"  <?php if ($this->_var['supplier']['status'] == '11'): ?> selected <?php endif; ?>>未审核</option><option value="12" <?php if ($this->_var['supplier']['status'] == '12'): ?>selected<?php endif; ?>>审核通过</option><option value="13" <?php if ($this->_var['supplier']['status'] == '13'): ?>selected<?php endif; ?>>审核不通过</option></select><span style="color:red"></span></td>
		</tr>
        <tr>
            <td class="label">转移状态：</td><td>
            <select name="is_unique" size=1><option value="1"  <?php if ($this->_var['supplier']['is_unique'] == '1'): ?> selected <?php endif; ?>>禁止转让</option><option value="0" <?php if ($this->_var['supplier']['is_unique'] == '0'): ?>selected<?php endif; ?>>允许转让</option></select></td>
        </tr>
      </tbody>
    </table>

	<table border="0" cellpadding="0" cellspacing="0" class="store-joinin">
	  <tr>
		<td align="center">
		  <input type="submit" class="button" value="<?php echo $this->_var['lang']['button_submit']; ?>" />
		  <input type="hidden" name="act" value="<?php echo $this->_var['form_action']; ?>" />
		  <input type="hidden" name="status_url" value="<?php echo $this->_var['supplier']['status']; ?>">
		  <input type="hidden" name="id" value="<?php echo $this->_var['supplier']['member_id']; ?>" />
          <input type="hidden" id="person" value="1">
		</td>
	  </tr>
	</table>

  </form>

  <?php endif; ?>
</div>
<?php echo $this->smarty_insert_scripts(array('files'=>'../js/utils.js,validator.js')); ?>

<script language="JavaScript">
<!--

onload = function()
{
    // 开始检查订单
    startCheckOrder();
}
/**
 * 检查表单输入的数据
 */
function validate()
{
	var theForm=document.forms['theForm'];
    validator = new Validator("theForm");
    validator.isNumber("system_fee",  "平台使用费需为整数！");
	validator.isNumber("supplier_bond",  "商家保证金需为整数！");
	validator.isNumber("supplier_rebate",  "百分位需为整数！");
	if (theForm.elements['status'].value == '1')
	{
		if(document.getElementById('company')){
			validator.required("settlement_bank_account_name",  "填写了银行开户名才能审核通过！");
			validator.required("settlement_bank_account_number",  "填写了公司银行账号才能审核通过！");
			validator.required("settlement_bank_name",  "填写了开户银行支行名称才能审核通过！");
			validator.required("settlement_bank_code",  "填写了支行联行号才能审核通过！");

			validator.required("system_fee",  "填写了平台使用费才能审核通过！");
			validator.required("supplier_bond",  "填写了商家保证金才能审核通过！");
			validator.required("supplier_rebate",  "填写了分成百分比才能审核通过！");
		}
		if(document.getElementById('person')){
			validator.required("bank_account_name",  "填写了银行开户名才能审核通过！");
			validator.required("bank_account_number",  "填写了个人银行账号才能审核通过！");
			validator.required("bank_name",  "填写了开户银行支行名称才能审核通过！");
			validator.required("bank_code",  "填写了支行联行号才能审核通过！");

			validator.required("system_fee",  "填写了平台使用费才能审核通过！");
			validator.required("supplier_bond",  "填写了商家保证金才能审核通过！");
			validator.required("supplier_rebate",  "填写了分成百分比才能审核通过！");
		}
	}

    return validator.passed();
}
//-->
</script>

<?php echo $this->fetch('pagefooter.htm'); ?>