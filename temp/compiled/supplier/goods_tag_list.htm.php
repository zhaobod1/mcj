<!-- $Id: brand_list.htm 15898 2009-05-04 07:25:41Z liuhui $ -->

<?php if ($this->_var['full_page']): ?>
<?php echo $this->fetch('pageheader.htm'); ?>
<?php echo $this->smarty_insert_scripts(array('files'=>'../js/utils.js,listtable.js')); ?>
<!-- 品牌搜索 -->
<div class="list-div" id="listDiv">
<?php endif; ?>

  <table cellpadding="3" cellspacing="1">
    <tr>
      <th>标签名称</th>
      <th width="80">类型</th>
      <th width="100"><?php echo $this->_var['lang']['handler']; ?></th>
    </tr>
    <?php $_from = $this->_var['item_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'value');if (count($_from)):
    foreach ($_from AS $this->_var['value']):
?>
    <tr>
      <td><?php echo $this->_var['value']['tag_name']; ?></td>
      <td align="center">
      		<?php if ($this->_var['value']['is_user'] == 1): ?><span style="color:#F00">用户</span><?php endif; ?>
            <?php if ($this->_var['value']['is_user'] == 0): ?>系统<?php endif; ?>
      </td>
      <td align="center">
        <a href="goods_tag.php?act=edit&goods_id=<?php echo $this->_var['value']['goods_id']; ?>&id=<?php echo $this->_var['value']['tag_id']; ?>" title="<?php echo $this->_var['lang']['edit']; ?>"><?php echo $this->_var['lang']['edit']; ?></a> |
        <a href="javascript:;" onclick="listTable.remove(<?php echo $this->_var['value']['tag_id']; ?>, '<?php echo $this->_var['lang']['drop_confirm']; ?>')" title="<?php echo $this->_var['lang']['edit']; ?>"><?php echo $this->_var['lang']['remove']; ?></a> 
      </td>
    </tr>
    <?php endforeach; else: ?>
    <tr><td class="no-records" colspan="4"><?php echo $this->_var['lang']['no_records']; ?></td></tr>
    <?php endif; unset($_from); ?><?php $this->pop_vars();; ?>
  </table>

<?php if ($this->_var['full_page']): ?>
<!-- end brand list -->
</div>

<?php echo $this->fetch('pagefooter.htm'); ?>
<?php endif; ?>