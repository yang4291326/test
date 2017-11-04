<?php if (!defined('THINK_PATH')) exit(); if(!empty($attr_list)): ?><colgroup>
    <col width="10%">
    <col width="90%">
</colgroup>
<tbody>
<tr>
    <th colspan="2" class="information"><div class="fl offset">扩展属性</div></th>
</tr>
<?php if(is_array($attr_list)): $k = 0; $__LIST__ = $attr_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$list): $mod = ($k % 2 );++$k; if($list["attr_type"] == 0 || $list["attr_type"] == 1): ?><tr>
		    <th><em></em> <?php echo ($list["attr_name"]); ?>:</th>
		    <td>
		    	<input type="text" name="goods_attr_value[<?php echo ($list["id"]); ?>]" class="text input-large at<?php echo ($list["id"]); ?>" placeholder="请输入<?php echo ($list["attr_name"]); ?>" value="<?php echo ($info["attr_name"]); ?>"/>
		    </td>
		</tr>
	<?php elseif($list["attr_type"] == 2): ?>
		<tr>
		    <th><em></em> <?php echo ($list["attr_name"]); ?>:</th>
		    <td>
		    	<?php if(is_array($list[attr_value])): $i = 0; $__LIST__ = $list[attr_value];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?><label class="radio"><input type="radio" name="goods_attr_value[<?php echo ($list["id"]); ?>][]" value="<?php echo ($v); ?>"/><?php echo ($v); ?></label><?php endforeach; endif; else: echo "" ;endif; ?>
		    </td>
		</tr>
	<?php else: ?>
		<tr>
		    <th><em></em> <?php echo ($list["attr_name"]); ?>:</th>
		    <td>
		    	<?php if(is_array($list[attr_value])): $i = 0; $__LIST__ = $list[attr_value];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?><label class="checkbox"><input type="checkbox" name="goods_attr_value[<?php echo ($list["id"]); ?>][]" value="<?php echo ($v); ?>"/><?php echo ($v); ?></label><?php endforeach; endif; else: echo "" ;endif; ?>
		    </td>
		</tr><?php endif; endforeach; endif; else: echo "" ;endif; ?>
</tbody><?php endif; ?>