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
             <?php echo isset($info['id'])?'编辑':'新增';?>前台日志模块
        </div>
		
	    <div class="tw-list-wrap tw-edit-wrap">
            <form action="/index.php/Admin/HomeLogModular/edit/id/2" method="post" class="form-horizontal ajaxForm" enctype="multipart/form-data">
                <div class="form-item">
                    <label class="item-label">前台日志模块名称<span class="check-tips"><b>*</b>（输入前台日志模块名称）</span></label>
                    <div class="controls">
                        <input type="text" class="text input-large" name="name" value="<?php echo ($info["name"]); ?>">
                    </div>
                </div>
                <div class="form-item">
                    <label class="item-label">上级前台日志模块<span class="check-tips"><b>*</b>（上级分类）</span></label>
                    <div class="controls">
                        <select name="parent_id">
                            <option value="0">顶级前台日志模块</option>
                            <?php if(is_array($homeLogModularTree)): $i = 0; $__LIST__ = $homeLogModularTree;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo["id"]); ?>"
                                <?php if($vo["id"] == $info['parent_id'] ): ?>selected="selected"<?php endif; ?>
                                ><?php echo ($vo["title_show"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                        </select>
                    </div>
                </div>    
                <div class="form-item">
                    <label class="item-label">排序<span class="check-tips"><b>*</b></span></label>
                    <div class="controls">
                         <input type="text" class="text input-large" name="sort" value="<?php echo ($info["sort"]); ?>">
                    </div>
                </div>
                <div class="tw-tool-bar-bot">
                    <input type="hidden" name="id" value="<?php echo ($info["id"]); ?>"/>
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
    
</body>
</html>