<!-- $Id: agency_list.htm 14216 2008-03-10 02:27:21Z testyang $ -->

<?php if ($this->_var['full_page']): ?>
<?php echo $this->fetch('pageheader.htm'); ?>
<?php echo $this->smarty_insert_scripts(array('files'=>'../js/utils.js,listtable.js')); ?>
<!-- 供货商搜索 -->
<div class="form-div">
    <form action="javascript:searchSupplier(<?php echo $this->_var['state']; ?>)" name="searchForm">
        <img src="images/icon_search.gif" width="26" height="22" border="0" alt="SEARCH" />
        会员名称
        <input name="supplier_name" type="text" id="supplier_name" size="15">
        <input type="submit" value="<?php echo $this->_var['lang']['button_search']; ?>" class="button" />

        <?php if ($this->_var['status'] == 1): ?>
        <input type="button" value="批量导出" class="button" onclick="batch_export()" />
        <?php endif; ?>
    </form>
</div>
<form method="post" action="" name="listForm" onsubmit="return confirm(batch_drop_confirm);">
    <div class="list-div" id="listDiv">
        <?php endif; ?>

        <table cellpadding="3" cellspacing="1">
            <tr>
                <th>会员名称</th>
                <th>会员手机号</th>
                <th>会员地址</th>
                <th>申请等级</th>
                <th>分站区域</th>
                <th>分成利率</th>
                <th>状态</th>
                <th><?php echo $this->_var['lang']['handler']; ?></th>
            </tr>

            <?php $_from = $this->_var['supplier_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'supplier');if (count($_from)):
    foreach ($_from AS $this->_var['supplier']):
?>
            <tr>
                <td ><?php echo $this->_var['supplier']['full_name']; ?> </td>
                <td class="first-cell" style="padding-left:10px;" ><?php echo $this->_var['supplier']['telephone']; ?></td>
                <td ><?php echo $this->_var['supplier']['address']; ?> </td>
                <td><?php echo $this->_var['supplier']['level_name']; ?></td>
                <td><?php echo $this->_var['supplier']['sub_name']; ?></td>
                <td align="center"><?php echo $this->_var['supplier']['profit']; ?></td>
                <td align="center"><?php echo $this->_var['supplier']['status_name']; ?></td>
                <td align="center">
                    <a href="substations.php?act=edit&id=<?php echo $this->_var['supplier']['member_id']; ?>&status=<?php echo $this->_var['status']; ?>" title="<?php echo $this->_var['lang']['view']; ?>"><?php echo $this->_var['lang']['view']; ?></a><?php if ($this->_var['supplier']['status'] > 0 && $this->_var['supplier']['open'] > 0): ?>&nbsp;&nbsp;<a href="../supplier.php?suppId=<?php echo $this->_var['supplier']['supplier_id']; ?>" target="_blank">查看店铺</a>&nbsp;&nbsp;
                    <!--<a href="supplier.php?act=view&id=<?php echo $this->_var['supplier']['supplier_id']; ?>" title="查看佣金">查看佣金</a>--><?php else: ?>&nbsp;&nbsp;<?php endif; ?>&nbsp;&nbsp;<a href="javascript:del_supplier(<?php echo $this->_var['supplier']['id']; ?>)" title="删除">删除</a></td>
            </tr>
            <?php endforeach; else: ?>
            <tr><td class="no-records" colspan="10"><?php echo $this->_var['lang']['no_records']; ?></td></tr>
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
    
    //-->
    /**
     * 搜索供货商
     */
    function searchSupplier(state)
    {
        listTable.filter['supplier_name'] = Utils.trim(document.forms['searchForm'].elements['supplier_name'].value);
       // listTable.filter['rank_name'] = document.forms['searchForm'].elements['rank_name'].value;
       if(state)
       {
           listTable.filter['status'] =0;
       }else {
           listTable.filter['status'] =1;
       }

        listTable.filter['page'] = 1;
        listTable.loadList();
    }

    function del_supplier(suppid){
        var url = "substations.php?act=delete&id="+suppid;
        if(confirm('确定删除？')){
            self.location.href = url;
        }
    }

    function batch_export()
    {
        var supplier_name = Utils.trim(document.forms['searchForm'].elements['supplier_name'].value);
        var rank_id = Utils.trim(document.forms['searchForm'].elements['rank_name'].value);
        return location.href='supplier.php?act=export&supplier_name='+supplier_name+'&rank_id='+rank_id;
    }
</script>
<?php echo $this->fetch('pagefooter.htm'); ?>
<?php endif; ?>