<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <title><?php echo ($meta_title); ?></title>
    <link rel="stylesheet" type="text/css" href="/Application/Admin/Static/css/base.css" media="all">
    <link rel="stylesheet" type="text/css" href="/Application/Admin/Static/css/common.css" media="all">
    <link rel="stylesheet" type="text/css" href="/Application/Admin/Static/css/module.css">
    <link rel="stylesheet" type="text/css" href="/Public/assets/css/style.css" media="all">
    <link rel="stylesheet" type="text/css" href="/Application/Admin/Static/css/default_color.css" media="all">
    <link rel="stylesheet" type="text/css" href="/Public/toastr/toastr.css" media="all">
    <link rel="stylesheet" type="text/css" href="/Public/dropdownlist/dropdownlist.css" media="all">
    <!--[if lt IE 9]-->
    <script type="text/javascript" src="/Application/Admin/Static/js/jquery-1.10.2.min.js"></script>
    <!--[endif]-->
    <script type="text/javascript" src="/Application/Admin/Static/js/jquery-2.0.3.min.js"></script>
    
</head>
<body>
    
    <!-- 内容区 -->
    <div id="content">
        
<div class="tw-layout">
		<div class="tw-list-hd">
			<?php echo ($list_title); ?>
		</div>
		<?php if(!empty($prompt_tips)): ?><div class="tw_list_tips">
				<div class="tips-name">提示语：</div>
				<div class="tips-content"><?php echo ($prompt_tips); ?></div>
			</div><?php endif; ?>
		<div class="tw-list-top">
		    <div class="tw-tool-bar">
	    		<a class="tw-tool-btn-add" href="<?php echo U('edit?cate_id='.$cate_id);?>">
	                <i class="tw-icon-plus-circle"></i> 添加属性
	            </a>
	         </div>
	    </div>
		<div class="tw-list-wrap">
			<table class="tw-table tw-table-list tw-table-fixed">
				<thead>
					<tr>
						<th width="50">序号</th>
						<th width="20%">属性名称</th>
						<th width="8%">属性类别</th>
						<th width="30%">属性值</th>
						<th width="10%">属性排序</th>
						<th width="10%">属性状态</th>
						<th width="15%">操作</th>
					</tr>
				</thead>
				<tbody>
					<?php if(!empty($list)): if(is_array($list)): $k = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($k % 2 );++$k;?><tr>
							<td><?php echo (page_code($k)); ?></td>
							<td class="text-left"><?php echo ($v["attr_name"]); ?></td>
							<td><?php echo (show_goods_attr_status($v["attr_type"])); ?></td>
							<td class="text-left" style="word-wrap:break-word"><?php echo ($v["attr_value"]); ?></td>
							<td><?php echo ($v["attr_sort"]); ?></td>
							<td><?php echo (show_status($v["attr_status"])); ?></td>
							<td>
								<a class="tw-tool-btn-edit"  href="<?php echo U('edit?id='.$v['id'].'&cate_id='.$cate_id);?>">
				                    <i class="tw-icon-pencil"></i> 修改
				                </a>
				                <?php if($cate_id != 0): ?><a class="tw-tool-btn-del" onclick="javascript:recycle(<?php echo ($v['id']); ?>, '确认删除？删除后该自定义属性将不在显示', true)">
		                                <i class="tw-icon-minus-circle"></i> 删除
		                            </a><?php endif; ?>
							</td>
						</tr><?php endforeach; endif; else: echo "" ;endif; ?>
					<?php else: ?>
					    <td colspan="7" class="text-center"> aOh! 暂时还没有内容! </td><?php endif; ?>
				</tbody>
			</table>
			<!-- 分页 -->
		    <div class="page">
		        <?php echo ($page); ?>
		    </div>
		</div>
</div>

    </div>
    <!-- /内容区 -->
    <!--[if gte IE 9]><!-->
    <script type="text/javascript" src="/Application/Admin/Static/js/jquery.mousewheel.js"></script>
    <!--<![endif]-->
    <script type="text/javascript" src="/Public/toastr/toastr.js" ></script>
    <script type="text/javascript" src="/Public/assets/js/wf-list.js" ></script>
    <script type="text/javascript" src="/Public/assets/plugins/layer-v2.0/layer/layer.js"></script>
    <script type="text/javascript" src="/Public/assets/plugins/laydate-v1.1/laydate/laydate.js"></script>
    <script type="text/javascript" src="/Public/assets/js/common.js"></script>
<!--    <script type="text/javascript" src="/Public/dropdownlist/dropdownlist.js"></script>-->
    <script type="text/javascript" src="/Application/Admin/Static/js/common.js"></script>
    <script>
        // 定义全局变量
        RECYCLE_URL = "<?php echo U('recycle');?>"; // 默认逻辑删除操作执行的地址
        RESTORE_URL = "<?php echo U('restore');?>"; // 默认逻辑删除恢复执行的地址
        DELETE_URL = "<?php echo U('del');?>"; // 默认删除操作执行的地址
        UPLOAD_IMG_URL = "<?php echo U('uploadImg');?>"; // 默认上传图片地址
        UPLOAD_FIELD_URL = "<?php echo U('uploadField');?>"; // 默认上传图片地址
        DELETE_FILE_URL = "<?php echo U('delFile');?>"; // 默认删除图片执行的地址
        CHANGE_STAUTS_URL = "<?php echo U('changeDisabled');?>"; // 修改数据的启用状态
        CROPPER_IMG_URL = "<?php echo U('/Admin/Ajax/cropper');?>";//裁剪图片地址
    </script>
    
<script type="text/javascript">
</script>

</body>
</html>