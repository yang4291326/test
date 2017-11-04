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
        
<style>
.bd{
	margin-left: 40px;
}
.divsion{
	margin-left: 30px;
}
.tab-wrap{
	margin-bottom: 60px;
}
</style>

    <div class="tw-layout">
        <div class="tw-list-hd">用户日志授权</div>
        <div class="tw-list-wrap tw-edit-wrap">
            <div class="tab-wrap">
                <div class="tab-content">
                    <!-- 访问授权 -->
                    <div class="tab-pane in">
                        <form action="<?php echo U('HomeLogModularAccess/logAuth');?>" enctype="application/x-www-form-urlencoded" method="POST" class="form-horizontal auth-form ajaxForm">
                            <?php if(is_array($nodeTreeList)): $i = 0; $__LIST__ = $nodeTreeList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$node): $mod = ($i % 2 );++$i;?><dl class="checkmod">
                                    <dt class="hd">
                                        <label class="checkbox"><input class="auth_rules rules_all" type="checkbox" name="rules[]" value="<?php echo ($node["id"]); ?>"><?php echo ($node["name"]); ?></label>
                                    </dt>
                                    <dd class="bd">
                                        <?php if(isset($node['child'])): if(is_array($node['child'])): $i = 0; $__LIST__ = $node['child'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$child): $mod = ($i % 2 );++$i;?><div class="rule_check">
                                                    <div>
                                                        <label class="checkbox" <?php if(!empty($child['tip'])): ?>title='<?php echo ($child["name"]); ?>'<?php endif; ?>>
                                                            <input class="auth_rules rules_row" type="checkbox" name="rules[]" value="<?php echo ($child["id"]); ?>"/><?php echo ($child["name"]); ?>
                                                        </label>
                                                    </div>
                                                   <?php if(!empty($child['operator'])): ?><span class="divsion">&nbsp;</span>
                                                       <span class="child_row">
                                                           <?php if(is_array($child['operator'])): $i = 0; $__LIST__ = $child['operator'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$op): $mod = ($i % 2 );++$i;?><label class="checkbox" <?php if(!empty($op['tip'])): ?>title='<?php echo ($op["name"]); ?>'<?php endif; ?>>
                                                                   <input class="auth_rules" type="checkbox" name="rules[]"
                                                                   value="<?php echo ($child["id"]); ?>"/><?php echo ($op["name"]); ?>
                                                               </label><?php endforeach; endif; else: echo "" ;endif; ?>
                                                       </span><?php endif; ?>
                                                </div><?php endforeach; endif; else: echo "" ;endif; endif; ?>
                                    </dd>
                                </dl><?php endforeach; endif; else: echo "" ;endif; ?>
                            <input type="hidden" name="member_id" value="<?php echo ($member_id); ?>" />
                            <div class="tw-tool-bar-bot">
                                <button type="submit" class="tw-act-btn-confirm">提交</button>
                                <button type="button" onclick="goback()" class="tw-act-btn-cancel">返回</button>
                            </div>
                        </form>
                    </div>
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
    
    <script type="text/javascript" charset="utf-8">
        +function($){
            var rules = [<?php echo ($this_group); ?>];
            $('.auth_rules').each(function(){
                if( $.inArray( parseInt(this.value,10),rules )>-1 ){
                    $(this).prop('checked',true);
                }
            });

            //全选节点
            $('.rules_all').on('change',function(){
                $(this).closest('dl').find('dd').find('input').prop('checked',this.checked);
            });

            $('.rules_row').on('change',function(){
                $(this).closest('.rule_check').find('.child_row').find('input').prop('checked',this.checked);
            });
        }(jQuery);
    </script>

</body>
</html>