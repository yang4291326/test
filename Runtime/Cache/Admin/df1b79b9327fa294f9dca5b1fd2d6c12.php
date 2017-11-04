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
    
    <style>
        .td-line{
            border-bottom:#EAEAEA 1px dashed;
        }
        .btn-danger , .ml10{
            margin-left:10px;
        }
        .tr1{
            font-size: 18px;

            font-weight: bold;
        }
        table{
            text-align: center;
        }
    </style>

</head>
<body>
    
    <!-- 内容区 -->
    <div id="content">
        
    <div class="tw-layout">
        <div class="tw-list-hd">
            菜单图标配置
        </div>
        <div class="tw-list-wrap tw-edit-wrap">
            <form action="/index.php/Admin/Skin/setVricon" method="POST" enctype="multipart/form-data" class="form-horizontal ">
                <table border="1" bordercolor="#87BDE6">
                    <tr class="tr1">
                        <td>分类名称</td>
                        <td>未点击图标图片</td>
                        <td>点击后图标图片</td>
                        <td>操作</td>
                    </tr>
                    <?php if(is_array($res)): $i = 0; $__LIST__ = $res;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?><tr>
                            <td width="5%">
                                 <?php echo ($v['name']); ?>
                            </td>
                            <td width="300px">
                                <div style="margin:10px 0 20px;">

                                    <span>
                                <img src="<?php echo ($v['pic_path']); ?>" width="80px" height="80px"><br/>
                            </span>
                                </div>
                            </td>
                            <td width="300px">
                                <div style="margin:10px 0 20px;">

                                    <span>
                                <img src="<?php echo ($v['pic_hover_path']); ?>" width="80px" height="80px"><br/>
                            </span>
                                </div>
                            </td>
                            <td width="60%" align="center">
                                <a class="tw-tool-btn-edit" href="#" id="edit<?php echo ($v["id"]); ?>">
                                    <i class="tw-icon-plus-circle"></i> 修改
                                </a>
                                <!--<input type="hidden" name="<?php echo ($v["id"]); ?>" value="<?php echo ($v["id"]); ?>"/>-->
                            </td>
                        </tr><?php endforeach; endif; else: echo "" ;endif; ?>
                </table>
                <div class="tw-tool-bar-bot">
                    <button type="submit" class="tw-act-btn-confirm" id="sub">提交</button>
                    <button type="button" onclick="goback()" class="tw-act-btn-cancel">返回</button>
                </div>

            </form>
        </div>
    </div>
    <!-- <input type='hidden' name='<?php echo ($v["id"]); ?>[<?php echo ($v["id"]); ?>]' value='<?php echo ($v["id"]); ?>'/> -->

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
    <script type="text/javascript" charset="utf-8">
        <?php if(is_array($res)): $i = 0; $__LIST__ = $res;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?>$('#edit<?php echo ($v["id"]); ?>').click(function(){
                var html="<input class='btn btn-default btn-layout_pathxs' type='file' name='<?php echo ($v["id"]); ?>-pic_path[]' multiple='multiple' id='btnUploadw<?php echo ($v["id"]); ?>'/><input class='btn btn-default btn-layout_pathxs' type='file' name='<?php echo ($v["id"]); ?>-pic_hover_path[]' multiple='multiple' id='btnUploadd<?php echo ($v["id"]); ?>'/>";
                $(this).parent().html(html);
            });<?php endforeach; endif; else: echo "" ;endif; ?>
    </script>
    <script type="text/javascript" charset="utf-8" src="/Application/Admin/Static/js/vrmodel.js"></script>

</body>
</html>