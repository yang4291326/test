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
            修改户型
            <!--<a class="tw-tool-btn-add" onclick="addUnit()"><i class="tw-icon-plus-circle"></i> 添加户型 </a>-->
        </div>
        <div class="tw-list-wrap tw-edit-wrap">
            <form action="/index.php/Admin/GoodsCategory/update" enctype="multipart/form-data" method="POST" class="form-horizontal">
                <table border="1" bordercolor="#F5F5F5">
                    <?php if(is_array($res)): $i = 0; $__LIST__ = $res;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?><tr>
                        <td> <input type="hidden" name="<?php echo ($v['id']); ?>[id]"  value="<?php echo ($v['id']); ?>"/></td>
                    </tr>
                    <tr height="50px">
                        <th>户型名称:</th>
                        <td colspan='2'>
                            <input type="text" name="<?php echo ($v['id']); ?>[name]" class="text input-large" placeholder="请输入户型名称" value="<?php echo ($v['name']); ?>"/>
                        </td>
                    </tr>
                    <tr height="50px">
                        <th>户型图标:</th>
                        <td colspan='3'>
                            <input type="text" style="width:550px;" name="<?php echo ($v['id']); ?>[old_layout_photo_path]" class="text input-large" value="<?php echo ($v['layout_photo_path']); ?>" />
                            <input class="btn btn-default btn-xs" type="file" name="<?php echo ($v['id']); ?>[layout_photo_path]" id="btnUpload1" multiple="multiple"/>
                        </td>
                    </tr>
                    <tr height="50px">
                        <th>户型模型:</th>
                        <td colspan='3'>
                            <input type="text" style="width:550px;" name="<?php echo ($v['id']); ?>[old_layout_path]" class="text input-large" value="<?php echo ($v['layout_path']); ?>" />
                            <input class="btn btn-default btn-layout_pathxs" type="file" name="<?php echo ($v['id']); ?>[layout_path]" id="btnUpload2" multiple="multiple"/>

                        </td>
                    </tr>
                    <tr height="50px">
                        <th>户型风格:</th>
                        <td>
                            <input type="text" name="<?php echo ($v['id']); ?>[layout_style]" class="text input-5x" placeholder="请输入户型风格" value="<?php echo ($v['layout_style']); ?>"/>
                        </td>
                        <th>户型场景:</th>
                        <td>
                            <input type="text" name="<?php echo ($v['id']); ?>[layout_scene]" class="text input-5x" placeholder="请输入户型场景" value="<?php echo ($v['layout_scene']); ?>"/>
                        </td>
                    </tr>
                    <tr height="50px">
                        <th>初始位置:</th>
                        <td>
                            <input type="text" name="<?php echo ($v['id']); ?>[initial_position]" class="text input-5x" placeholder="请输入初始位置" value="<?php echo ($v['initial_position']); ?>"/>
                        </td>
                        <th>初始方向:</th>
                        <td>
                            <input type="text" name="<?php echo ($v['id']); ?>[initial_direction]" class="text input-5x" placeholder="请输入初始方向" value="<?php echo ($v['initial_direction']); ?>"/>
                        </td>
                    </tr>
                    <tr height="50px">
                        <th>是否默认:</th>
                        <td colspan='3'>
                            <?php if($v['is_default'] == 1): ?><label class='radio'>
                                    <input type='radio' name="<?php echo ($v['id']); ?>[is_default]" value='1' checked="checked"/>是
                                </label>
                                <label class='radio'>
                                    <input type='radio' name="<?php echo ($v['id']); ?>[is_default]" value='0' />否
                                </label><?php endif; ?>
                            <?php if($v['is_default'] == 0): ?><label class='radio'>
                                    <input type='radio' name="<?php echo ($v['id']); ?>[is_default]" value='1' />是
                                </label>
                                <label class='radio'>
                                    <input type='radio' name="<?php echo ($v['id']); ?>[is_default]" value='0' checked="checked"/>否
                                </label><?php endif; ?>
                        </td>
                        <td>
                            <a class="tw-tool-btn-del" onclick="deleteone(<?php echo ($v['id']); ?>)">
                                <i class="tw-icon-minus-circle"></i> 删除户型
                            </a>
                        </td>
                      </tr><?php endforeach; endif; else: echo "" ;endif; ?>
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
    
    <script type="text/javascript" charset="utf-8">
        function deleteone(id){
            var jump_url="<?php echo U('/Admin/GoodsCategory/update');?>";
            var msg = "确定删除吗?";
            if (confirm(msg)==true){
                var url="<?php echo U('/Admin/GoodsCategory/delete');?>";
                var data={"id":id};
                $.post(url,data,function(res){
                    if(res.status==0){
                        alert('没有权限!');
                    }else if(res.status==1){
                        window.location.href=jump_url;
                    }else if(res.status==-1){
                        alert(res.message);
                    }
                },'json');
            }else{
                return false;
            }
        }
    </script>

</body>
</html>