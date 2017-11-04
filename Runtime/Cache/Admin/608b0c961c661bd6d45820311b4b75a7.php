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
        .cate-div{
        	margin:10px 0;
        }
        .wf-form-table {
            margin-top:20px;
        }
        .at1{
        	width:60%;
        }
        .at3, .at4, .at6{
        	width:15%;
        }
        .color-text{
        	width:180px;
        }
        .ml10{
        	margin-left:10px;
        }
        .green-btn, .green-btn:hover{
            background-color: #319936
        }
        .color-img-p{
            width:202px;
            text-align: center;
            margin-top:3px;
        }
    </style>

</head>
<body>
    
    <!-- 内容区 -->
    <div id="content">
        
	<div class="tw-layout">
		<div class="tw-list-hd">
			<?php echo isset($info['id'])?'编辑':'新增';?>商品信息
		</div>
		
    	<div class="tw-list-wrap tw-edit-wrap">
    	    <form action="/index.php/Admin/Goods/edit/id/281" method="POST" class="form-horizontal ajaxForm">
    	    	<div class="cate-div">
                    <span>商品分类：</span>
                    <span>
                        <select name="goods_category_id" id="goods_category_id">
    		                <?php if(is_array($goods_cate_list)): $i = 0; $__LIST__ = $goods_cate_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$gcate): $mod = ($i % 2 );++$i;?><option value="<?php echo ($gcate["id"]); ?>" <?php if($gcate[id] == $info[goods_category_id]): ?>selected<?php endif; ?>><?php echo ($gcate["title_show"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
    		            </select>
                    </span>
    	    	</div>
    	    	<table class="wf-form-table" id="goods-info-table">
                    <colgroup>
                        <col width="10%">
                        <col width="90%">
                    </colgroup>
                    <tbody>
                        <tr>
                            <th colspan="2" class="information"><div class="fl offset">基本信息</div></th>
                        </tr>
                        <?php if(is_array($attr_list)): $i = 0; $__LIST__ = $attr_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$list): $mod = ($i % 2 );++$i; if($list["attr_type"] == 0 || $list["attr_type"] == 1): ?><tr>
                                    <th><em>*</em> <?php echo ($list["attr_name"]); ?>:</th>
                                    <td>
                                        <input type="text" name="goods_attr_value[<?php echo ($list["id"]); ?>]" class="text input-large at<?php echo ($list["id"]); ?>" placeholder="请输入<?php echo ($list["attr_name"]); ?>" value="<?php echo ($attr_value[$list[id]][attr_value]); ?>"/>
                                        <?php if(in_array(($list[id]), explode(',',"3,4"))): ?>元<?php endif; ?>
                                    </td>
                                </tr>
                            <?php elseif($list["attr_type"] == 2): ?>
                                <tr>
                                    <th><em>*</em> <?php echo ($list["attr_name"]); ?>:</th>
                                    <td>
                                        <?php if(is_array($list[attr_value])): $i = 0; $__LIST__ = $list[attr_value];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?><label class="radio"><input type="radio" name="goods_attr_value[<?php echo ($list["id"]); ?>][]" value="<?php echo ($v); ?>" <?php if(in_array(($v), is_array($attr_value[$list[id]][attr_value])?$attr_value[$list[id]][attr_value]:explode(',',$attr_value[$list[id]][attr_value]))): ?>checked<?php endif; ?> /><?php echo ($v); ?></label><?php endforeach; endif; else: echo "" ;endif; ?>
                                    </td>
                                </tr>
                            <?php else: ?>
                                <tr>
                                    <th><em>*</em> <?php echo ($list["attr_name"]); ?>:</th>
                                    <td>
                                        <?php if(is_array($list[attr_value])): $i = 0; $__LIST__ = $list[attr_value];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?><label class="checkbox"><input type="checkbox" name="goods_attr_value[<?php echo ($list["id"]); ?>][]" value="<?php echo ($v); ?>" <?php if(in_array(($v), is_array($attr_value[$list[id]][attr_value])?$attr_value[$list[id]][attr_value]:explode(',',$attr_value[$list[id]][attr_value]))): ?>checked<?php endif; ?> /><?php echo ($v); ?></label><?php endforeach; endif; else: echo "" ;endif; ?>
                                    </td>
                                </tr><?php endif; endforeach; endif; else: echo "" ;endif; ?>
                        <tr>
                            <th><em>*</em> 商品主图:</th>
                            <td>
                                <?php if($info["goods_img"] != null): ?><img src="<?php echo ($info["goods_img"]); ?>" style="height:113px; width:202px;" id="img_"/>
                                    <input type="hidden" value="<?php echo ($info["goods_img"]); ?>" name="goods_img" id="img" />
                                    <input class="btn btn-default btn-xs" type="button" value="上传图片" id="btnUpload" style="display:none"/>
                                    <input class="btn btn-danger btn-xs" type="button" value="删除" onclick="delFile($('#img').val(), '')" id="btn_delete_"/>
                                <?php else: ?>
                                    <img src="" style="height:113px; width:202px; display:none" id="img_"/>
                                    <input type="hidden" value="" name="goods_img" id="img" />
                                    <input class="btn btn-default btn-xs" type="button" value="上传图片" id="btnUpload"/>
                                    <input class="btn btn-danger btn-xs" type="button" value="删除" onclick="delFile($('#img').val(), '')" id="btn_delete_" style="display:none"/><?php endif; ?>
                            </td>
                        </tr>
                        <tr>
                            <th colspan="2" class="information">
                            	<div class="fl offset">商品颜色</div>
                            	<div class="fl ml10">
                            		<a class="tw-tool-btn-add" onclick="addColor()"><i class="tw-icon-plus-circle"></i> 添加颜色 </a>
                            	</div>
                            </th>
                        </tr>
                        <?php if(!empty($color_list)): if(is_array($color_list)): $k = 0; $__LIST__ = $color_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$color_list): $mod = ($k % 2 );++$k;?><tr>
                                    <th valign="top"><em></em> 颜色:</th>
                                    <td>
                                        <div class="fl">
                                            <div class="">
                                                <input type="text" name="color_name[<?php echo ($k); ?>]" class="text input-large color-text" placeholder="输入商品颜色" value="<?php echo ($color_list["name"]); ?>"/>
                                            </div>
                                            <div style="margin-top:5px;">
                                                <div class="fl" style="margin-right:15px">
                                                    <input type="hidden" value="<?php echo ($color_list['default_pic']); ?>" name="color_pic[<?php echo ($color_list['num']); ?>][1]" id="img<?php echo ($color_list['num']); ?>_1" />
                                                    <img src="<?php echo ($color_list['default_pic']); ?>" style="height:113px; width:202px;" id="img_<?php echo ($color_list['num']); ?>_1"/>
                                                    <p class="color-img-p"><input class="btn btn-default btn-xs green-btn" type="button" value="上传图片" id="btnUpload<?php echo ($color_list['num']); ?>_1"  style="display:none"/></p>
                                                    <p class="color-img-p"><input class="btn btn-danger btn-xs green-btn del-img-btn" type="button" value="删除" id="btn_delete_<?php echo ($color_list['num']); ?>_1" del-img-id='<?php echo ($color_list['num']); ?>_1'/></p>
                                                </div>
                                                <?php $__FOR_START_1118__=2;$__FOR_END_1118__=5;for($i=$__FOR_START_1118__;$i < $__FOR_END_1118__;$i+=1){ if($color_list['list'][$i-2] != null): ?><div class="fl" style="margin-right:15px">
                                                            <input type="hidden" value="<?php echo ($color_list['list'][$i-2][photo_path]); ?>" name="color_pic[<?php echo ($color_list['num']); ?>][<?php echo ($i); ?>]" id="img<?php echo ($color_list['num']); ?>_<?php echo ($i); ?>" />
                                                            <img src="<?php echo ($color_list['list'][$i-2][photo_path]); ?>" style="height:113px; width:202px;" id="img_<?php echo ($color_list['num']); ?>_<?php echo ($i); ?>"/>
                                                            <p class="color-img-p"><input class="btn btn-default btn-xs green-btn" type="button" value="上传图片" id="btnUpload<?php echo ($color_list['num']); ?>_<?php echo ($i); ?>"  style="display:none"/></p>
                                                            <p class="color-img-p"><input class="btn btn-danger btn-xs green-btn del-img-btn" type="button" value="删除" id="btn_delete_<?php echo ($color_list['num']); ?>_<?php echo ($i); ?>" del-img-id='<?php echo ($color_list['num']); ?>_<?php echo ($i); ?>'/></p>
                                                        </div>
                                                    <?php else: ?>
                                                        <div class="fl" style="margin-right:15px">
                                                            <input type="hidden" value="" name="color_pic[<?php echo ($color_list['num']); ?>][<?php echo ($i); ?>]" id="img<?php echo ($color_list['num']); ?>_<?php echo ($i); ?>" />
                                                            <img src="/Public/image/color-img-<?php echo ($i); ?>.jpg" style="height:113px; width:202px;" id="img_<?php echo ($color_list['num']); ?>_<?php echo ($i); ?>"/>
                                                            <p class="color-img-p"><input class="btn btn-default btn-xs green-btn" type="button" value="上传图片" id="btnUpload<?php echo ($color_list['num']); ?>_<?php echo ($i); ?>"/></p>
                                                            <p class="color-img-p"><input class="btn btn-danger btn-xs green-btn del-img-btn" type="button" value="删除" id="btn_delete_<?php echo ($color_list['num']); ?>_<?php echo ($i); ?>" del-img-id='<?php echo ($color_list['num']); ?>_<?php echo ($i); ?>' style="display:none"/></p>
                                                        </div><?php endif; } ?>
                                            </div>   
                                        </div>
                                    </td>
                                </tr><?php endforeach; endif; else: echo "" ;endif; endif; ?>
                    </tbody>
                </table>
                <table class="wf-form-table custom-html">
                    <?php if(!empty($cate_attr_list)): ?><colgroup>
                        <col width="10%">
                        <col width="90%">
                    </colgroup>
                    <tbody>
                    <tr>
                        <th colspan="2" class="information"><div class="fl offset">扩展属性</div></th>
                    </tr>
                    <?php if(is_array($cate_attr_list)): $k = 0; $__LIST__ = $cate_attr_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$list): $mod = ($k % 2 );++$k; if($list["attr_type"] == 0 || $list["attr_type"] == 1): ?><tr>
                                <th><em></em> <?php echo ($list["attr_name"]); ?>:</th>
                                <td>
                                    <input type="text" name="goods_attr_value[<?php echo ($list["id"]); ?>]" class="text input-large at<?php echo ($list["id"]); ?>" placeholder="请输入<?php echo ($list["attr_name"]); ?>" value="<?php echo ($attr_value[$list[id]][attr_value]); ?>"/>
                                </td>
                            </tr>
                        <?php elseif($list["attr_type"] == 2): ?>
                            <tr>
                                <th><em></em> <?php echo ($list["attr_name"]); ?>:</th>
                                <td>
                                    <?php if(is_array($list[attr_value])): $i = 0; $__LIST__ = $list[attr_value];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?><label class="radio"><input type="radio" name="goods_attr_value[<?php echo ($list["id"]); ?>][]" value="<?php echo ($v); ?>" <?php if(in_array(($v), is_array($attr_value[$list[id]][attr_value])?$attr_value[$list[id]][attr_value]:explode(',',$attr_value[$list[id]][attr_value]))): ?>checked<?php endif; ?> /><?php echo ($v); ?></label><?php endforeach; endif; else: echo "" ;endif; ?>
                                </td>
                            </tr>
                        <?php else: ?>
                            <tr>
                                <th><em></em> <?php echo ($list["attr_name"]); ?>:</th>
                                <td>
                                    <?php if(is_array($list[attr_value])): $i = 0; $__LIST__ = $list[attr_value];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?><label class="checkbox"><input type="checkbox" name="goods_attr_value[<?php echo ($list["id"]); ?>][]" value="<?php echo ($v); ?>" <?php if(in_array(($v), is_array($attr_value[$list[id]][attr_value])?$attr_value[$list[id]][attr_value]:explode(',',$attr_value[$list[id]][attr_value]))): ?>checked<?php endif; ?> /><?php echo ($v); ?></label><?php endforeach; endif; else: echo "" ;endif; ?>
                                </td>
                            </tr><?php endif; endforeach; endif; else: echo "" ;endif; ?>
                    </tbody><?php endif; ?>
                </table>
                <table class="wf-form-table" id="goods-info-table">
                    <colgroup>
                        <col width="10%">
                        <col width="90%">
                    </colgroup>
                    <tbody>
                        <tr>
                            <th colspan="2" class="information"><div class="fl offset">文本描述</div></th>
                        </tr>
                        <tr>
                            <td coslpan="2">
                                <textarea type="text" rows="5" cols="90" id="goods-remark" name="goods_remark" placeholder="请输入文本描述"><?php echo ($info["goods_remark"]); ?></textarea>
                            </td>
                        </tr>
                    </tbody>
                </table>
    	        <div class="tw-tool-bar-bot">
    	           <input type="hidden" name="id" value="<?php echo ($info["id"]); ?>" />
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
	    $(function(){
            //商品主图上传控件
            ajaxUpload('#btnUpload', $("#img"), 'Temp', '', true, 'Goods');
	    });

	    $(function(){
	    	//$('.tw-act-btn-confirm').attr('disabled', true);
	    	$('#goods_category_id').change(function(){
	    		var chkId = $(this).val();
	    		$.post(
					"<?php echo U('getCustomAttr');?>",
					{
					'id' :  chkId
					},
					function(result){
						if (result.status == '1') {
			                $('.custom-html').html(result.data);
			            } else {
			                toastr.error(result.info);
			                $('.custom-html').html(null);
			            }
					},
					'json'
				);
	    	});

            //颜色图片删除
            $('body').on('click', '.del-img-btn', function(){
                var imgId = $(this).attr('del-img-id');
                delFile($('#img'+imgId).val(), imgId);
            })
	    });
        
        var m = parseInt('<?php echo ($color_num); ?>') + 1;
        $(function(){
            //商品颜色上传控件
            for (var p=1; p<m; p++) {
                for(var n = 1; n <= 4; n++){
                    ajaxUpload('#btnUpload'+p+'_'+n+'', $('#img'+p+'_'+n+''), 'Temp', ''+p+'_'+n+'', true, 'Goods');
                }
            }
        });
        function addColor(){
            var newRow = "<tr>"
                       + "<th valign='top'><em></em> 颜色:</th>"
                       + "<td>"
                       + "<div class='fl'>"
                       + "<div><input type='text' name='color_name["+ m +"]' class='text input-large color-text' placeholder='输入商品颜色' value=''/> <input class='btn btn-default btn-xs' type='button' value='删除颜色' onclick='delLineFile(this, "+ m +")'/></div>"
                       + "<div style='margin-top:5px;'>";
            for(var i = 1; i <= 4; i++){
                newRow += "<div class='fl' style='margin-right:15px'>"
                       + "<input type='hidden' value='' name='color_pic["+ m +"]["+ i +"]' id='img"+ m +"_"+ i +"' />"
                       + "<img src='/Public/image/color-img-"+ i +".jpg' style='height:113px; width:202px;' id='img_"+ m +"_"+ i +"'/>"
                       + "<p class='color-img-p'><input class='btn btn-default btn-xs green-btn' type='button' value='上传图片' id='btnUpload"+ m +"_"+ i +"'/></p>"
                       + "<p class='color-img-p'><input class='btn btn-danger btn-xs green-btn del-img-btn' type='button' value='删除' id='btn_delete_"+ m +"_"+ i +"' del-img-id='"+ m +"_"+ i +"' style='display:none'/></p>"
                       + "</div>"
            }
            newRow += "</div></div></td></tr>";
            $("#goods-info-table tr:last").after(newRow);
            for(var n = 1; n <= 4; n++){
                ajaxUpload('#btnUpload'+m+'_'+n+'', $('#img'+m+'_'+n+''), 'Temp', ''+m+'_'+n+'', true, 'Goods');
            }
            m++;
        }
	</script>

</body>
</html>