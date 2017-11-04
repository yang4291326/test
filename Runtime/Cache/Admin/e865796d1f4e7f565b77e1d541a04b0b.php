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
			<?php echo ($info['id']?'编辑':'新增'); ?>配置
		</div>
		<div class="tw-list-wrap tw-edit-wrap">
			
			<form action="<?php echo U();?>" method="post" class="form-horizontal ajaxForm">
				<div class="form-item">
					<label class="item-label">配置标识<span class="check-tips">（用于C函数调用，只能使用英文且不能重复）</span></label>
					<div class="controls">
						<input type="text" class="text input-large" name="name" value="<?php echo ((isset($info["name"]) && ($info["name"] !== ""))?($info["name"]):''); ?>">
					</div>
				</div>
				<div class="form-item">
					<label class="item-label">配置标题<span class="check-tips">（用于后台显示的配置标题）</span></label>
					<div class="controls">
						<input type="text" class="text input-large" name="title" value="<?php echo ((isset($info["title"]) && ($info["title"] !== ""))?($info["title"]):''); ?>">
					</div>
				</div>
				<div class="form-item">
					<label class="item-label">排序<span class="check-tips">（用于分组显示的顺序）</span></label>
					<div class="controls">
						<input type="text" class="text input-small" name="sort" value="<?php echo ((isset($info["sort"]) && ($info["sort"] !== ""))?($info["sort"]):0); ?>">
					</div>
				</div>
				<div class="form-item">
					<label class="item-label">配置类型<span class="check-tips">（系统会根据不同类型解析配置值）</span></label>
					<div class="controls">
						<select name="type" id="type">
							<?php if(is_array(C("CONFIG_TYPE_LIST"))): $i = 0; $__LIST__ = C("CONFIG_TYPE_LIST");if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$type): $mod = ($i % 2 );++$i;?><option value="<?php echo ($key); ?>"><?php echo ($type); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
						</select>
					</div>
				</div>
				<div class="form-item">
					<label class="item-label">配置分组<span class="check-tips">（配置分组 用于批量设置 不分组则不会显示在系统设置中）</span></label>
					<div class="controls">
						<select name="group" id="group">
							<option value="0">不分组</option>
							<?php if(is_array(C("CONFIG_GROUP_LIST"))): $i = 0; $__LIST__ = C("CONFIG_GROUP_LIST");if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$group): $mod = ($i % 2 );++$i;?><option value="<?php echo ($key); ?>"><?php echo ($group); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
						</select>
					</div>
				</div>
				<div class="form-item">
					<label class="item-label">配置值<span class="check-tips">（配置值）</span></label>
					<div class="controls">
						<label class="textarea input-large">
							<textarea name="value"><?php echo ((isset($info["value"]) && ($info["value"] !== ""))?($info["value"]):''); ?></textarea>
						</label>
					</div>
				</div>
				<div class="form-item">
					<label class="item-label">配置项<span class="check-tips">（如果是枚举型 需要配置该项）</span></label>
					<div class="controls">
						<label class="textarea input-large">
							<textarea name="extra"><?php echo ((isset($info["extra"]) && ($info["extra"] !== ""))?($info["extra"]):''); ?></textarea>
						</label>
					</div>
				</div>
				<div class="form-item">
					<label class="item-label">说明<span class="check-tips">（配置详细说明）</span></label>
					<div class="controls">
						<label class="textarea input-large">
							<textarea name="remark"><?php echo ((isset($info["remark"]) && ($info["remark"] !== ""))?($info["remark"]):''); ?></textarea>
						</label>
					</div>
				</div>
				<div class="tw-tool-bar-bot">
					<input type="hidden" name="id" value="<?php echo ((isset($info["id"]) && ($info["id"] !== ""))?($info["id"]):''); ?>">
	                <button type="submit" class="tw-act-btn-confirm">提交</button>
	                <button type="button" onclick="goback();" class="tw-act-btn-cancel">返回</button>
		        </div>
			</form>
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
		$("#type").val('<?php echo ((isset($info["type"]) && ($info["type"] !== ""))?($info["type"]): 0); ?>');
		$("#group").val('<?php echo ((isset($info["group"]) && ($info["group"] !== ""))?($info["group"]): 0); ?>');
	</script>

</body>
</html>