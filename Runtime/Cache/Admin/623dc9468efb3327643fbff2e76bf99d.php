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
            添加户型
            <!--<a class="tw-tool-btn-add" onclick="addUnit()"><i class="tw-icon-plus-circle"></i> 添加户型 </a>-->
        </div>
        <div class="tw-list-wrap tw-edit-wrap">
            <form action="/index.php/Admin/GoodsCategory/add" enctype="multipart/form-data" method="POST" class="form-horizontal">
                <table >
                <tr height="50px">
                    <th>户型名称:</th>
                    <td colspan='2'>
                        <input type="text" name="name" class="text input-large" placeholder="请输入户型名称" value=""/>
                    </td>
                </tr>
                <tr height="50px">
                    <th>户型图标:</th>
                    <td colspan='3'>
                        <input class="btn btn-default btn-xs" type="file" name="layout_photo_path" id="btnUpload1" />
                    </td>
                </tr>
                <tr height="50px">
                    <th>户型模型:</th>
                    <td colspan='3'>
                        <input class="btn btn-default btn-layout_pathxs" type="file" name="layout_path" id="btnUpload2"/>
                    </td>
                </tr>
                <tr height="50px">
                    <th>户型风格:</th>
                    <td>
                        <input type="text" name="layout_style" class="text input-5x" placeholder="请输入户型风格" value=""/>
                    </td>
                    <th>户型场景:</th>
                    <td>
                        <input type="text" name="layout_scene" class="text input-5x" placeholder="请输入户型场景" value=""/>
                    </td>
                </tr>
                <tr height="50px">
                    <th>初始位置:</th>
                    <td>
                        <input type="text" name="initial_position" class="text input-5x" placeholder="请输入初始位置" value=""/>
                        <font color="red">(*示例: 0,0,0)</font>
                    </td>
                    <th>初始方向:</th>
                    <td>
                        <input type="text" name="initial_direction" class="text input-5x" placeholder="请输入初始方向" value=""/>
                        <font color="red">(*示例: 0,0,0)</font>
                    </td>
                </tr>
                <tr height="50px">
                    <th>是否默认:</th>
                    <td colspan='3'>
                        <label class='radio'>
                            <input type='radio' name='is_default' value='1' />是
                        </label>
                        <label class='radio'>
                            <input type='radio' name='is_default' value='0' />否
                        </label>
                    </td>
                </tr>
                <div class="tw-tool-bar-bot">
                    <button type="submit" class="tw-act-btn-confirm">提交</button>
                    <button type="button" onclick="goback()" class="tw-act-btn-cancel">返回</button>
                </div>
                </table>
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
    
    <script type="text/javascript" charset="utf-8" src="/Public/ajaxupload.js"></script>
    <script type="text/javascript" charset="utf-8" src="/Application/Admin/Static/js/goodsImgUpload.js"></script>
    <script type="text/javascript" charset="utf-8" src="/Application/Admin/Static/js/vrmodel.js"></script>
    <script type="text/javascript" charset="utf-8">
        $(function(){
        ajaxUpload('#btnUpload', $("#img"), 'VRModel', '');
        ajaxUpload('#btnUpload1', $("#img1"), 'VRModel', 1);
        //颜色图片删除
        $('body').on('click', '.del-img-btn', function(){
        var imgId = $(this).attr('del-img-id');
        delFile($('#img'+imgId).val(), imgId, '', false);
        })
        });
    </script>

</body>
</html>