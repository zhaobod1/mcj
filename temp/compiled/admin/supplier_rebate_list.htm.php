<!-- $Id: agency_list.htm 14216 2008-03-10 02:27:21Z testyang $ -->
<?php if ($this->_var['full_page']): ?>
<?php echo $this->fetch('pageheader.htm'); ?>
<?php echo $this->smarty_insert_scripts(array('files'=>'../js/utils.js,listtable.js,jquery-1.6.2.min.js,chosen.jquery.min.js')); ?>
<script type="text/javascript" src="../js/calendar.php?lang="></script>
<link href="../js/calendar/calendar.css" rel="stylesheet" type="text/css" />
<link href='styles/store.css' rel='stylesheet' type='text/css' />
<link href='styles/chosen/chosen.css' rel='stylesheet' type='text/css' />
<div class="list-div">
	<div class="rebate-detaile">
        <div class="rebate_item rebate_shop-item">
            <div class="item-hd">
            	<p>佣金抽成总额</p>
                <p><?php echo $this->_var['main_info']['rebate_money']; ?>元</p>
            </div>
        </div>
        <div class="rebate_item rebate_goods-item">
            <div class="item-hd">
            	<p>平台收入总额</p>
                <p>+<?php echo $this->_var['main_info']['all_money']; ?>元</p>
            </div>
        </div>
        <div class="rebate_item rebate_order-item">
            <div class="item-hd">
            	<p>平台支出总额</p>
                <p>-<?php echo $this->_var['main_info']['result_money']; ?>元</p>
            </div>
        </div>
    </div>
</div>
<div class="form-div">
	<form action="supplier_rebate.php" method="post" name="searchForm">
		<table width="100%" cellpadding="0" cellspacing="0" border="0">
          <tr>
            <!-- <td width="7%" align="right">商家名称：</td> -->
            <td width="100%" align="left">
            	<!-- <input type="text" name="" /> -->
				<select class="chzn-select" data-placeholder="商家名称" style="width:350px;" name="suppid"> 
				<option value=""></option>
                
                <option value="">全部</option>
                

                    <?php $_from = $this->_var['supplier_info']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'supp');if (count($_from)):
    foreach ($_from AS $this->_var['supp']):
?>
				   <option value="<?php echo $this->_var['supp']['supplier_id']; ?>"><?php echo $this->_var['supp']['supplier_name']; ?></option>  
				<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
				</select>
                <a href='javascript:search_submit()' class="button_round" title="搜索" >搜索</a>
                <a class="button_round" title="批量导出搜索结果" onclick="exportSupps()">下载</a>
            </td>
          </tr>
		</table>
	</form>
</div>

<form method="post" action="" name="listForm" onsubmit="return confirm(batch_drop_confirm);">
<div class="list-div" id="listDiv">
<?php endif; ?>

  <table cellpadding="3" cellspacing="1">
    <tr>
	  <th>商家名称</th>
      <th><a href="javascript:listTable.sort('all_money'); ">订单收入总额（元）</a></th>
      <th><a href="javascript:listTable.sort('rebate_money'); ">佣金抽成总额（元）</a></th>
      <th><a href="javascript:listTable.sort('result_money'); ">商家实际收入总额（元）</a></th>
	  <th>操作</th>
    </tr>
    <?php $_from = $this->_var['supplier_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'supplier');if (count($_from)):
    foreach ($_from AS $this->_var['supplier']):
?>
    <tr>
	  <td align="center"><?php echo $this->_var['supplier']['supplier_name']; ?></td>
      <td align="center">+<?php echo $this->_var['supplier']['all_money']; ?></td>
      <td align="center">-<?php echo $this->_var['supplier']['rebate_money']; ?></td>
      <td align="center"><?php echo $this->_var['supplier']['result_money']; ?></td>
	  <td align="center"><a href="supplier_rebate.php?act=view&suppid=<?php echo $this->_var['supplier']['supplier_id']; ?>" title="查看"><img src="images/icon_view.gif" border="0" height="16" width="16" /></a></td>
    </tr>
    <?php endforeach; else: ?>
    <tr><td class="no-records" colspan="5"><?php echo $this->_var['lang']['no_records']; ?></td></tr>
    <?php endif; unset($_from); ?><?php $this->pop_vars();; ?>
  </table>
<table id="page-table" cellspacing="0">
  <tr>
    <td>&nbsp;</td>
    <td align="right" nowrap="true">
    <?php echo $this->fetch('page.htm'); ?>
    </td>
  </tr>
</table>

<?php if ($this->_var['full_page']): ?>
</div>
</form>

<script type="text/javascript" language="javascript">
  <!--
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
  }
  /**
     * 搜索订单
     */
    function searchRebate()
    {
        listTable.filter['suppid'] = Utils.trim(document.forms['searchForm'].elements['suppid'].value);
        listTable.filter['page'] = 1;
        listTable.loadList();
    }
	function search_submit(){
		//listTable.query = "search_query";
		searchRebate();
	}

	function exportSupps()
	{
		var frm=document.forms['searchForm'];
		frm.action ="supplier_rebate.php?act=export_supps&is_export=1";
		frm.submit();
	}
  
  //-->
</script>
<script type="text/javascript">
	$().ready(function(){
		$(".chzn-select").chosen();
	});
</script>
<?php echo $this->fetch('pagefooter.htm'); ?>
<?php endif; ?>