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
    
    <link rel="stylesheet" type="text/css" href="/Application/Admin/Static/css/map/context.standalone.css" media="all">
    <link rel="stylesheet" type="text/css" href="/Application/Admin/Static/css/map/map.css" media="all">

</head>
<body>
    
    <!-- 内容区 -->
    <div id="content">
        
    <div class="tw-layout">
    	<div class="tw-list-hd"><?php echo isset($info['id'])?'编辑':'新增';?>商家导航图</div>
        <div class="tw-list-wrap tw-edit-wrap">
            <form action="/index.php/Admin/Map/edit" method="post" class="form-horizontal ajaxForm">
                <div class="form-item">
                    <label class="item-label">地图标题名称<span class="check-tips"><b>*</b>（输入地图标题）</span></label>
                    <div class="controls"> <input type="text" class="text input-large" name="name" value="<?php echo ($info["name"]); ?>"></div>
                </div>
                <div class="form-item">
                    <label class="item-label">排序</label>
                    <div class="controls">
                        <input type="text" class="text input-large" name="sort" value="<?php echo ($info["sort"]); ?>">
                    </div>
                </div>
                
                <div class="form-item">
                    <label class="item-label">上传地图图片<span class="check-tips"><b>*</b>（请上传地图图片）</span></label>
                    <div class="controls">
                        <div id="toolbar">
                            <input type="hidden" value="<?php echo ($info["photo_path"]); ?>" name="photo_path" id="img" />
                            <input class="btn btn-default btn-xs" type="button" value="上传" id="btnUpload"/>
                            <input class="btn btn-danger btn-xs" type="button" value="删除" onclick="delMapFile($('#img').val(), '', '', <?php echo ($info['id']); ?>)" id="btn_delete_" />
                            <input type="button" value="添加区域" class="btn" id="btn_add" />
                            <input type="button" value="锁定区域" class="btn" id="btn_lock" />
                            <!--<input type="button" value="获取数据" class="btn" id="btn_save" />-->
                        </div>
                        <div id="canvas"> 
                            <img id="img_" src="<?php echo ($info["photo_path"]); ?>" />
                        </div>
                        <?php if($info["photo_path"] == ''): ?><script>
                                $("#img_, #btn_delete_, #canvas, #btn_add, #btn_lock, #btn_save").hide();
                            </script><?php endif; ?>
                    </div>
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
    <script type="text/javascript" charset="utf-8" src="/Application/Admin/Static/js/map/context.js"></script>    
    <script type="text/javascript" charset="utf-8" src="/Application/Admin/Static/js/map/drag.js"></script>    
    <script type="text/javascript" charset="utf-8" src="/Application/Admin/Static/js/map/spryMap.js"></script>
    <script type="text/javascript" charset="utf-8" src="/Application/Admin/Static/js/map/mapImgUpload.js"></script>        
<script>        
    $(function(){
        // 图片上传
        ajaxMapUpload('#btnUpload', $("#img"), 'Temp', '', true, 'Upgrade', <?php echo ($info['id']); ?>);

        // 图片拖拽引用
        new SpryMap({
            id : "canvas",
            height: 500,
            width: 800,
            startX: 100,
            startY: 100,
            cssClass: "mappy"
        });
        
	//初始化计数器
	num = 0;
        
	//区块锁定标识
	lock = false;
        
        // 获取地图id
        allianceMerchantMapId = <?php echo ($info['id']); ?>;
        
	// 加载原有信息
	loadData = <?php echo ($allianceMerchantDetailData); ?>;
    });
    </script>
    <script type="text/javascript" charset="utf-8" src="/Application/Admin/Static/js/map/mapConfig.js"></script>        

</body>
</html>