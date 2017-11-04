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
    	    <form action="/index.php/Admin/Goods/vrModel/id/321" method="POST" class="form-horizontal ajaxForm">
    	    	<div style="margin:10px 0 20px;">
                    <span class="fl">商品模型：</span>
                    <span>
                        <span id="img_"/><?php echo (get_file_name($model_info["model_path"])); ?></span>
                        <input type="hidden" name="model_path" id="img" value="<?php echo ($model_info["model_path"]); ?>"/>
                        <?php if($model_info['model_path'] != ''): ?><input class="btn btn-default btn-xs" type="button" value="资源选择" id="btnUpload"  style="display:none"/>
                            <input class="btn btn-danger btn-xs" type="button" value="删除" onclick="delFile($('#img').val(), '')" id="btn_delete_"/>
                        <?php else: ?>
                            <input class="btn btn-default btn-xs" type="button" value="资源选择" id="btnUpload"/>
                            <input class="btn btn-danger btn-xs" type="button" value="删除" onclick="delFile($('#img').val(), '')" id="btn_delete_" style="display:none"/><?php endif; ?>
                        
                    </span>
    	    	</div>
                <!--杨yongjie  添加-->
                <div style="margin:10px 0 20px;">
                    <span class="fl">模型原文件名：</span>
                    <input type='text' name='name' class='text input-large' placeholder='输入上传的模型原文件名' value="<?php echo ($model_info["name"]); ?>"/>
                </div>
                <!--杨yongjie  添加-->
                <div style="margin:10px 0 20px;">
                    <span class="fl">商品缩略图：</span>
                    <span>
                        <span id="img_1"/><?php echo (get_file_name($model_info["ico"])); ?></span>
                        <input type="hidden" name="ico" id="img1" value="<?php echo ($model_info["ico"]); ?>"/>
                        <?php if($model_info['ico'] != ''): ?><input class="btn btn-default btn-xs" type="button" value="资源选择" id="btnUpload1" style="display:none"/>
                            <input class="btn btn-danger btn-xs" type="button" value="删除" onclick="delFile($('#img1').val(), '1')" id="btn_delete_1"/>
                        <?php else: ?>
                            <input class="btn btn-default btn-xs" type="button" value="资源选择" id="btnUpload1"/>
                            <input class="btn btn-danger btn-xs" type="button" value="删除" onclick="delFile($('#img1').val(), '1')" id="btn_delete_1" style="display:none"/><?php endif; ?>
                    </span>
                </div>
                <div style="margin:10px 0 20px;">
                    <span class="fl">材质Tiling值：</span>
                    <span>
                        <input type='text' name='material_tiling' class='text input-large' placeholder='输入材质Tiling值' value="<?php echo ($model_info["material_tiling"]); ?>"/>
                    </span>
                </div>
                <div style="margin:10px 0 20px;">
                    <span class="fl">商品描述：</span>
                    <span>
                        <input type='text' name='description' class='text input-large' placeholder='输入商品描述' value="<?php echo ($model_info["description"]); ?>"/>
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
                        <!--<?php if(!empty($layout_list)): ?>-->
                        <!--<?php if(is_array($layout_list)): $key = 0; $__LIST__ = $layout_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($key % 2 );++$key;?>-->
                            <!--<?php if($key != 1): ?>-->
                                <!--<tr><td colspan='4'><div class='td-line'></div></td></tr>-->
                            <!--<?php endif; ?>-->
                            <!--<tr>-->
                                <!--<th>户型名称:</th>-->
                                <!--<td colspan='2'>-->
                                    <!--<input type="text" name="vr[name][<?php echo ($key); ?>]" class="text input-large" placeholder="请输入户型名称" value="<?php echo ($v["name"]); ?>"/>-->
                                <!--</td>-->
                                <!--<td>-->
                                    <!--<a class="btn btn-danger btn-xs del-img-btn" onclick="javascript:delete_model(<?php echo ($v['id']); ?>, 1)"><i class=""></i>删除</a>-->
                                <!--</td>-->
                            <!--</tr>-->
                            <!--<tr>-->
                                <!--<th>户型图标:</th>-->
                                <!--<td colspan='3'>-->
                                    <!--<span id="img_1_<?php echo ($key); ?>"/><?php echo (get_file_name($v["layout_photo_path"])); ?></span>-->
                                    <!--<input type="hidden" name="vr[layout_photo_path][<?php echo ($key); ?>]" id="img1_<?php echo ($key); ?>" value="<?php echo ($v["layout_photo_path"]); ?>"/>-->
                                    <!--<?php if($v['layout_photo_path'] != ''): ?>-->
                                        <!--<input class="btn btn-default btn-xs" type="button" value="资源选择" id="btnUpload1_<?php echo ($key); ?>" style="display:none"/>-->
                                        <!--<input class="btn btn-danger btn-xs del-img-btn" type="button" value="删除" id="btn_delete_1_<?php echo ($key); ?>" del-img-id='1_<?php echo ($key); ?>'/>-->
                                    <!--<?php else: ?>-->
                                        <!--<input class="btn btn-default btn-xs" type="button" value="资源选择" id="btnUpload1_<?php echo ($key); ?>"/>-->
                                        <!--<input class="btn btn-danger btn-xs del-img-btn" type="button" value="删除" id="btn_delete_1_<?php echo ($key); ?>" del-img-id='1_<?php echo ($key); ?>'  style="display:none"/>-->
                                    <!--<?php endif; ?>-->
                                <!--</td>-->
                            <!--</tr>-->
                            <!--<tr>-->
                                <!--<th>户型模型:</th>-->
                                <!--<td colspan='3'>-->
                                    <!--<span id="img_2_<?php echo ($key); ?>"/><?php echo (get_file_name($v["layout_path"])); ?></span>-->
                                    <!--<input type="hidden" name="vr[layout_path][<?php echo ($key); ?>]" id="img2_<?php echo ($key); ?>" value="<?php echo ($v["layout_path"]); ?>"/>-->
                                    <!--<?php if($v['layout_path'] != ''): ?>-->
                                        <!--<input class="btn btn-default btn-layout_pathxs" type="button" value="资源选择" id="btnUpload2_<?php echo ($key); ?>" style="display:none"/>-->
                                        <!--<input class="btn btn-danger btn-xs del-img-btn" type="button" value="删除" id="btn_delete_2_<?php echo ($key); ?>" del-img-id='2_<?php echo ($key); ?>'/>-->
                                    <!--<?php else: ?>-->
                                        <!--<input class="btn btn-default btn-layout_pathxs" type="button" value="资源选择" id="btnUpload2_<?php echo ($key); ?>"/>-->
                                        <!--<input class="btn btn-danger btn-xs del-img-btn" type="button" value="删除" id="btn_delete_2_<?php echo ($key); ?>" del-img-id='2_<?php echo ($key); ?>'  style="display:none"/>-->
                                    <!--<?php endif; ?>-->
                                <!--</td>-->
                            <!--</tr>-->
                            <!--<tr>-->
                                <!--<th>户型风格:</th>-->
                                <!--<td>-->
                                    <!--<input type="text" name="vr[layout_style][<?php echo ($key); ?>]" class="text input-5x" placeholder="请输入户型风格" value="<?php echo ($v["layout_style"]); ?>"/>-->
                                <!--</td>-->
                                <!--<th>户型场景:</th>-->
                                <!--<td>-->
                                    <!--<input type="text" name="vr[layout_scene][<?php echo ($key); ?>]" class="text input-5x" placeholder="请输入户型场景" value="<?php echo ($v["layout_scene"]); ?>"/>-->
                                <!--</td>-->
                            <!--</tr>-->
                            <!--<tr>-->
                                <!--<th>初始位置:</th>-->
                                <!--<td>-->
                                    <!--<input type="text" name="vr[initial_position][<?php echo ($key); ?>]" class="text input-5x" placeholder="请输入初始位置" value="<?php echo ($v["initial_position"]); ?>"/>-->
                                <!--</td>-->
                                <!--<th>初始方向:</th>-->
                                <!--<td>-->
                                    <!--<input type="text" name="vr[initial_direction][<?php echo ($key); ?>]" class="text input-5x" placeholder="请输入初始方向" value="<?php echo ($v["initial_direction"]); ?>"/>-->
                                <!--</td>-->
                            <!--</tr>-->
                            <!--<tr>-->
                                <!--<th>是否默认:</th>-->
                                <!--<td colspan='3'>-->
                                    <!--<label class='radio'>-->
                                        <!--<input type='radio' name='vr[is_default_hx][<?php echo ($key); ?>]' value='1' <?php if($v["is_default"] == 1): ?>checked<?php endif; ?>/>是-->
                                    <!--</label> -->
                                    <!--<label class='radio'>-->
                                        <!--<input type='radio' name='vr[is_default_hx][<?php echo ($key); ?>]' value='0' <?php if($v["is_default"] == 0): ?>checked<?php endif; ?>/>否-->
                                    <!--</label>-->
                                <!--</td>-->
                            <!--</tr>-->
                        <!--<?php endforeach; endif; else: echo "" ;endif; ?>-->
                        <!--<?php endif; ?>-->
                    <!--</tbody>-->
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
                        <?php if(!empty($resource_list)): if(is_array($resource_list)): $key = 0; $__LIST__ = $resource_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($key % 2 );++$key; if($key != 1): ?><tr><td colspan='2'><div class='td-line'></div></td></tr><?php endif; ?>
                            <tr>
                                <th>图标资源:</th>
                                <td>
                                    <span id="img_5_<?php echo ($key); ?>"/><?php echo (get_file_name($v["photo_resource_path"])); ?></span>
                                    <input type="hidden" name="vr[photo_resource_path][<?php echo ($key); ?>]" id="img5_<?php echo ($key); ?>" value="<?php echo ($v["photo_resource_path"]); ?>"/>
                                    <?php if($v['photo_resource_path'] != ''): ?><input class="btn btn-default btn-layout_pathxs" type="button" value="资源选择" id="btnUpload5_<?php echo ($key); ?>" style="display:none"/>
                                        <input class="btn btn-danger btn-xs del-img-btn" type="button" value="删除" id="btn_delete_5_<?php echo ($key); ?>" del-img-id='5_<?php echo ($key); ?>'/>
                                    <?php else: ?>
                                        <input class="btn btn-default btn-layout_pathxs" type="button" value="资源选择" id="btnUpload5_<?php echo ($key); ?>"/>
                                        <input class="btn btn-danger btn-xs del-img-btn" type="button" value="删除" id="btn_delete_5_<?php echo ($key); ?>" del-img-id='5_<?php echo ($key); ?>'  style="display:none"/><?php endif; ?>
                                </td>
                            </tr>
                            <tr>
                                <th>组号:</th>
                                <td>
                                    <input type="text" name="vr[group_no][<?php echo ($key); ?>]" class="text input-large" placeholder="请输入组号" value="<?php echo ($v["group_no"]); ?>"/>
                                </td>
                            </tr>
                            <tr>
                                <th>贴图:</th>
                                <td>
                                    <span id="img_3_<?php echo ($key); ?>"/><?php echo (get_file_name($v["map_path"])); ?></span>
                                    <input type="hidden" name="vr[map_path][<?php echo ($key); ?>]" id="img3_<?php echo ($key); ?>" value="<?php echo ($v["map_path"]); ?>"/>
                                    <?php if($v['map_path'] != ''): ?><input class="btn btn-default btn-xs" type="button" value="资源选择" id="btnUpload3_<?php echo ($key); ?>" style="display:none"/>
                                        <input class="btn btn-danger btn-xs del-img-btn" type="button" value="删除" id="btn_delete_3_<?php echo ($key); ?>" del-img-id='3_<?php echo ($key); ?>'/>
                                    <?php else: ?>
                                        <input class="btn btn-default btn-xs" type="button" value="资源选择" id="btnUpload3_<?php echo ($key); ?>"/>
                                        <input class="btn btn-danger btn-xs del-img-btn" type="button" value="删除" id="btn_delete_3_<?php echo ($key); ?>" del-img-id='3_<?php echo ($key); ?>'  style="display:none"/><?php endif; ?>
                                </td>
                            </tr>
                            <tr>
                                <th>法线贴图:</th>
                                <td>
                                    <span id="img_4_<?php echo ($key); ?>"/><?php echo (get_file_name($v["normal_map_path"])); ?></span>
                                    <input type="hidden" name="vr[normal_map_path][<?php echo ($key); ?>]" id="img4_<?php echo ($key); ?>" value="<?php echo ($v["normal_map_path"]); ?>"/>
                                    <?php if($v['normal_map_path'] != ''): ?><input class="btn btn-default btn-layout_pathxs" type="button" value="资源选择" id="btnUpload4_<?php echo ($key); ?>" style="display:none"/>
                                        <input class="btn btn-danger btn-xs del-img-btn" type="button" value="删除" id="btn_delete_4_<?php echo ($key); ?>" del-img-id='4_<?php echo ($key); ?>'/>
                                    <?php else: ?>
                                        <input class="btn btn-default btn-layout_pathxs" type="button" value="资源选择" id="btnUpload4_<?php echo ($key); ?>"/>
                                        <input class="btn btn-danger btn-xs del-img-btn" type="button" value="删除" id="btn_delete_4_<?php echo ($key); ?>" del-img-id='4_<?php echo ($key); ?>'  style="display:none"/><?php endif; ?>
                                </td>
                            </tr>
                            <tr>
                                <th>材质球:</th>
                                <td>
                                    <span id="img_6_<?php echo ($key); ?>"/><?php echo (get_file_name($v["material_ball"])); ?></span>
                                    <input type="hidden" name="vr[material_ball][<?php echo ($key); ?>]" id="img6_<?php echo ($key); ?>" value="<?php echo ($v["material_ball"]); ?>"/>
                                    <?php if($v['material_ball'] != ''): ?><input class="btn btn-default btn-layout_pathxs" type="button" value="资源选择" id="btnUpload6_<?php echo ($key); ?>" style="display:none"/>
                                        <input class="btn btn-danger btn-xs del-img-btn" type="button" value="删除" id="btn_delete_6_<?php echo ($key); ?>" del-img-id='6_<?php echo ($key); ?>'/>
                                    <?php else: ?>
                                        <input class="btn btn-default btn-layout_pathxs" type="button" value="资源选择" id="btnUpload6_<?php echo ($key); ?>"/>
                                        <input class="btn btn-danger btn-xs del-img-btn" type="button" value="删除" id="btn_delete_6_<?php echo ($key); ?>" del-img-id='6_<?php echo ($key); ?>'  style="display:none"/><?php endif; ?>
                                </td>
                            </tr>
                            <tr>
                                <th>材质球名称:</th>
                                <td>
                                    <input type="text" name="vr[material_ball_name][<?php echo ($key); ?>]" class="text input-large" placeholder="请输入材质球名称" value="<?php echo ($v["material_ball_name"]); ?>"/>
                                </td>
                            </tr>
                            <tr>
                                <th>是否默认:</th>
                                <td>
                                    <label class='radio'>
                                        <input type='radio' name='vr[is_default_mx][<?php echo ($key); ?>]' value='1' <?php if($v["is_default"] == 1): ?>checked<?php endif; ?>/>是
                                    </label> 
                                    <label class='radio'>
                                        <input type='radio' name='vr[is_default_mx][<?php echo ($key); ?>]' value='0' <?php if($v["is_default"] == 0): ?>checked<?php endif; ?>/>否
                                    </label>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2" align="center">
                                    <a class="btn btn-danger btn-xs del-img-btn" onclick="javascript:delete_model(<?php echo ($v['id']); ?>, 2)"><i class=""></i>删除</a>
                                </td>
                            </tr><?php endforeach; endif; else: echo "" ;endif; endif; ?>
                    </tbody>
                </table>

    	        <div class="tw-tool-bar-bot">
                   <input type="hidden" name="goods_id" value="<?php echo ($goods_id); ?>" />
                   <input type="hidden" name="model_id" value="<?php echo ($model_info["id"]); ?>" />
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
    <script type="text/javascript" charset="utf-8" src="/Application/Admin/Static/js/goodsImgUpload.js"></script>
	<script type="text/javascript" charset="utf-8">
        var layout_num = "<?php echo ($layout_num); ?>";
        var resource_num = "<?php echo ($resource_num); ?>";
        $(function(){
            ajaxUpload('#btnUpload', $("#img"), 'VRModel', '');
            ajaxUpload('#btnUpload1', $("#img1"), 'VRModel', 1);
            //颜色图片删除
            $('body').on('click', '.del-img-btn', function(){
                var imgId = $(this).attr('del-img-id');
                delFile($('#img'+imgId).val(), imgId, '', false);
            })
        });
        function delete_model(id, type){

                $.ajax({
                    type:"POST",
                    url:"/index.php/Admin/Goods/delete",
                    data:{id:id, type:type},
                    dataType:'JSON',
                    success:function(data){
                        if(data.status == 1){
                            window.location.reload();
                        }

                    }
                });

        };
        function callback(data){

            //如果没有回调函数, 默认执行
            if(data.status == 1){
                _IS_SUBMIT_SUCCESS = true;

                if (data.info != '' && typeof(data.info) != 'undefined')  toastr.success(data.info);;
                //跳转页面
                if ( typeof(_TARGET_URL) != 'undefined' && _TARGET_URL != '') {
                    window.location.href = _TARGET_URL;
                }
                //刷新页面
                if ( typeof(_NEED_REFRESH) != 'undefined' && _NEED_REFRESH == true) {
                    location.reload();
                }
                window.location.href = "<?php echo U('Admin/Goods/index');?>";
            } else {
                if (data.info != '' && typeof(data.info) != 'undefined') toastr.error(data.info);
                else  toastr.error('未定义错误!');
            }
        }
	</script>
    <script type="text/javascript" charset="utf-8" src="/Application/Admin/Static/js/vrmodel.js"></script>

</body>
</html>