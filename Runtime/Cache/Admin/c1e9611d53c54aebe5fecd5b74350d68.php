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
        
    <!-- S=详情显示 --> 
    <div class="tw-list-wrap" style="margin-top: 20px;">       

        <form action="/index.php/Admin/Article/getgoodspics" method="get" id='frmSearch'>
            <div class="tw-search-bar">
                <div class="search-form fr cf">
                    <div class="sleft">
                        <input type='hidden' name="type" value="<?php echo ($type); ?>">
                        <input type='hidden' name="imgId" value="<?php echo ($imgId); ?>">
                        <input type="text" name="keywords" class="search-input" value="<?php echo I('keywords', '');?>" placeholder="请输入商品名">
                        <a type="submit" class="sch-btn" onclick="$('#frmSearch').submit();"><i class="btn-search"></i></a>
                    </div>
                </div>
            </div>
        </form>
        <!-- S=表单 -->
        <table class="tw-table tw-table-list tw-table-fixed">
            <thead>
                <tr>
                    <th class="row-selected"></th>
                    <th width="10%">商品ID</th>
                    <th width="15%">商品名称</th>
                    <th width="15%">商品图片</th>
                <tr>
            </thead>
            <!-- S=详细信息 --> 
            <tbody>
                <?php if(!empty($data)): if(is_array($data)): $i = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
                            <td><input class="ids row-selected" onclick="checkboxOnclick($(this).val(), $(this).parent().next().next().html(), $(this).parent().next().next().next().children().val())"  type="radio" name="chkbId" value="<?php echo ($vo["id"]); ?>"></td>
                            <td id="shopId"><?php echo ($vo["id"]); ?></td>
                            <td><?php echo ($vo["attr_value"]); ?></td>
                            <td id="shopImg">
                                <input type="hidden" value="<?php echo ($vo["goods_img"]); ?>">
                                <img src="<?php echo ($vo["goods_img"]); ?>" style="height:100px; width:100px;">
                            </td>
                        </tr><?php endforeach; endif; else: echo "" ;endif; ?>
                    <?php else: ?>
                        <td colspan="4" class="text-center"> aOh! 暂时还没有内容! </td><?php endif; ?>
            </tbody>
            <!-- E=详细信息 -->
        </table>
        <div class="page"><?php echo ($page); ?></div>
    <!-- <div class="tw-tool-bar-bot">
        <button type="button" class="tw-act-btn-cancel">关闭</button>
    </div> -->

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
        $(".tw-act-btn-cancel").click(function(){
            var index = parent.layer.getFrameIndex(window.name); //获取窗口索引
            parent.layer.close(index);
        })
        
        function checkboxOnclick(checkbox, shopName, shopImg){
            var selectedId = <?php echo ($selectedGoodsId); ?>;
            var imgId = "<?php echo ($imgId); ?>";
            if (imgId == -1) { //-1表示选择商品
                $res = selectedId.indexOf(checkbox);
                if($res !== -1){
                    toastr.error('同一商品不能添加两次推荐模版');
                    return false;
                }
            } 
            parent.getGoodsIdAndImg(checkbox, shopName, shopImg, imgId);
        }        
    </script>

</body>
</html>