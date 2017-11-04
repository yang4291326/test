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
			<?php echo isset($info['id'])?'编辑':'新增';?>商品分类
		</div>
		<div class="tw-list-wrap tw-edit-wrap">
		    <form action="/index.php/Admin/GoodsCategory/edit" enctype="application/x-www-form-urlencoded" method="POST" class="form-horizontal ajaxForm">
		        <div class="form-item">
		            <label for="auth-title" class="item-label">分类名称<span class="check-tips"><b>*</b>（请输入分类名称）</span></label>
		            <div class="controls">
		                <input type="text" name="name" class="text input-large" placeholder="请输入商品分类名称" value="<?php echo ($info["name"]); ?>"/>
		            </div>
		        </div>
		        <div class="form-item">
			        <label class="item-label">上级分类<span class="check-tips"><b>*</b>（请选择上级分类）</span></label>
			        <div class="controls">
			             <select name="parent_id" id="parent_id">
			             	 <option value="">顶级分类</option>
			                 <?php if(is_array($goodsCategory)): $i = 0; $__LIST__ = $goodsCategory;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$gcate): $mod = ($i % 2 );++$i;?><option value="<?php echo ($gcate["id"]); ?>" <?php if($gcate[id] == $info[parent_id]): ?>selected<?php endif; ?>><?php echo ($gcate["title_show"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
			             </select>
			        </div>
			    </div>
			    <div class="form-item">
		            <label for="auth-title" class="item-label">分类排序<span class="check-tips"><b>*</b>（请输入分类排序）</span></label>
		            <div class="controls">
		                <input type="text" name="sort" class="text input-large" value="<?php echo ($info[sort]?$info[sort]:'50'); ?>"/>
		            </div>
		        </div>
		        <!-- <div class="form-item">
		            <label for="auth-title" class="item-label">分类图标<span class="check-tips">（二级分类请上传图标）</span></label>
		            <div class="controls">
                        <img src="<?php echo ($info["pic_path"]); ?>" style="height:129px; width:129px;" id="img_"/>
                        <input type="hidden" value="<?php echo ($info["pic_path"]); ?>" name="pic_path" id="img" />
                        <input class="btn btn-default btn-xs" type="button" value="上传图标" id="btnUpload"/>
                        <input class="btn btn-danger btn-xs" type="button" value="删除" onclick="delFile($('#img').val(), '')" id="btn_delete_" />
                        <?php if($info["pic_path"] == ''): ?><script>
                                $("#img_, #btn_delete_").hide();
                            </script><?php endif; ?>
		            </div>
		        </div> -->
		        <!-- <div class="form-item">
		            <label for="auth-title" class="item-label">滑过分类图标<span class="check-tips">（二级分类请上传滑过图标）</span></label>
		            <div class="controls">
                        <img src="<?php echo ($info["pic_hover_path"]); ?>" style="height:129px; width:129px;" id="img_1"/>
                        <input type="hidden" value="<?php echo ($info["pic_hover_path"]); ?>" name="pic_hover_path" id="img1" />
                        <input class="btn btn-default btn-xs" type="button" value="上传图标" id="btnUpload1"/>
                        <input class="btn btn-danger btn-xs" type="button" value="删除" onclick="delFile($('#img1').val(), '1')" id="btn_delete_1" />
                        <?php if($info["pic_hover_path"] == ''): ?><script>
                                $("#img_1, #btn_delete_1").hide();
                            </script><?php endif; ?>
		            </div>
		        </div> -->
		        <div class="form-item">
		            <label for="auth-description" class="item-label">分类备注</label>
	                <textarea type="text" rows="5" cols="57" id="auth-description" name="remark" placeholder="情输入分类备注描述"><?php echo ($info["remark"]); ?></textarea>
		        </div>
		        <div class="tw-tool-bar-bot">
		           <input type="hidden" name="id" value="<?php echo ($info["id"]); ?>" />
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
    
	<script type="text/javascript" charset="utf-8" src="/Public/ajaxupload.js"></script>
    <script type="text/javascript" charset="utf-8" src="/Application/Common/Static/js/imgupload.js"></script>
    <script>
        $(function(){
            ajaxUpload('#btnUpload', $("#img"), 'Category', '');
            ajaxUpload('#btnUpload1', $("#img1"), 'Category', '1');
        });
    </script>

</body>
</html>