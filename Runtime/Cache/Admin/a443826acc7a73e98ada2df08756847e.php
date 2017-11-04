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
    
	<link rel="stylesheet" type="text/css" href="/Application/Admin/Static/css/multiple-select.css" media="all">

</head>
<body>
    
    <!-- 内容区 -->
    <div id="content">
        
    <div class="tw-layout">
    	<div class="tw-list-hd">
            <?php echo isset($info['id'])?'编辑':'新增';?>升级信息
        </div>
	    <div class="tw-list-wrap tw-edit-wrap">
            <form action="/index.php/Admin/Upgrade/edit/id/7" method="post" class="form-horizontal ajaxForm">
                <div class="form-item">
                    <label class="item-label">升级名称<span class="check-tips"><b>*</b>（输入升级名称）</span></label>
                    <div class="controls">
                        <input type="text" class="text input-large" name="name" value="<?php echo ($info["name"]); ?>">
                    </div>
                </div>
                <div class="form-item">
                    <label class="item-label">升级版本<span class="check-tips"><b>*</b>（输入升级版本）</span></label>
                    <div class="controls">
                        <input type="text" class="text input-large" name="version" value="<?php echo ($info["version"]); ?>">
                    </div>
                </div>
                <!--杨yongjie  添加-->
                <div class="form-item">
                    <label class="item-label">手机/平板<span class="check-tips"><b>*</b>（请选择升级终端)</span></label>
                    <div class="controls">
                        <select style="height:30px;width:150px" type="text" class="text input-large" name="type">
                                <option value="2"  <?php if($info["type"] == 2): ?>selected="selected"<?php endif; ?> >手机端
                                </option>
                                <option value="1"  <?php if($info["type"] == 1): ?>selected="selected"<?php endif; ?> >平板端
                                </option>
                        </select>

                    </div>
                </div>
                <!--杨yongjie  添加-->
                <div class="form-item">
                    <label class="item-label">升级方式<span class="check-tips"><b>*</b>（选择升级方式）</span></label>
                    <div class="controls">
                        <input type="radio" value="0" name="mode" id="isPage"  > 下载页
                        <input type="radio" value="1" name="mode" id="isClick" checked="checked"> 点击提示
                        <?php if($info['mode'] == 0): ?><script>
                                $('#isPage').attr('checked', 'checked');
                            </script><?php endif; ?>
                    </div>
                </div>
				<div>
                    <label class="item-label">升级用户<span class="check-tips"><b>*</b>（选择升级用户）</span></label>
					<select id="user_name" name="user_name" multiple="multiple">
						<?php if(is_array($userName)): $i = 0; $__LIST__ = $userName;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo["id"]); ?>">
								<?php echo ($vo["user_name"]); ?>
							</option><?php endforeach; endif; else: echo "" ;endif; ?>
					</select>
					<input type="hidden" name="memberRole" id="memberRole">
				</div>
				<div class="form-item">
                    <label class="item-label">上传升级包<span class="check-tips">（用于上传升级包 ）</span></label>
                    <div class="controls">
                        <div id="img1_">
                            <?php echo ($info["file_path"]); ?>
                        </div>
                        <input type="hidden" value="<?php echo ($info["file_path"]); ?>" name="file_path" id="enclosure" />
                        <input class="btn btn-default btn-xs" type="button" value="上传" id="btnUpload1"/>
                        <input class="btn btn-danger btn-xs" type="button" value="删除" onclick="delFileField($('#enclosure').val(), '')" id="btn_delete1_" />
                        <?php if($info["file_path"] == ''): ?><script>
                                $("#img1_, #btn_delete1_").hide();
                            </script><?php endif; ?>
                    </div>
                </div>
                <div class="form-item">
                    <label class="item-label">升级详情<span class="check-tips">（输入升级详情）</span></label>
                    <div class="controls">
                        <textarea name="remark" rows="5" cols="57"><?php echo ($info["remark"]); ?></textarea><br/>
                    </div>
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
    
    <script type="text/javascript" charset="utf-8" src="/Public/ajaxupload.js"></script>
    <script type="text/javascript" charset="utf-8" src="/Application/Admin/Static/js/admin.js"></script>
	<script type="text/javascript" src="/Application/Admin/Static/js/multiple-select.js"></script>
    <script>
        $(function(){
            ajaxUploadField('#btnUpload1', $("#enclosure"), 'Upgrade', '');
            //设置升级用户选中
            $("#user_name").multipleSelect("setSelects", <?php echo ($member_ids); ?>);
            var ids = $("#user_name").multipleSelect("getSelects");
            $('#memberRole').val(ids);
        });
		$('#user_name').multipleSelect({
			placeholder: "请选择升级用户",
			width: '600px',
			onCheckAll: function() {
				var ids = $("#user_name").multipleSelect("getSelects");
				$('#memberRole').val(ids);
			},
			onUncheckAll: function() {
				var ids = $("#user_name").multipleSelect("getSelects");
				$('#memberRole').val(ids);
			},
			onOptgroupClick: function(view) {
				var ids = $("#user_name").multipleSelect("getSelects");
				$('#memberRole').val(ids);
			},
			onClick: function(view) {
				var ids = $("#user_name").multipleSelect("getSelects");
				$('#memberRole').val(ids);
			}
		});
    </script>

</body>
</html>