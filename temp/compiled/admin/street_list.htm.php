<?php if ($this->_var['full_page']): ?>
<?php echo $this->fetch('pageheader.htm'); ?>
<?php echo $this->smarty_insert_scripts(array('files'=>'../js/utils.js,listtable.js')); ?>
<!-- 订单搜索 -->
<div class="form-div">
  <form action="javascript:searchOrder()" name="searchForm">
    <img src="images/icon_search.gif" width="26" height="22" border="0" alt="SEARCH" />    
    类别:<select name="supplier_type">
	<option value="0">请选择</option>
	<?php $_from = $this->_var['str_category']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('value', 'name');if (count($_from)):
    foreach ($_from AS $this->_var['value'] => $this->_var['name']):
?>
	<option value="<?php echo $this->_var['value']; ?>" <?php if ($_REQUEST['supplier_type'] == $this->_var['value']): ?> selected <?php endif; ?>><?php echo $this->_var['name']; ?></option>
	<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
	</select>
    店铺名称:<input name="supplier_name" type="text" id="supplier_name" size="15">
    状态<select name="is_show" id="is_show"><option value="-1">请选择</option><option value="0">下线</option><option value="1">显示中</option></select>
    <input type="submit" value="<?php echo $this->_var['lang']['button_search']; ?>" class="button" />
  </form>
</div>

<!-- 订单列表 -->
<form method="post" action="supplier_street.php?act=remove_show" name="listForm" onsubmit="return check()">
  <div class="list-div" id="listDiv">
<?php endif; ?>

<table cellpadding="3" cellspacing="1">
  <tr>
  <th align=left><input onclick='listTable.selectAll(this, "supplier_id")' type="checkbox"/>店铺id</th>
    <th>店铺类别</th>
	<th>店铺名称</th>
	<th>是否显示</th>
    <th>是否推荐</th>
	<th>店铺标签</th>
    <th>排序</th>
    <th>操作</th>
  <tr>
  <?php $_from = $this->_var['shops_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('dkey', 'shop');if (count($_from)):
    foreach ($_from AS $this->_var['dkey'] => $this->_var['shop']):
?>
  <tr>
  <td><input type="checkbox" name="supplier_id[]" value="<?php echo $this->_var['shop']['supplier_id']; ?>" /><?php echo $this->_var['shop']['supplier_id']; ?></td>
    <td align="center"  nowrap="nowrap"><?php echo $this->_var['shop']['str_name']; ?></td>
	<td align="center"  nowrap="nowrap"><?php echo $this->_var['shop']['supplier_name']; ?></td>
	<td align="center"  nowrap="nowrap"><img src="images/<?php if ($this->_var['shop']['is_show'] == '1'): ?>yes<?php else: ?>no<?php endif; ?>.gif" onclick="listTable.toggle(this, 'toggle_is_show', <?php echo $this->_var['shop']['supplier_id']; ?>)" /></td>
    <td align="center"  nowrap="nowrap"><img src="images/<?php if ($this->_var['shop']['is_groom'] == '1'): ?>yes<?php else: ?>no<?php endif; ?>.gif" onclick="listTable.toggle(this, 'toggle_is_groom', <?php echo $this->_var['shop']['supplier_id']; ?>)" /></td>
	
	<td align="center" nowrap="nowrap">
	<?php $_from = $this->_var['shop']['taginfo']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('tkey', 'tag');if (count($_from)):
    foreach ($_from AS $this->_var['tkey'] => $this->_var['tag']):
?>
	<input type="checkbox" <?php if ($this->_var['tag']['select'] == 1): ?>checked<?php endif; ?> onclick="listTable.toggle_ext(this, 'toggle_tag', <?php echo $this->_var['tkey']; ?>, <?php echo $this->_var['shop']['supplier_id']; ?>)"><?php echo $this->_var['tag']['tag_name']; ?></input>
	<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
	</td>
    <td align="center"  nowrap="nowrap"><span onclick="listTable.edit(this, 'edit_sort_order', <?php echo $this->_var['shop']['supplier_id']; ?>)"><?php echo $this->_var['shop']['sort_order']; ?></span></td>
    <td align="center"   nowrap="nowrap">
     <a href="supplier_street.php?act=edit_info&supplier_id=<?php echo $this->_var['shop']['supplier_id']; ?>">编辑</a>
     <a onclick="{if(confirm('<?php echo $this->_var['lang']['confirm_delete']; ?>')){return true;}return false;}" href="supplier_street.php?act=remove_supplier&supplier_id=<?php echo $this->_var['shop']['supplier_id']; ?>">删除</a>
    </td>
  </tr>
  <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
</table>

<!-- 分页 -->
<table id="page-table" cellspacing="0">
  <tr>
    <td align="right" nowrap="true">
    <?php echo $this->fetch('page.htm'); ?>
    </td>
  </tr>
</table>

<?php if ($this->_var['full_page']): ?>
  </div>
  <div>
  <input type='hidden' name='supplier_id' value=''>
    <input name="remove_back" type="submit" id="btnSubmit3" value="批量下线" class="button" disabled="true" onclick="{if(confirm('确定操作吗？')){return true;}return false;}" />
  </div>
</form>
<script language="JavaScript">
listTable.recordCount = <?php echo $this->_var['record_count']; ?>;
listTable.pageCount = <?php echo $this->_var['page_count']; ?>;

<?php $_from = $this->_var['filter']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('key', 'item');if (count($_from)):
    foreach ($_from AS $this->_var['key'] => $this->_var['item']):
?>
listTable.filter.<?php echo $this->_var['key']; ?> = '<?php echo $this->_var['item']; ?>';
<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>


    onload = function()
    {
        // 开始检查订单
        startCheckOrder();
                
        //
        listTable.query = "street_query";
    }

    /**
     * 搜索订单
     */
    function searchOrder()
    {
        listTable.filter['supplier_type'] = document.forms['searchForm'].elements['supplier_type'].value;
        listTable.filter['supplier_name'] = Utils.trim(document.forms['searchForm'].elements['supplier_name'].value);
		listTable.filter['is_show'] = document.forms['searchForm'].elements['is_show'].value;
		
		
        listTable.filter['page'] = 1;
        listTable.query = "street_query";
        listTable.loadList();
    }

    function check()
    {
      var snArray = new Array();
      var eles = document.forms['listForm'].elements;
      for (var i=0; i<eles.length; i++)
      {
        if (eles[i].tagName == 'INPUT' && eles[i].type == 'checkbox' && eles[i].checked && eles[i].value != 'on')
        {
          snArray.push(eles[i].value);
        }
      }
      if (snArray.length == 0)
      {
        return false;
      }
      else
      {
        eles['supplier_id'].value = snArray.toString();
        return true;
      }
    }

	listTable.toggle_ext = function(obj, act, tid, sid)
	{
	  var val = (obj.checked) ? 1 : 0;

	  var res = Ajax.call(listTable.url, "act="+act+"&val=" + val + "&tid=" +tid+"&sid="+sid, null, "POST", "JSON", false);

	  if (res.message)
	  {
		alert(res.message);
	  }
	  if (res.error == 0)
	  {
		//obj.src = (res.content > 0) ? 'images/yes.gif' : 'images/no.gif';
	  }
	}
</script>


<?php echo $this->fetch('pagefooter.htm'); ?>
<?php endif; ?>