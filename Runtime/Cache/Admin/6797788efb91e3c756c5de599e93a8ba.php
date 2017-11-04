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
        <div class="tw-list-hd"> <?php echo isset($info['id'])?'编辑':'新增';?>皮肤 </div>
        <div class="tw-list-wrap tw-edit-wrap">
            <form action="/index.php/Admin/Skin/edit" method="post" class="form-horizontal ajaxForm">
                <div class="form-item">
                    <label class="item-label">皮肤名称<span class="check-tips"><b>*</b>（输入皮肤名称）</span></label>
                    <div class="controls">
                        <input type="text" class="text input-large" name="name" value="<?php echo ($info["name"]); ?>">
                    </div>
                </div>
                <div class="form-item">
                    <label class="item-label">可使用商家<span class="check-tips"><b>*</b>（选择可使用商家）</span></label>
                    <div class="controls"> 
                        <input type="hidden" id="operate_person_id" name="member_ids" value="<?php echo ($info["member_ids"]); ?>">
                        <textarea rows="5" cols="57" onclick="selectUser('operate_person', '<?php echo ($info["member_ids"]); ?>')" readonly id="operate_person_name"><?php echo ($operatePerson); ?></textarea><br/>
                    </div>
                </div>
                <div class="form-item">
                    <label class="item-label">排序<span class="check-tips"></label>
                    <div class="controls">
                        <input type="text" class="text input-large" name="sort" value="<?php echo ($info["sort"]); ?>">
                    </div>
                </div>
                <div class="form-item">
                    <label class="item-label">上传皮肤图标<span class="check-tips"><b>*</b>（用于上传皮肤图标 请上传大于400*400的正方形图片）</span></label>
                    <div class="controls">
                        <div>
                            <img src="<?php echo ($info["photo_path"]); ?>" style="height:129px; width:129px;" id="img_"/>
                        </div>
                        <input type="hidden" value="<?php echo ($info["photo_path"]); ?>" name="photo_path" id="img" />
                            <input class="btn btn-default btn-xs" type="button" value="上传" id="btnUpload"/>
                            <input class="btn btn-danger btn-xs" type="button" value="删除" onclick="delImg($('#img').val(), '')" id="btn_delete_" />
                            <?php if($info["photo_path"] == ''): ?><script>
                                    $("#img_, #btn_delete_").hide();
                                </script><?php endif; ?>
                    </div>
                </div>
                <div class="form-item">
                    <label class="item-label">上传附件<span class="check-tips"><b>*</b>（附件格式：ZIP）</span></label>
                    <div class="controls">
                        <div>
                            <div style="height:20px; width:100px;" id="img_file_">已经上传</div>
                        </div>
                        <input type="hidden" value="<?php echo ($info["file_path"]); ?>" name="file_path" id="enclosure" />
                        <input class="btn btn-default btn-xs" type="button" value="上传" id="btnFileUpload"/>
                        <input class="btn btn-danger btn-xs" type="button" value="删除" onclick="delFileField($('#enclosure').val(), '')" id="btn_file_delete_" />
                        <?php if($info["file_path"] == ''): ?><script>
                                $("#img_file_, #btn_file_delete_").hide();
                            </script><?php endif; ?>
                    </div>
                </div>
                <div class="form-item">
                    <label class="item-label">是否启用<span class="check-tips"><b>*</b></span></label>
                    <label class="wf-form-label-rc">
                        <input type="radio" value="0" name="disabled" id="isTure" checked="checked"> 是
                    </label>
                    <label class="wf-form-label-rc">
                        <input type="radio" value="1" name="disabled" id="isFalse"> 否
                    </label>
                    <?php if($info['attr_require'] == 1): ?><script>
                            $('#isFalse').attr('checked', 'checked');
                        </script><?php endif; ?>
                </div>
                
                <div class="tw-tool-bar-bot">
                    <button type="submit" class="tw-act-btn-confirm">提交</button>
                    <button type="button" onclick="goback()" class="tw-act-btn-cancel">返回</button>
                </div>
                <input type="hidden" name="id" value="<?php echo ((isset($info["id"]) && ($info["id"] !== ""))?($info["id"]):''); ?>"/>
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
    <script type="text/javascript" charset="utf-8" src="/Application/Common/Static/js/imgupload.js"></script>
    <script type="text/javascript" charset="utf-8" src="/Application/Admin/Static/js/admin.js"></script>
    <script type="text/javascript" charset="utf-8" src="/Application/Admin/Static/js/skin/skin.js"></script>
    <script>
        $(function(){
            ajaxUpload('#btnUpload', $("#img"), 'skinImg', '');
            ajaxSkinUploadField('#btnFileUpload', $("#enclosure"), 'skin', '');
        })
        
        // 调出选择商户的界面
        function selectUser(type, ids){
            layer.open({
            	type: 2,
            	title: '选择可操作的商家',
            	shadeClose: true,
            	shade: 0.8,
            	area: ['800px', '500px'],
            	content:"<?php echo U('ajaxGetMember/selectPerson', '', '');?>/type/"+type+"/ids/"+ids
            });
        }
        // 父页面接受子页面传过来的数据
        function addOperatePerson(show_member, show_id){
            if (show_member[0]) {
                var show_member_string = show_member.join(",")+',';
            }else{
                var show_member_string = '';
            };  
            $("#operate_person_id").val("");
            $("#operate_person_name").html("");
            $("#operate_person_id").val(show_id);
            $("#operate_person_name").append(show_member_string);
        }
    </script>

</body>
</html>