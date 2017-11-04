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
			<?php echo ($cart_info["name"]); ?> - 商品确认详情
		</div>
		 <div class="tw-list-top">
		    <div class="tw-tool-bar">
	            <a class="tw-tool-btn-del" onclick="javascript:recycle('chkbId', '确认删除？删除后该数据将放入回收站!')">
                    <i class="tw-icon-minus-circle"></i> 批量删除
                </a>
	         </div>
	         <form action="/index.php/Admin/GoodsConfirm/cartDetail/id/176" method="get" id='frmSearch'>
                <div class="tw-search-bar">
			        <!-- 高级搜索 -->
			        <div class="search-form fr cf">
			            <div class="sleft">
			                <input type="text" name="goods_name" class="search-input" value="<?php echo I('goods_name');?>" placeholder="请输入商品名称">
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
						<th width="50">ID</th>
						<th>商品名称</th>
						<th width="8%">颜色</th>
						<th width="10%">尺寸</th>
						<th width="8%">风格</th>
						<th width="8%">材质</th>
						<!--杨yongjie  添加-->
						<th width="8%">数量</th>
						<th width="8%">单价</th>
						<!--杨yongjie  添加-->
						<th width="8%">喜好等级</th>
						<th width="8%">收藏夹单号</th>
						<th width="10%">添加时间</th>
					</tr>
				</thead>
				<tbody>
					<?php if(!empty($list)): if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?><tr>
							<td><input class="ids row-selected" type="checkbox" name="chkbId" value="<?php echo ($v["id"]); ?>"></td>
							<td><?php echo ($v["id"]); ?></td>
							<td class="text-left cfname"><?php echo ($v["goods_name"]); ?></td>
							<td><?php echo ($v["color"]); ?></td>
							<td><?php echo ($v["size"]); ?></td>
							<td><?php echo ($v["style"]); ?></td>
							<td><?php echo ($v["material"]); ?></td>
							<!--杨yongjie  添加-->
							<td><?php echo ($v["goods_count"]); ?></td>
							<td><?php echo ($v["price"]); ?></td>
							<!--杨yongjie  添加-->
							<td><?php echo (show_favorite_like_level($v["like_level"])); ?></td>
							<td><?php echo ($cart_info["collection_sn"]); ?></td>
							<td><?php echo (time_format($v["add_time"])); ?></td>
						</tr><?php endforeach; endif; else: echo "" ;endif; ?>
					<?php else: ?>
					    <td colspan="11" class="text-center"> aOh! 暂时还没有内容! </td><?php endif; ?>
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
    RECYCLE_URL = "<?php echo U('detailRecycle');?>"; // 重新定义删除地址
</script>

</body>
</html>