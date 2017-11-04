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
        
    <!-- S=头部设置 -->
    <div class="tw-layout">
        <!-- S=皮肤管理 -->
        <div class="tw-list-hd">皮肤管理</div>
        <!-- E=文章管理 -->
        <!-- S=导航设置 -->
        <div class="tw-list-top">
            <!-- S=添加删除 -->
            <div class="tw-tool-bar">
            </div>
            <!-- E=添加删除 -->
            <!-- S=高级搜索 -->
            <form action="/index.php/Admin/Skin/configskin" method="post" id='frmSearch'>
                <div class="tw-search-bar">
                    <div class="search-form fr cf">
                        <div class="sleft">
                            <input type="text" name="keywords" class="search-input" value="<?php echo I('name');?>" placeholder="请输入皮肤名称">
                            <a type="submit" class="sch-btn" onclick="$('#frmSearch').submit();"><i class="btn-search"></i></a>
                        </div>
                    </div>
                </div>
            </form>
            <!-- E=高级搜索 -->
        </div>
        <!-- E=导航设置 -->
    </div>
    <!-- E=头部设置 -->
    <!-- S=详情显示 -->
    <div class="tw-list-wrap">
        <!-- S=表单 -->
        <form class="ids">
            <table class="tw-table tw-table-list tw-table-fixed">
                <thead>
                <tr>
                    <th class="row-selected"><input class="checkbox check-all" type="checkbox"></th>
                    <th width="50">ID</th>
                    <th width="15%">皮肤名称</th>
                    <th width="5%">皮肤图标</th>
                    <th class="show-time">添加时间</th>
                    <th width="50">排序</th>
                    <th width="150">操作</th>
                </tr>
                </thead>
                <!-- S=详细信息 -->
                <tbody>
                <?php if(!empty($data)): if(is_array($data)): $i = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
                            <td><input class="ids row-selected" type="checkbox" name="chkbId" value="<?php echo ($vo["id"]); ?>"></td>
                            <td><?php echo ($vo["id"]); ?></td>
                            <td class="text-left"><?php echo ($vo["name"]); ?></td>
                            <td><img src="<?php echo ($vo["photo_path"]); ?>" width="50" height="50"></td>
                            <td><?php echo (time_format($vo["add_time"])); ?></td>
                            <td><?php echo ($vo["sort"]); ?></td>
                            <td>
                                <?php if($defaultSkin != $vo['id']): ?><a class="tw-tool-btn-setting" onclick="ajaxChangeDefault(<?php echo ($vo["id"]); ?>)" href="javascript:;"><i class="tw-icon-check-square-o"></i> 设为默认 </a>
                                <?php else: ?>
                                    默认皮肤<?php endif; ?>
                            </td>
                        </tr><?php endforeach; endif; else: echo "" ;endif; ?>
                <?php else: ?>
                    <td colspan="7" class="text-center"> aOh! 暂时还没有内容! </td><?php endif; ?>
                </tbody>
                <!-- E=详细信息 -->
            </table>
        </form>
        <!-- E=表单 -->
        <div class="page"><?php echo ($page['page']); ?></div>
    </div>
    <!-- E=详情显示 -->

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
        // 设置为默认启动页
        function ajaxChangeDefault(id){
            url = "<?php echo U('Admin/Skin/ajaxChangeSkin', '', ''); ?>?id="+ id;
            $.get(url, function(data){
                if(data.status = 1){
                    window.location.reload(); //刷新当前页面
                } 
            });
        }
    </script>

</body>
</html>