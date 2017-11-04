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
        <div class="tw-list-hd">收藏夹详细商品展示</div>
            <div class="tw-list-top">
                <div class="tw-tool-bar">

                </div>
                <form action="/index.php/Admin/Favorite/showfavoritedetail" method="get" id='frmSearch'>
                    <div class="tw-search-bar">
                        <div class="search-form fr cf">
                            <div class="sleft">
                                <input type='hidden' name="id" value="<?php echo ($id); ?>">
                                <input type="text" name="keywords" class="search-input" value="<?php echo I('keywords', '');?>" placeholder="请输入商品名">
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
                        <th width="50">ID</th>
                        <th width="10%">商品名</th>
                        <th width="5%">风格</th>
                        <th width="5%">尺寸</th>
                        <th width="5%">材料</th>
                        <th width="5%">颜色</th>
                        <!--*杨yongjie  添加*-->
                        <th width="5%">现价</th>
                        <th width="5%">数量</th>
                        <!--*杨yongjie  添加*-->
                        <th class="show-time">添加时间</th>
                        <th width="50">喜好等级</th>
                        <th width="30%">商品确认单号</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(!empty($data)): if(is_array($data)): $i = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
                                <td><input class="ids row-selected" type="checkbox" name="chkbId" value="<?php echo ($vo["id"]); ?>"></td>
                                <td><?php echo ($vo["id"]); ?></td>
                                <td><?php echo ($vo["attr_value"]); ?></td>
                                <td><?php echo ($vo["style"]); ?> </td>
                                <td><?php echo ($vo["size"]); ?> </td>
                                <td><?php echo ($vo["material"]); ?> </td>
                                <td><?php echo ($vo["colour"]); ?> </td>
                                <!--*杨yongjie  添加*-->
                                <td><?php echo ($vo["price"]); ?> </td>
                                <td><?php echo ($vo["goods_count"]); ?> </td>
                                <!--*杨yongjie  添加*-->
                                <td><?php echo (time_format($vo["add_time"])); ?> </td>
                                <td><?php echo (show_favorite_like_level($vo["like_level"])); ?> </td>
                                <td><?php echo ($vo["cart_sn"]); ?> </td>
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