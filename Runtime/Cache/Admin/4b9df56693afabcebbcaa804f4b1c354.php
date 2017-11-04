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
        <div class="tw-list-hd"> 收藏夹列表 </div>
        <?php if(!empty($prompt_tips)): ?><div class="tw_list_tips">
                <div class="tips-name">提示语：</div>
                <div class="tips-content"><?php echo ($prompt_tips); ?></div>
            </div><?php endif; ?>
            <div class="tw-list-top">
                <div class="tw-tool-bar">      
                    <a class="tw-tool-btn-del" onclick="javascript:recycle('chkbId', '确认删除?!')"> <i class="tw-icon-minus-circle"></i> 批量删除 </a>
                </div>
                <form action="/index.php/Admin/Favorite/index" method="post" id='frmSearch'>
                    <div class="tw-search-bar">
                        <div class="search-form fr cf">
                            <div class="sleft">
                                <input type='hidden' name="type" value="<?php echo ($type); ?>">
                                <input type="text" name="keywords" class="search-input" value="<?php echo I('keywords', '');?>" placeholder="请输入收藏夹名">
                                <a type="submit" class="sch-btn" onclick="$('#frmSearch').submit();"><i class="btn-search"></i></a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="tw-list-wrap">
            <table class="tw-table tw-table-list tw-table-fixed">
                <thead>
                    <tr>
                        <th width="10" class="row-selected"><input class="checkbox check-all" type="checkbox"></th>
                        <th width="50">序号</th>
                        <th width="15%">收藏夹名称</th>
                        <th width="50%">内容概述</th>
                        <th width="15%">操作时间</th>
                        <th width="15%">所属用户</th>
                        <th width="15%">客户名称</th>
                        <th width="15%">客户电话</th>
                        <th width="15%">客户地址</th>
                        <th width="15%">客户押金</th>
                        <!--*杨yongjie  添加*-->
                        <th width="15%">总计金额</th>
                        <!--*杨yongjie  添加*-->
                        <th width="15%">客户订单随机编码</th>
                        <th width="210">操作</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(!empty($data)): if(is_array($data)): $k = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($k % 2 );++$k;?><tr>
                                <td><input class="ids row-selected" type="checkbox" name="chkbId" value="<?php echo ($vo["id"]); ?>"></td>
                                <td><?php echo (page_code($k)); ?></td>
                                <td><?php echo ($vo["name"]); ?> </td>
                                <td><?php echo ($vo["remark"]); ?> </td>
                                <td><?php echo (time_format($vo["add_time"])); ?> </td>
                                <td><?php echo ($vo["member_name"]); ?></td>
                                <td><?php echo ($vo["customer_name"]); ?></td>
                                <td><?php echo ($vo["customer_phone"]); ?></td>
                                <td><?php echo ($vo["customer_address"]); ?></td>
                                <td><?php echo ($vo["customer_deposit"]); ?></td>
                                <!--*杨yongjie  添加*-->
                                <td><?php echo ($vo["price_total"]); ?></td>
                                <!--*杨yongjie  添加*-->
                                <td><?php echo ($vo["customer_code"]); ?></td>
                                <td>
                                    <a class="tw-tool-btn-view" href="<?php echo U('Favorite/showFavoriteDetail?id='.$vo['id']);?>"> <i class="tw-icon-desktop"></i> 查看 </a>
                                    <a class="tw-tool-btn-view" href="<?php echo U('Favorite/edit?id='.$vo['id']);?>"> <i class="tw-icon-edit"></i> 修改 </a>
                                    <a class="tw-tool-btn-del" onclick="javascript:recycle(<?php echo ($vo['id']); ?>, '确认删除?!')"><i class="tw-icon-minus-circle"></i> 删除</a>
                                </td>
                            </tr><?php endforeach; endif; else: echo "" ;endif; ?>
                    <?php else: ?>
                        <td colspan="12" class="text-center"> aOh! 暂时还没有内容! </td><?php endif; ?>
                </tbody>
            </table>
            <div class="page"><?php echo ($page['page']); ?></div>
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