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
    	<div class="tw-list-hd"><?php echo isset($info['id'])?'编辑':'新增';?>自定义属性</div>
        <div class="tw-list-wrap tw-edit-wrap">
            <form action="/index.php/Admin/CustomAttribute/edit/id/20" method="post" class="form-horizontal ajaxForm">
                <div class="form-item">
                    <label class="item-label">自定义属性名称<span class="check-tips"><b>*</b>（请输入自定义属性名称）</span></label>
                    <div class="controls">
                        <input type="text" class="text input-large" name="attr_name" value="<?php echo ($info["attr_name"]); ?>">
                    </div>
                </div>
                <div class="form-item">
                    <label class="item-label">属性类型<span class="check-tips"><b>*</b>（请选择属性类型）</span></label>
                    <div class="controls">
                        <select name="attr_type" id="attr_type_id" onchange="show_value(this.value)">
                            <option value="0">文本</option>
                            <option value="1">数字</option>
                            <option value="2">枚举</option>
                        </select>
                        <script>
                            $('#attr_type_id').val("<?php echo ((isset($info["attr_type"]) && ($info["attr_type"] !== ""))?($info["attr_type"]):0); ?>");
                        </script>
                    </div>
                </div>
                
                <div class="form-item" id="showValue" style="display:none;">
                    <label class="item-label">属性值<span class="check-tips"><b>*</b>（属性值必须填写,【中间用,隔开】）</span></label>
                    <div class="controls">
                        <input type="text" class="text input-large" name="attr_value" value="<?php echo ($info["attr_value"]); ?>" placeholder="自定义属性值1,自定义属性值2">
                    </div>
                </div>
                
                <div class="form-item trainTime">
                    <label class="item-label">属性排序<span class="check-tips">（请输入属性排序）</span></label>
                    <div class="controls">
                        <input type="text" class="text input-large" name="attr_sort" value="<?php echo ($info["attr_sort"]); ?>">
                    </div>
                </div>
                <div class="form-item">
                    <label class="item-label">属性是否必填<span class="check-tips"><b>*</b></span></label>
                    <label class="wf-form-label-rc">
                        <input type="radio" value="1" name="attr_require" id="isRequireTure" checked="checked"> 是
                    </label>
                    <label class="wf-form-label-rc">
                        <input type="radio" value="0" name="attr_require" id="isRequireFalse"> 否
                    </label>
                    <?php if($info['attr_require'] == 0): ?><script>
                            $('#isRequireFalse').attr('checked', 'checked');
                        </script><?php endif; ?>
                </div>
                <div class="form-item">
                    <label class="item-label">属性所属模式<span class="check-tips"><b>*</b></span></label>
                    <label class="wf-form-label-rc">
                        <input type="radio" value="2" name="attr_mode" id="modeAll" checked="checked"> 所有
                    </label>
                    <label class="wf-form-label-rc">
                        <input type="radio" value="1" name="attr_mode" id="modeAdmin"> 管理员
                    </label>
                    <label class="wf-form-label-rc">
                        <input type="radio" value="0" name="attr_mode" id="modeMeber"> 商户
                    </label>
                    <?php if($info['attr_mode'] == 1): ?><script>
                            $('#modeAdmin').attr('checked', 'checked');
                        </script>
                    <?php elseif($info['attr_mode'] == 0): ?>
                        <script>
                            $('#modeMeber').attr('checked', 'checked');
                        </script><?php endif; ?>
                </div>
                <div class="form-item">
                    <label class="item-label">属性控件格式<span class="check-tips"><b>*</b></span></label>
                    <label class="wf-form-label-rc">
                        <input type="radio" value="0" name="arrt_control" id="controlNull" checked="checked"> 无
                    </label>
                    <label class="wf-form-label-rc">
                        <input type="radio" value="1" name="arrt_control" id="controlTime"> 时间
                    </label>
                    <label class="wf-form-label-rc">
                        <input type="radio" value="2" name="arrt_control" id="controlEmaill"> 邮箱
                    </label>
                    <?php if($info['arrt_control'] == 1): ?><script>
                            $('#controlTime').attr('checked', 'checked');
                        </script>
                    <?php elseif($info['arrt_control'] == 2): ?>
                        <script>
                            $('#controlEmaill').attr('checked', 'checked');
                        </script><?php endif; ?>
                </div>
                <div class="form-item">
                    <label class="item-label">属性后台是否可操作<span class="check-tips"><b>*</b></span></label>
                    <label class="wf-form-label-rc">
                        <input type="radio" value="1" name="is_edit" id="isEditTure" checked="checked"> 是
                    </label>
                    <label class="wf-form-label-rc">
                        <input type="radio" value="0" name="is_edit" id="isEditFalse"> 否
                    </label>
                    <?php if($info['is_edit'] == 0): ?><script>
                            $('#isEditFalse').attr('checked', 'checked');
                        </script><?php endif; ?>
                </div>
                <div class="form-item">
                    <label class="item-label">属性状态<span class="check-tips"><b>*</b></span></label>
                    <label class="wf-form-label-rc">
                        <input type="radio" value="0" name="attr_status" id="isTypeTure" checked="checked"> 可用
                    </label>
                    <label class="wf-form-label-rc">
                        <input type="radio" value="1" name="attr_status" id="isTypeFalse"> 禁用
                    </label>
                    <?php if($info['attr_status'] == 1): ?><script>
                            $('#isTypeFalse').attr('checked', 'checked');
                        </script><?php endif; ?>
                </div>
                <div class="tw-tool-bar-bot">
                    <button type="submit" class="tw-act-btn-confirm">提交</button>
                    <button type="button" onclick="goback()" class="tw-act-btn-cancel">返回</button>
                </div>
                    <input type="hidden" name="id" value="<?php echo ((isset($info["id"]) && ($info["id"] !== ""))?($info["id"]):''); ?>"/>
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
    
    <script>
        
        // 刚进入页面的时候判断属性值是否显示
        $(function(){
            if ("<?php echo ($info['attr_type']); ?>" === "2") {
                $("#showValue").show();
            }     
        });  
        
        // js设置属性值是否显示
        function show_value(type){
            if (type == 2) {
                $("#showValue").show();                
            } else {
                $("#showValue").hide(); 
            }
        }

    </script>

</body>
</html>