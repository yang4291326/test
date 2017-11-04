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
        .ml10{
            margin-left:10px;
        }
        .green-btn, .green-btn:hover{
            background-color: #319936
        }
        .detail-up-btn{
            margin:75px 0 0 15px;
        }
    </style>

</head>
<body>
    
    <!-- 内容区 -->
    <div id="content">
        
	<div class="tw-layout">
		<div class="tw-list-hd">
			 <?php echo ($goods_info["attr_value"]); ?> - 商品详情管理
		</div>
    	<div class="tw-list-wrap tw-edit-wrap">
    	    <form action="/index.php/Admin/Goods/details/id/287" method="POST" class="form-horizontal ajaxForm">
    	    	<table class="wf-form-table" id="goods-info-table">
                    <colgroup>
                        <col width="10%">
                        <col width="90%">
                    </colgroup>
                    <tbody>
                        <tr>
                            <th colspan="2" class="information">
                            	<div class="fl offset">商品详情</div>
                            	<div class="fl ml10">
                            		<a class="tw-tool-btn-add" onclick="addDetail()"><i class="tw-icon-plus-circle"></i> 添加详情 </a>
                                    <a class="tw-tool-btn-setting" href="<?php echo U('detailSort',array('id'=>I('get.id',0), 'name' => $goods_info[attr_value]),'');?>" >
                                        <i class="tw-icon-cogs"></i> 排序
                                    </a>
                            	</div>
                            </th>
                        </tr>
                        <?php if(!empty($detail_list)): if(is_array($detail_list)): $k = 0; $__LIST__ = $detail_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$list): $mod = ($k % 2 );++$k;?><tr>
                                <th valign='top'><em>*</em> 图片名称:</th>
                                <td>
                                    <div class='fl'>
                                        <div class='details-name'>
                                            <input type='text' name='detail[name][<?php echo ($k); ?>]' class='text input-large color-text' placeholder='输入图片名称' value='<?php echo ($list["name"]); ?>'/>
                                        </div>
                                        <div style='margin-top:5px;'>
                                            <div class='details-pic clearfix'>
                                                <div class='fl'>
                                                    <img src='<?php echo ($list["photo_path"]); ?>' style='height:175px; width:435px;' id='img_<?php echo ($k); ?>'/><input type='hidden' value='<?php echo ($list["photo_path"]); ?>' name='detail[path][<?php echo ($k); ?>]' id='img<?php echo ($k); ?>' />
                                                </div>
                                                <div class='fl'>
                                                    <input class='btn green-btn detail-up-btn' type='button' value='上传图片' id='btnUpload<?php echo ($k); ?>'  style='display:none'/>
                                                    <input class='btn green-btn detail-up-btn detail-del-btn' type='button' value='删除' id='btn_delete_<?php echo ($k); ?>' del-img-id='<?php echo ($k); ?>'/>
                                                </div>
                                            </div>
                                            <div class='details-des clearfix' style='margin-top:5px;'>
                                                <textarea type='text' rows='3' cols='80' id='remark' name='detail[remark][<?php echo ($k); ?>]' placeholder='请输入详情描述'><?php echo ($list["remark"]); ?></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div >
                                        <a class="tw-act-btn-confirm" onclick="javascript:recycle(<?php echo ($list['id']); ?>, '确认删除?! 删除后此详情将不在此地显示!',true)"><i class=""></i>删除</a>
                                    </div>
                                </td>
                            </tr><?php endforeach; endif; else: echo "" ;endif; endif; ?>
                    </tbody>
                </table>
    	        <div class="tw-tool-bar-bot">
    	           <input type="hidden" name="id" value="<?php echo ($id); ?>" />
    	           <button type="submit" class="tw-act-btn-confirm">保存</button>
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
        var m = parseInt('<?php echo ($detail_num); ?>') + 1;
        $(function(){
            //商品详情图片上传控件
            for (var p=1; p<m; p++) {
                ajaxUpload('#btnUpload'+ p +'', $('#img'+ p +''), 'Temp', p, true, 'GoodsDetail');
            }
        });
	    function addDetail(){
            var newRow = "<tr>"
                       + "<th valign='top'><em>*</em> 图片名称:</th>"
                       + "<td>"
                       + "<div class='fl'>"
                       + "<div class='details-name'><input type='text' name='detail[name]["+ m +"]' class='text input-large color-text' placeholder='输入图片名称' value=''/><input class='btn btn-default btn-xs' type='button' value='删除详情' onclick='delDetailLine(this, "+ m +")'/></div>"
                       + "<div style='margin-top:5px;'>"
                       + "<div class='details-pic clearfix'>"
                       + "<div class='fl'><img src='/Public/image/default-goods-detail-pic.jpg' style='height:175px; width:435px;' id='img_"+ m +"'/><input type='hidden' value='' name='detail[path]["+ m +"]' id='img"+ m +"' /></div>"
                       + "<div class='fl'><input class='btn green-btn detail-up-btn' type='button' value='上传图片' id='btnUpload"+ m +"'/><input class='btn green-btn detail-up-btn detail-del-btn' type='button' value='删除' id='btn_delete_"+ m +"' del-img-id='"+ m +"' style='display:none'/></div>"
                       + "</div>"
                       + "<div class='details-des clearfix' style='margin-top:5px;'><textarea type='text' rows='3' cols='80' id='remark' name='detail[remark]["+ m +"]' placeholder='请输入详情描述'><?php echo ($info["remark"]); ?></textarea></div>"
                       + "</div></div></td></tr>";

            $("#goods-info-table tr:last").after(newRow); 
            ajaxUpload('#btnUpload'+ m +'', $('#img'+ m +''), 'GoodsDetail', m);
            m++;
        }

        $(function(){
            //图片删除
            $('body').on('click', '.detail-del-btn', function(){
                var imgId = $(this).attr('del-img-id');
                delFile($('#img'+imgId).val(), imgId);
            })
        });
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

</body>
</html>