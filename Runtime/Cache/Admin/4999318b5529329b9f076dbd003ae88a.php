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
            升级用户
        </div>
        <form action="/index.php/Admin/Upgrade/member" method="get" id='frmSearch'>
            <div class="tw-search-bar">
                <div class="search-form fr cf">
                    <div class="sleft">
                        <input type='hidden' name="upgrade_id" value="<?php echo ($upgrade_id); ?>">
                        <input type="text" name="user_name" class="search-input" value="<?php echo I('user_name', '');?>" placeholder="请输入用户名">
                        <a type="submit" class="sch-btn" onclick="$('#frmSearch').submit();"><i class="btn-search"></i></a>
                    </div>
                </div>
            </div>
        </form>
        <div class="tw-list-wrap">
            <table class="tw-table tw-table-list tw-table-fixed">
                <colgroup>
                    <col width="100">
                    <col width="15%">
                    <col width="15%">
                    <col width="100">
                </colgroup>
                <thead>
                <tr>
                    <th>ID</th>
                    <th>升级用户</th>
                    <th>升级时间</th>
                    <th>升级状态</th>
                </tr>
                </thead>
                <tbody>
                <?php if(!empty($list)): if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
                            <td><?php echo ($vo["id"]); ?></td>
                            <td class="text-left"><?php echo ($vo["user_name"]); ?></td>
                            <td><?php echo (time_format($vo["upgrade_time"])); ?></td>
                            <td><?php echo (show_upgradedetail_status($vo["status"])); ?></td>
                        </tr><?php endforeach; endif; else: echo "" ;endif; ?>
                    <?php else: ?>
                    <td colspan="4" class="text-center"> aOh! 暂时还没有升级用户! </td><?php endif; ?>
                </tbody>
            </table>
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

    </script>

</body>
</html>