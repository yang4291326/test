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
        <!-- S=文章管理 -->
        <div class="tw-list-hd">互相引流管理</div>
        <?php if(!empty($prompt_tips)): ?><div class="tw_list_tips">
                <div class="tips-name">提示语：</div>
                <div class="tips-content"><?php echo ($prompt_tips); ?></div>
            </div><?php endif; ?>
        <!-- E=文章管理 -->
        <!-- S=导航设置 -->
        <div class="tw-list-top">
            <!-- S=添加删除 -->
            <div class="tw-tool-bar">
                <a class="tw-tool-btn-add" href="<?php echo U('edit');?>">
                    <i class="tw-icon-plus-circle"></i> 添加
                </a>
                <a class="tw-tool-btn-del" onclick="javascript:recycle('chkbId', '确认删除?! 删除后此商家将不在此地显示!', true)">
                    <i class="tw-icon-minus-circle"></i> 批量删除
                </a>

            </div>
            <!-- E=添加删除 -->
            <!-- S=高级搜索 -->
            <form action="/index.php/Admin/AllianceMerchant/index" method="post" id='frmSearch'>
                <div class="tw-search-bar">
                    <div class="search-form fr cf">
                        <div class="sleft">
                            <input type="text" name="name" class="search-input" value="<?php echo I('name');?>" placeholder="请输入商家名称">
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
                    <th class="row-selected">
                        <input class="checkbox check-all" type="checkbox">
                    </th>
                    <th width="50">序号</th>
                    <th width="10%">商家名称</th>
                    <th width="15%">商家地址</th>
                    <th width="100">商家电话</th>
                    <th width="100">操作人</th>
                    <th class="show-time">操作时间</th>
                    <th width="200">操作</th>
                </tr>
                </thead>
                <!-- S=详细信息 -->
                <tbody>
                <?php if(!empty($data)): if(is_array($data)): $k = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($k % 2 );++$k;?><tr>
                            <td><input class="ids row-selected" type="checkbox" name="chkbId" value="<?php echo ($vo["id"]); ?>"></td>
                            <td><?php echo (page_code($k)); ?></td>
                            <td class="text-left"><?php echo ($vo["name"]); ?></td>
                            <td class="text-left"><?php echo ($vo["address"]); ?></td>
                            <td><?php echo ($vo["phone"]); ?></td>
                            <td><?php echo ($vo["user_name"]); ?></td>
                            <td><?php echo (time_format($vo["add_time"])); ?></td>
                            <td>
                                <a class="tw-tool-btn-edit" href="<?php echo U('edit?id='.$vo['id']);?>"><i class="tw-icon-pencil"></i> 修改 </a>
                                <a class="tw-tool-btn-del" onclick="javascript:recycle(<?php echo ($vo['id']); ?>, '确认删除?! 删除后此商家将不在此地显示!',true)"><i class="tw-icon-minus-circle"></i> 删除</a>
                            </td>
                        </tr><?php endforeach; endif; else: echo "" ;endif; ?>
                    <?php else: ?>
                    <td colspan="8" class="text-center"> aOh! 暂时还没有内容! </td><?php endif; ?>
                </tbody>
                <!-- E=详细信息 -->
            </table>
        </form>
        <!-- E=表单 -->
        <div class="page"><?php echo ($page); ?></div>
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

    </script>

</body>
</html>