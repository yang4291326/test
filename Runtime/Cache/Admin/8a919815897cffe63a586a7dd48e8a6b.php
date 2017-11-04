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
            收藏夹客户信息修改
        </div>

        <?php if(is_array($favoritedata)): $i = 0; $__LIST__ = $favoritedata;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?><div class="tw-list-wrap tw-edit-wrap">
            <!--<?php echo U('Admin/Favorite/edit');?>-->
            <form action="/index.php/Admin/Favorite/edit/id/139" enctype="application/x-www-form-urlencoded" method="POST" class="form-horizontal ">
                <div class="form-item">
                    <label for="auth-title" class="item-label">收藏夹名称<span class="check-tips"><b>*</b></span></label>
                    <div class="controls">
                        <input type="text" name="favorite_name" class="text input-large" value="<?php echo ($v['name']); ?>" />
                    </div>
                </div>

                <div class="form-item">
                    <label for="auth-title" class="item-label">客户名称<span class="check-tips"><b>*</b></span></label>
                    <div class="controls">
                        <input type="text" name="customer_name" class="text input-large" placeholder="请输入属性名称" value="<?php echo ($v['customer_name']); ?>"/>
                    </div>
                </div>
                <div class="form-item">
                    <label for="auth-title" class="item-label">客户电话<span class="check-tips"><b>*</b></span></label>
                    <div class="controls">
                        <input type="text" name="customer_phone" class="text input-large" placeholder="请输入属性名称" value="<?php echo ($v['customer_phone']); ?>"/>
                    </div>
                </div>
                <div class="form-item">
                    <label for="auth-title" class="item-label">客户地址<span class="check-tips"><b>*</b></span></label>
                    <div class="controls">
                        <input type="text" name="customer_address" class="text input-large" placeholder="请输入属性名称" value="<?php echo ($v['customer_address']); ?>"/>
                    </div>
                </div>
                <div class="form-item">
                    <label for="auth-title" class="item-label">客户押金<span class="check-tips"><b>*</b></span></label>
                    <div class="controls">
                        <input type="text" name="customer_deposit" class="text input-large" placeholder="请输入属性名称" value="<?php echo ($v['customer_deposit']); ?>"/>
                    </div>
                </div>
                <div class="form-item">
                    <label for="auth-title" class="item-label">客户订单随机编码<span class="check-tips"><b>*</b></span></label>
                    <div class="controls">
                        <input type="text" name="customer_code" class="text input-large" placeholder="请输入属性名称" value="<?php echo ($v['customer_code']); ?>"/>
                    </div>
                </div>

                <div class="tw-tool-bar-bot">
                    <input type="hidden" name="id" value="<?php echo ($v['id']); ?>" />
                    <button type="submit" class="tw-act-btn-confirm">提交</button>
                    <button type="button" onclick="goback()" class="tw-act-btn-cancel">返回</button>
                </div><?php endforeach; endif; else: echo "" ;endif; ?>
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

    </script>

</body>
</html>