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
    </style>

</head>
<body>
    
    <!-- 内容区 -->
    <div id="content">
        
	<div class="tw-layout">
		<div class="tw-list-hd">
			商品VR模型
		</div>
    	<div class="tw-list-wrap tw-edit-wrap">
    	    <form action="/index.php/Admin/Goods/vrModel/id/345" method="POST" class="form-horizontal ajaxForm">
    	    	<div style="margin:10px 0 20px;">
                    <span class="fl">商品模型：</span>
                    <span>
                        <span id="img_"/></span>
                        <input type="hidden" name="model_path" id="img" />
                        <input class="btn btn-default btn-xs" type="button" value="资源选择" id="btnUpload"/>
                        <input class="btn btn-danger btn-xs" type="button" value="删除" onclick="delFile($('#img').val(), '')" id="btn_delete_" style="display:none"/>
                    </span>

    	    	</div>
                <!--杨yongjie  添加-->
                <div style="margin:10px 0 20px;">
                    <span class="fl">模型原文件名：</span>
                    <input type='text' name='name' class='text input-large' placeholder='输入上传的模型原文件名'/>
                </div>
                <!--杨yongjie  添加-->
                <div style="margin:10px 0 20px;">
                    <span class="fl">商品缩略图：</span>
                    <span>
                        <span id="img_1"/></span>
                        <input type="hidden" name="ico" id="img1" />
                        <input class="btn btn-default btn-xs" type="button" value="资源选择" id="btnUpload1"/>
                        <input class="btn btn-danger btn-xs" type="button" value="删除" onclick="delFile($('#img1').val(), '')" id="btn_delete_1" style="display:none"/>
                    </span>
                </div>
                <div style="margin:10px 0 20px;">
                    <span class="fl">材质Tiling值：</span>
                    <span>
                        <input type='text' name='material_tiling' class='text input-5x' placeholder='输入材质Tiling值'/>
                    </span>
                </div>
                <div style="margin:10px 0 20px;">
                    <span class="fl">商品描述：</span>
                    <span>
                        <input type='text' name='description' class='text input-5x' placeholder='输入商品描述'/>
                    </span>
                </div>
    	    	<table class="wf-form-table" id="goods-unit-table">
                    <colgroup>
                        <col width="10%">
                        <col width="30%">
                        <col width="10%">
                        <col width="50%">
                    </colgroup>
                    <tbody>
                        <!--<tr>-->
                            <!--<th colspan="4" class="information">-->
                                <!--<div class="fl offset">户型</div>-->
                                <!--<div class="fl ml10">-->
                                    <!--<a class="tw-tool-btn-add" onclick="addUnit()"><i class="tw-icon-plus-circle"></i> 添加户型 </a>-->
                                <!--</div>-->
                            <!--</th>-->
                        <!--</tr>-->
                    </tbody>
                </table>
                <table class="wf-form-table" id="goods-unit-attr-table" style="margin-top:20px">
                    <colgroup>
                        <col width="10%">
                        <col width="90%">
                    </colgroup>
                    <tbody>
                        <tr>
                            <th colspan="2" class="information">
                                <div class="fl offset">商品模型类型</div>
                                <div class="fl ml10">
                                    <a class="tw-tool-btn-add" onclick="addUnitAttr()"><i class="tw-icon-plus-circle"></i> 添加商品模型类型 </a>
                                </div>
                            </th>
                        </tr>
                    </tbody>
                </table>

    	        <div class="tw-tool-bar-bot">
                   <input type="hidden" name="goods_id" value="<?php echo ($goods_id); ?>" />
    	           <button type="submit" class="tw-act-btn-confirm">提交</button>
    	           <button type="button" onclick="goback()" class="tw-act-btn-cancel">返回</button>
    	       </div>
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
        var layout_num = 0;
        var resource_num = 0;
        $(function(){
            ajaxUpload('#btnUpload', $("#img"), 'VRModel', '');
            ajaxUpload('#btnUpload1', $("#img1"), 'VRModel', '1');
            //颜色图片删除
            $('body').on('click', '.del-img-btn', function(){
                var imgId = $(this).attr('del-img-id');
                delFile($('#img'+imgId).val(), imgId, '', false);
            })
        });
	</script>
    <script type="text/javascript" charset="utf-8" src="/Public/ajaxupload.js"></script>
    <script type="text/javascript" charset="utf-8" src="/Application/Admin/Static/js/vrmodel.js"></script>

</body>
</html>