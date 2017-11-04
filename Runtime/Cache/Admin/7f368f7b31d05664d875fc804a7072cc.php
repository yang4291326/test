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
    
	<style>
	.cfname a{
		color:#3366FF;
	}
	.cfname a:hover{
		color:#3366FF;
		text-decoration: underline;
	}
	</style>

</head>
<body>
    
    <!-- 内容区 -->
    <div id="content">
        
<div class="tw-layout">
		<div class="tw-list-hd">
			商品确认管理 
		</div>
		<?php if(!empty($prompt_tips)): ?><div class="tw_list_tips">
				<div class="tips-name">提示语：</div>
				<div class="tips-content"><?php echo ($prompt_tips); ?></div>
			</div><?php endif; ?>
		<div class="tw-list-top">
		    <div class="tw-tool-bar">
	            <a class="tw-tool-btn-del" onclick="javascript:recycle('chkbId', '确认删除？删除后该数据将放入回收站!')">
                    <i class="tw-icon-minus-circle"></i> 批量删除
                </a>
	         </div>
	         <form action="/index.php/Admin/GoodsConfirm/index" method="post" id='frmSearch'>
                <div class="tw-search-bar">
			        <!-- 高级搜索 -->
			        <div class="search-form fr cf">
			            <div class="sleft">
			                <input type="text" name="collection_sn" class="search-input" value="<?php echo I('collection_sn');?>" placeholder="请输入商品确认单号">
			                <a type="submit" class="sch-btn" onclick="$('#frmSearch').submit();"><i class="btn-search"></i></a>
			            </div>
			        </div>
		        </div>
            </form>
	    </div>
		<div class="tw-list-wrap">
			<table class="tw-table tw-table-list tw-table-fixed">
				<thead>
					<tr>
						<th width="10" class="row-selected">
	                        <input class="checkbox check-all" type="checkbox">
	                    </th>
						<th width="50">序号/th>
						<th width="20%">单号列表</th>
						<th width="10%">用户名称</th>
						<th width="20%">内容概述</th>
						<!--杨yongjie  添加-->
						<th width="10%">总计金额</th>
						<!--杨yongjie  添加-->
						<th width="10%">添加时间</th>
						<th width="15%">操作</th>
					</tr>
				</thead>
				<tbody>
					<?php if(!empty($list)): if(is_array($list)): $k = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($k % 2 );++$k;?><tr>
							<td><input class="ids row-selected" type="checkbox" name="chkbId" value="<?php echo ($v["id"]); ?>"></td>
							<td><?php echo (page_code($k)); ?></td>
							<td class="cfname"><a href="<?php echo U('cartDetail?id='.$v['id']);?>" title="查看列表"><?php echo ($v["collection_sn"]); ?></a></td>
							<td><?php echo ($v["user_name"]); ?></td>
							<td class="text-left"><?php echo ($v["remark"]); ?></td>
							<!--杨yongjie  添加-->
							<td><?php echo ($v["price_total"]); ?></td>
							<!--杨yongjie  添加-->
							<td><?php echo (time_format($v["add_time"])); ?></td>
							<td>
				                <a class="tw-tool-btn-del" onclick="javascript:recycle(<?php echo ($v['id']); ?>, '确认删除？删除后该数据将放入回收站!')">
	                                <i class="tw-icon-minus-circle"></i> 删除
	                            </a>
	                            <a class="tw-tool-btn-copy"  onclick="showPhoto('<?php echo ($v["cart_photo"]); ?>')">
				                    <i class="tw-icon-cogs"></i> 查看拍照
				                </a>
							</td>
						</tr><?php endforeach; endif; else: echo "" ;endif; ?>
					<?php else: ?>
					    <td colspan="7" class="text-center"> aOh! 暂时还没有内容! </td><?php endif; ?>
				</tbody>
			</table>
			<!-- 分页 -->
		    <div class="page"><?php echo ($page); ?></div>
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
function showPhoto(path) {
	if (path == '') {
		toastr.error('拍照不存在');
	} else {
		window.location.href = path;
	}
}
</script>

</body>
</html>