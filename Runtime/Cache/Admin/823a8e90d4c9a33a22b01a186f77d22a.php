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
			<?php echo isset($info['id'])?'编辑':'新增';?>商品属性
		</div>
		<div class="tw-list-wrap tw-edit-wrap">
		    <form action="/index.php/Admin/GoodsAttribute/edit/id/17/cate_id/0" enctype="application/x-www-form-urlencoded" method="POST" class="form-horizontal ajaxForm">
		        <div class="form-item">
		            <label for="auth-title" class="item-label">属性名称<span class="check-tips"><b>*</b>（请输入属性名称）</span></label>
		            <div class="controls">
		                <input type="text" name="attr_name" class="text input-large" placeholder="请输入属性名称" value="<?php echo ($info["attr_name"]); ?>"/>
		            </div>
		        </div>
		        <div class="form-item">
		            <label for="auth-title" class="item-label">属性类型</label>
		            <div class="controls">
		                <label class="radio"><input type="radio" name="attr_type" value="0" <?php if($info["attr_type"] == 0): ?>checked="checked"<?php endif; ?>/>文本</label>
		                <label class="radio"><input type="radio" name="attr_type" value="1" <?php if($info["attr_type"] == 1): ?>checked="checked"<?php endif; ?>/>数字</label>
		                <label class="radio"><input type="radio" name="attr_type" value="2" <?php if($info["attr_type"] == 2): ?>checked="checked"<?php endif; ?>/>单选</label>
		                <label class="radio"><input type="radio" name="attr_type" value="3" <?php if($info["attr_type"] == 3): ?>checked="checked"<?php endif; ?>/>多选</label>
		            </div>
		        </div>
		        <div class="form-item">
		            <label for="auth-title" class="item-label">属性值<span class="check-tips">（当属性类型为枚举时，需要配置该项）</span></label>
		            <div class="controls">
		                 <textarea type="text" rows="3" cols="57" id="attr-value" name="attr_value" placeholder="当属性值为多个时，请用英文逗号“,”隔开" <?php if(!in_array(($info[attr_type]), explode(',',"2,3"))): ?>disabled="false"<?php endif; ?>><?php echo ($info["attr_value"]); ?></textarea>
		            </div>
		        </div>
			    <div class="form-item">
		            <label for="auth-title" class="item-label">属性排序<span class="check-tips"><b>*</b>（请输入属性排序）</span></label>
		            <div class="controls">
		                <input type="text" name="attr_sort" class="text input-large" value="<?php echo ($info[attr_sort]?$info[attr_sort]:'50'); ?>"/>
		            </div>
		        </div>
	            <div class="form-item">
		            <label for="auth-title" class="item-label">属性状态</label>
		            <div class="controls">
		                <input type="radio" name="attr_status" value="0" <?php if($info["attr_status"] == 0): ?>checked="checked"<?php endif; ?>/>启用
		                <input type="radio" name="attr_status" value="1" <?php if($info["attr_status"] == 1): ?>checked="checked"<?php endif; ?>/>禁用
		            </div>
		        </div>
		        <div class="tw-tool-bar-bot">
		           <input type="hidden" name="id" value="<?php echo ($info["id"]); ?>" />
		           <input type="hidden" name="cate_id" value="<?php echo ($cate_id); ?>" />
		           <input type="hidden" name="attr_mode" value="<?php if($cate_id != 0): ?>1<?php else: ?>0<?php endif; ?>" />
		           <button type="submit" class="tw-act-btn-confirm">提交</button>
		           <button type="button" onclick="goback()" class="tw-act-btn-cancel">返回</button>
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
    
<script type="text/javascript" charset="utf-8">
    $(function(){
    	$("input[name='attr_type']").click(function(){
    		if($(this).val() == 2 || $(this).val() == 3){
    			$("#attr-value").attr("disabled", false);                       
    		} else {
    			$("#attr-value").attr("disabled", true);
    			$("#attr-value").val(null);
    		}
    	});
    });
</script>

</body>
</html>