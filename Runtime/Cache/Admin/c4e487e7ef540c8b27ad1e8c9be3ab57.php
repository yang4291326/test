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
        <div class="tw-list-hd">APP导航栏管理</div>
        <?php if(!empty($promptTips)): ?><div class="tw_list_tips">
                <div class="tips-name">提示语：</div>
                <div class="tips-content"><?php echo ($promptTips); ?></div>
            </div><?php endif; ?>
        <!-- E=文章管理 -->        
        <!-- S=导航设置 -->
        <div class="tw-list-top">
            <!-- S=添加删除 -->
            <div class="tw-tool-bar">
                <a class="tw-tool-btn-add" href="<?php echo U('edit');?>">
                    <i class="tw-icon-plus-circle"></i> 添加
                </a>
                <a class="tw-tool-btn-del" onclick="javascript:recycle('chkbId', '确认删除?! 删除后此文章将不在此地显示!')">
                    <i class="tw-icon-minus-circle"></i> 批量删除
                </a>
            </div>
            <!-- E=添加删除 -->
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
                        <th width="30%">标题</th>
                        <th width="20">状态</th>
                        <th width="20">排序</th>
                        <th width="180">操作时间</th>
                        <th width="180">操作</th>
                    </tr>
                </thead>
                <!-- S=详细信息 -->	
                <tbody>
                    <?php if(!empty($list)): if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
                                <td><input class="ids row-selected" type="checkbox" name="chkbId" value="<?php echo ($vo["id"]); ?>"></td>
                                <td class="text-left"><?php echo ($vo["name"]); ?></td>
                                <td><?php echo show_disabled($vo['disabled']);?></td>
                                <td><?php echo ($vo["sort"]); ?></td>
                                <td><?php echo (time_format($vo["add_time"])); ?></td>
                                <td>
                                    <?php echo change_disabled($vo['id'], $vo['disabled']);?>
                                    
                                    <a class="tw-tool-btn-edit" href="<?php echo U('edit', array('id' => $vo['id']));?>"><i class="tw-icon-pencil"></i> 修改 </a>
                                    <a class="tw-tool-btn-del" onclick="javascript:recycle(<?php echo ($vo['id']); ?>, '确认删除?! 删除后此内容将不在此地显示!')"><i class="tw-icon-minus-circle"></i> 删除</a>
                                </td>                                
                            </tr><?php endforeach; endif; else: echo "" ;endif; ?>
                        <?php else: ?>
                            <td colspan="6" class="text-center"> aOh! 暂时还没有内容! </td><?php endif; ?>
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
    
    <script>
        
    </script>

</body>
</html>