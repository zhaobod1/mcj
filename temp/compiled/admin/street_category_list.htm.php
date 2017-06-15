<!-- $Id: category_list.htm 17019 2010-01-29 10:10:34Z liuhui $ -->
<?php if ($this->_var['full_page']): ?>
<?php echo $this->fetch('pageheader.htm'); ?>
<?php echo $this->smarty_insert_scripts(array('files'=>'../js/utils.js,listtable.js')); ?>

<form method="post" action="" name="listForm">
<!-- start ad position list -->
<div class="list-div" id="listDiv">
<?php endif; ?>

<table width="100%" cellspacing="1" cellpadding="2" id="list-table">
  <tr>
    <th>分类名称</th>
	<th>分类样式</th>
    <th>店铺数量</th>
    <th>是否显示</th>
    <th>是否推荐</th>
    <th>排序</th>
    <th>操作</th>
  </tr>
  <?php $_from = $this->_var['cat_info']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'cat');if (count($_from)):
    foreach ($_from AS $this->_var['cat']):
?>
  <tr align="center" id="<?php echo $this->_var['cat']['str_id']; ?>">
    <td align="left" class="first-cell" >
      <span><a href="supplier_street.php?act=list&supplier_type=<?php echo $this->_var['cat']['str_id']; ?>"><?php echo $this->_var['cat']['str_name']; ?></a></span>
    </td>
	<td width="10%" align="center"><span onclick="listTable.edit(this, 'edit_str_style', <?php echo $this->_var['cat']['str_id']; ?>)"><?php echo $this->_var['cat']['str_style']; ?></span></td>
    <td width="10%"><?php echo empty($this->_var['cat']['num']) ? '0' : $this->_var['cat']['num']; ?></td>
    <td width="10%"><img src="images/<?php if ($this->_var['cat']['is_show'] == '1'): ?>yes<?php else: ?>no<?php endif; ?>.gif" onclick="listTable.toggle(this, 'toggle_is_show', <?php echo $this->_var['cat']['str_id']; ?>)" /></td>
    <td width="10%"><img src="images/<?php if ($this->_var['cat']['is_groom'] == '1'): ?>yes<?php else: ?>no<?php endif; ?>.gif" onclick="listTable.toggle(this, 'toggle_is_groom', <?php echo $this->_var['cat']['str_id']; ?>)" /></td>
    <td width="10%" align="center"><span onclick="listTable.edit(this, 'edit_sort_order', <?php echo $this->_var['cat']['str_id']; ?>)"><?php echo $this->_var['cat']['sort_order']; ?></span></td>
    <td width="24%" align="center">
      <a href="javascript:;" onclick="listTable.remove(<?php echo $this->_var['cat']['str_id']; ?>, '<?php echo $this->_var['lang']['drop_confirm']; ?>')" title="<?php echo $this->_var['lang']['remove']; ?>"><?php echo $this->_var['lang']['remove']; ?></a>
    </td>
  </tr>
  <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
</table>
<?php if ($this->_var['full_page']): ?>
</div>
</form>


<script language="JavaScript">
<!--

onload = function()
{
  // 开始检查订单
  startCheckOrder();
}

var imgPlus = new Image();
imgPlus.src = "images/menu_plus.gif";

/**
 * 折叠分类列表
 */
function rowClicked(obj)
{
  // 当前图像
  img = obj;
  // 取得上二级tr>td>img对象
  obj = obj.parentNode.parentNode;
  // 整个分类列表表格
  var tbl = document.getElementById("list-table");
  // 当前分类级别
  var lvl = parseInt(obj.className);
  // 是否找到元素
  var fnd = false;
  var sub_display = img.src.indexOf('menu_minus.gif') > 0 ? 'none' : (Browser.isIE) ? 'block' : 'table-row' ;
  // 遍历所有的分类
  for (i = 0; i < tbl.rows.length; i++)
  {
      var row = tbl.rows[i];
      if (row == obj)
      {
          // 找到当前行
          fnd = true;
          //document.getElementById('result').innerHTML += 'Find row at ' + i +"<br/>";
      }
      else
      {
          if (fnd == true)
          {
              var cur = parseInt(row.className);
              var icon = 'icon_' + row.id;
              if (cur > lvl)
              {
                  row.style.display = sub_display;
                  if (sub_display != 'none')
                  {
                      var iconimg = document.getElementById(icon);
                      iconimg.src = iconimg.src.replace('plus.gif', 'minus.gif');
                  }
              }
              else
              {
                  fnd = false;
                  break;
              }
          }
      }
  }

  for (i = 0; i < obj.cells[0].childNodes.length; i++)
  {
      var imgObj = obj.cells[0].childNodes[i];
      if (imgObj.tagName == "IMG" && imgObj.src != 'images/menu_arrow.gif')
      {
          imgObj.src = (imgObj.src == imgPlus.src) ? 'images/menu_minus.gif' : imgPlus.src;
      }
  }
}
//-->
</script>


<?php echo $this->fetch('pagefooter.htm'); ?>
<?php endif; ?>