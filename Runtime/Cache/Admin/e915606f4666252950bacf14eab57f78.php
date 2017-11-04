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
			网站设置 
		</div>
	<?php if(!empty($prompt_tips)): ?><div class="tw_list_tips">
			<div class="tips-name">提示语：</div>
			<div class="tips-content"><?php echo ($prompt_tips); ?></div>
		</div><?php endif; ?>
		<div class="tw-list-wrap tw-edit-wrap">
	        <div class="tab-wrap">
					<ul class="tab-nav nav">
						<?php if(is_array(C("CONFIG_GROUP_LIST"))): $i = 0; $__LIST__ = C("CONFIG_GROUP_LIST");if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$group): $mod = ($i % 2 );++$i;?><li <?php if(($id) == $key): ?>class="current"<?php endif; ?>><a href="<?php echo U('?id='.$key);?>"><?php echo ($group); ?>配置</a></li><?php endforeach; endif; else: echo "" ;endif; ?>
					</ul>
					<div class="tab-content">
						<form action="<?php echo U('save');?>" method="post" class="form-horizontal ajaxForm">
							<?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$config): $mod = ($i % 2 );++$i;?><div class="form-item">
									<label class="item-label"><?php echo ($config["title"]); ?><span class="check-tips">（<?php echo ($config["remark"]); ?>）</span> </label>
									<div class="controls">
									<?php switch($config["type"]): case "0": if($config["name"] == 'USER_ADMINISTRATOR'): ?><input type="text" class="text input-small" name="config[<?php echo ($config["name"]); ?>]" value="<?php echo ($config["value"]); ?>" readonly>
										<?php else: ?>
											<input type="text" class="text input-small" name="config[<?php echo ($config["name"]); ?>]" value="<?php echo ($config["value"]); ?>"><?php endif; break;?>
									<?php case "1": ?><input type="text" class="text input-large" name="config[<?php echo ($config["name"]); ?>]" value="<?php echo ($config["value"]); ?>"><?php break;?>
									<?php case "2": ?><label class="textarea input-large">
										<textarea name="config[<?php echo ($config["name"]); ?>]"><?php echo ($config["value"]); ?></textarea>
									</label><?php break;?>
									<?php case "3": ?><label class="textarea input-large">
										<textarea name="config[<?php echo ($config["name"]); ?>]"><?php echo ($config["value"]); ?></textarea>
									</label><?php break;?>
									<?php case "4": ?><select name="config[<?php echo ($config["name"]); ?>]">
										<?php $_result=parse_config_attr($config['extra']);if(is_array($_result)): $i = 0; $__LIST__ = $_result;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($key); ?>" <?php if(($config["value"]) == $key): ?>selected<?php endif; ?>><?php echo ($vo); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
									</select><?php break; endswitch;?>
										
									</div>
								</div><?php endforeach; endif; else: echo "" ;endif; ?>
							<div class="form-item">
								<label class="item-label"></label>
								<div class="controls">
								  <div class="tw-tool-bar-bot">
					                <button type="submit" class="tw-act-btn-confirm">提交</button>
					            </div>
									<!-- <?php if(empty($list)): ?><button type="submit" disabled class="btn submit-btn disabled" target-form="form-horizontal">确 定</button><?php else: ?><button type="submit" class="btn submit-btn ajax-post" target-form="form-horizontal">确 定</button><?php endif; ?>
									
									<button class="btn btn-return" onclick="javascript:history.back(-1);return false;">返 回</button> -->
								</div>
							</div>
						</form>
					</div>
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
    


</body>
</html>