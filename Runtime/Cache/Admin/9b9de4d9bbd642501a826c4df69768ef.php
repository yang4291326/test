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
    
    <style type="text/css">
        ul li a{color: black;}
    </style>

</head>
<body>
    
    <!-- 内容区 -->
    <div id="content">
        
    <div class="tw-layout">
    	<div class="tw-list-hd">
            <?php echo isset($info['id'])?'编辑':'新增'; if($type == 0): ?>APP启动页<?php elseif($type == 1): ?>APP轮播图<?php elseif($type == 2): ?>APP登录背景图<?php endif; ?>图片
        </div>
		
	    <div class="tw-list-wrap tw-edit-wrap">
            <form action="/index.php/Admin/Banner/edit/type/1" method="post" class="form-horizontal ajaxForm">
                <div class="form-item">
                    <?php if($type == 0): ?><label class="item-label">APP启动页标识名称<span class="check-tips"><b>*</b>（用于后台展示APP启动页名称标题）</span></label>
                    <?php elseif($type == 1): ?>
                        <label class="item-label">APP轮播图片标识名称<span class="check-tips"><b>*</b>（用于后台展示APP轮播图片名称标题）</span></label>
                    <?php elseif($type == 2): ?>
                        <label class="item-label">APP手机登录页面图片标识名称<span class="check-tips"><b>*</b>（用于后台展示APP手机登录页面图片名称标题）</span></label><?php endif; ?>
                    <div class="controls">
                        <input type="text" class="text input-large" name="title" value="<?php echo ($info["title"]); ?>" placeholder="图片标识名称">
                    </div>
                </div>

                <div class="form-item">
                    <label class="item-label">形象图片<span class="check-tips"><b>*</b><?php if($type == 0): ?>（启动页的形象图片,请上传1080px*1920px的图片）<?php elseif($type == 1): ?>（轮播图的形象图片,请上传1080px*590px的图片）<?php elseif($type == 2): ?>（手机登录背景的形象图片,请上传1080px*1920px的图片）<?php endif; ?></span></label>
                    <div class="controls">
                        <div>
                            <img src="<?php echo ($info["img"]); ?>" style="width:129px;" id="img_"/>
                        <div>
                        <input type="hidden" value="<?php echo ($info["img"]); ?>" name="img" id="img"/>
                        <input class="btn btn-default btn-xs" type="button" value="上传" id="btnUpload" />
                        <input class="btn btn-danger btn-xs" type="button" value="删除" onclick="delFile($('#img').val(), '')" id="btn_delete_" />
                        <?php if($info["img"] == ''): ?><script>
                                $("#img_, #btn_delete_").hide();
                            </script><?php endif; ?>
                    </div>
                </div>

                <?php if($type == 1): ?><div class="form-item">
                        <label class="item-label">点击打开内容<span class="check-tips"><b>*</b>（用于显示点击轮播图展示的内容）</span></label>

                        <div class="form-item">
                            <div class="tw-tab-panel" data-tab-idx="8mFNtKjnCr" style="display: block;">
                                <div class="tw-panel-cnt">
                                    <div class="tw-tabs">
                                        <ul class="tw-tabs-nav ui-sortable" style="width:702px;" id="my_tabs">
                                            <li class="tw-nav-item" data-tab-idx="url" data-open-type="2">
                                                <a href="javascript: void(0)">打开外部链接</a>
                                            </li>
                                            <li class="tw-nav-item" data-tab-idx="article" data-open-type="1">
                                                <a href="javascript: void(0)">选择商品</a>
                                            </li>
                                        </ul>
                                        <div class="tw-tabs-bd" style="width:700px;">
                                            <div class="tw-tab-panel" data-tab-idx="url" style="display: block;">
                                                <div class="tw-panel-cnt">
                                                    <div style="margin-bottom:15px">
                                                        链接类型：
                                                        <label class="radio"><input type="radio" name="open_type" value="2" <?php if($info["open_type"] == 2 || $info["open_type"] == null): ?>checked<?php endif; ?>/>背景介绍</label>
                                                        <label class="radio"><input type="radio" name="open_type" value="3" <?php if($info["open_type"] == 3): ?>checked<?php endif; ?>/>解决方案</label>
                                                        <label class="radio"><input type="radio" name="open_type" value="4" <?php if($info["open_type"] == 4): ?>checked<?php endif; ?>/>实例分享</label>
                                                    </div>
                                                    <div class="controls openurl">
                                                        链接url   ： <input type="text" class="text input-large" name="url" value="<?php echo ($info["url"]); ?>" placeholder="必须以http://开头">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="tw-tab-panel" data-tab-idx="article" style="display: none;">
                                                <div class="tw-panel-cnt">
                                                     <div class="controls openarticle">
                                                        选择商品 ：<input id="goods_name" type="text" class="text" value="<?php echo ($info['goodsName']); ?>" placeholder="选择的商品标题" disabled="disabled">
                                                        <input type="hidden" name="goods_id" value="<?php echo ($info["goods_id"]); ?>" id="goods_id"><div class="btn" onclick="selectGoods()">点击选择</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><?php endif; ?>  

                <div class="form-item">
                    <label class="item-label">排序</label>
                    <div class="controls">
                        <input type="text" class="text input-small" name="sort" value="<?php echo ((isset($info["sort"]) && ($info["sort"] !== ""))?($info["sort"]):0); ?>">
                    </div>
                </div>

                <div class="tw-tool-bar-bot">
                    <input type="hidden" value="<?php echo ($info['id']); ?>" name="id">
                    <input type="hidden" value="<?php echo ($type); ?>" name="type">
                    <?php if($type == 1): ?><input type="hidden" value="<?php if($info["open_type"] == 1): ?>1<?php else: ?>2<?php endif; ?>" name="click_type" id="click_type"><?php endif; ?>
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
    
    <script type="text/javascript" charset="utf-8" src="/Public/ajaxupload.js"></script>
    <script type="text/javascript" charset="utf-8" src="/Application/Common/Static/js/imgupload.js"></script>
    <script>
        $(function(){
            ajaxUpload('#btnUpload', '#img', 'Banner', '');

            var open_type = $('input[name=click_type]').val();
            $('#my_tabs li[data-open-type='+ open_type +']').click();

            $('#my_tabs li').on('click', function(){
                $("#click_type").val($(this).attr('data-open-type'));
            });
        })

        // 查询商品列表
        function selectGoods(){
            layer.open({
                type: 2,
                title: '商品列表',
                shadeClose: true,
                shade: 0.8,
                area: ['800px', '500px'],
                content: "<?php echo U('Admin/GoodsCategory/selectGoods');?>" //iframe的url
            }); 
        }
    </script>

</body>
</html>