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
        .wf-form-table {
            border-left: 1px solid #E8E8E8;
            border-right: 1px solid #E8E8E8;
        }
        .table-text {
            width: 100%;
            border-color: #eeeeee;
            background-color: #fff;
            height: 20px;
            vertical-align: middle;
            padding-top: 4px;
            padding-bottom: 4px;
            border: 1px solid #eeeeee;
            transition: all .3s linear;
        }
        .area {
            height: 50px;
            width: 260px;
        }
        .area textarea {
            border: 1px solid #eeeeee;
            height: 50px;
            width: 100%;
        }
        .sort {
            border: 1px solid #eeeeee;
            width: 50px;
        }
        #mark {
            width: 260px !important;
        }

    </style>

</head>
<body>
    
    <!-- 内容区 -->
    <div id="content">
        
    <div class="tw-layout">
        <div class="tw-list-hd"><?php echo isset($info['id'])?'编辑':'新增';?>模版</div>
        <form action="/index.php/Admin/Article/edit" method="post" class="ajaxForm">
            <div class="tw-list-wrap tw-edit-wrap">
                <table class="wf-form-table">
                    <tbody>
                    <colgroup>
                        <col width="15%">
                        <col width="35%">
                        <col width="15%">
                        <col width="35%">
                    </colgroup>
                        <tr>
                            <th colspan="4" class="information"><div class="fl offset">基础模板信息</div></th>
                        </tr>
                        <tr>
                            <th><em>*</em>模版标题名称</th>
                            <td>
                                <?php if($type == 3 ): ?><input type="hidden" name="article[goods_id]" value="<?php echo ($info['goods_id']); ?>" id="goodsid">
                                        <input type="text" name="article[name]" class="text input-5x" value="<?php echo ($info['goods_name']); ?>" onclick="commoditySelection(-1)" readonly="true" placeholder="请选择主商品！" id="goodsname">                                    
                                    <?php else: ?>
                                        <input maxlength="20" type="text" class="text input-5x" name="article[name]" value="<?php echo ($info['name']); ?>" placeholder="请输入模板标题名称,限20个字符！" id="username"><?php endif; ?>
                            </td>
                            
                            <th>模版标题备注</th>
                            <td class='area'>
                                <textarea id="mark" class="input-5x" name="article[remark]" rows="8" cols="40"><?php echo ($info['remark']); ?></textarea>
                            </td>                            
                        </tr> 
                        <tr>
                            <?php switch($type): case "1": case "4": break;?>
                               
                                <?php default: ?>
                                    <th>模版标题排序</th>
                                    <td>
                                        <input type="text" onkeyup="value=value.replace(/[^\d]/g,'')" class="text input-5x" name="article[sort]" value="<?php echo ($info['sort']); ?>" placeholder="请输入排序字段，必须为数字！">
                                    </td><?php endswitch;?>
                        </tr> 
                        <tr>
                            <th colspan="4" class="information"><div class="fl offset">模板图片（附件）信息</div></th>
                        </tr>
                        <tr>
                            <td colspan="4">
                                <table class="content-table" id="society_relation_table">
                                    <colgroup>
                                        <col width="20%">
                                        <col width="60%">
                                        <col width="10%">
                                        <col width="150">
                                    </colgroup>
                                    <thead>
                                        <tr>
                                            <th style="text-align:center;"> 图片（附件）</th>
                                            <th style="text-align:center;"> 简介</th>
                                            <th style="text-align:center;"> 排序</th>
                                            <th style="text-align:center;">
                                                <a class="tw-tool-btn-add" onclick="addInfo()"><i class="tw-icon-plus-circle"></i> &nbsp;&nbsp;增加&nbsp;&nbsp;</a>
                                            </th>
                                        </tr>
                                    <tbody id="options_tr">
                                        <?php if(is_array($articleDetailData)): $i = 0; $__LIST__ = $articleDetailData;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
                                                <td>
                                                    <img src="<?php echo ($vo['photo_path']); ?>" style='height:100px; width:100px; color:#ccc;' id='img_<?php echo ($key); ?>'/>
                                                    <div id="file_<?php echo ($key); ?>">已经上传视频附件</div>
                                                    <?php if($vo['postfix'] != mp4): ?><script>
                                                            $("#img_<?php echo ($key); ?>").show();
                                                            $("#file_<?php echo ($key); ?>").hide();
                                                        </script>
                                                    <?php else: ?>
                                                        <script>
                                                            $("#img_<?php echo ($key); ?>").hide();
                                                            $("#file_<?php echo ($key); ?>").show();
                                                        </script><?php endif; ?>
                                                    <span>
                                                        <input class='btn' type='button' style='margin-top:15px;height:30px;' value='上传' id='btnUpload<?php echo ($key); ?>' onclick='manyPicture(<?php echo ($key); ?>)'/>
                                                    </span>
                                                    <input type='hidden' class="count-suffix" value="<?php echo ($vo['photo_path']); ?>" name="articleDetail[<?php echo ($key); ?>][photo_path]" id='img<?php echo ($key); ?>'/>
                                                    <input type='hidden' value="<?php echo ($vo['record_id']); ?>" name="articleDetail[<?php echo ($key); ?>][record_id]"/>
                                                </td>
                                                <td class="area">
                                                <textarea placeholder="本项可不编辑文字。无文字时，前台不显示本框。字数不限" name="articleDetail[<?php echo ($key); ?>][content]"><?php echo ($vo['content']); ?></textarea>
                                                </td>
                                                <td class="area"><input class="sort" type='text' onkeyup="value=value.replace(/[^\d]/g,'')" value="<?php echo ($vo['sort']); ?>" name="articleDetail[<?php echo ($key); ?>][sort]"> 
                                                </td>
                                                <td align='center'>
                                                    <a class='tw-tool-btn-del' onclick='deleteLine(this)'><i class='tw-icon-minus-circle'></i> &nbsp;&nbsp;删除&nbsp;&nbsp;</a>
                                                </td>
                                            </tr><?php endforeach; endif; else: echo "" ;endif; ?>
                                    </tbody>
                                </table>    
                            </td>
                        </tr> 
	            </tbody>
                </table>
            </div>
            <div class="tw-tool-bar-bot">
                <input type="hidden" name="id" value="<?php echo ($info['id']); ?>">
                <input type="hidden" name="type" value="<?php echo ($type); ?>">
                <input type="hidden" name="article[member_id]" value="<?php echo ($info['member_id']); ?>">
                <!--如果已经有大于9张的不让添加新模版-->
                <?php if($totalPhotoVidioInfo != 0): ?><button type="submit" class="tw-act-btn-confirm"  >提交</button><?php endif; ?>
                <button type="button" onclick="goback()" class="tw-act-btn-cancel">返回</button>
            </div>
        </form>
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
    <script type="text/javascript" charset="utf-8" src="/Application/Admin/Static/js/articleImgupload.js"></script>

    <script>        
        // 多张图片（附件）上传
        var i = 0;
        if (<?php echo ($articleDetailCount); ?> !== null) {
            i = <?php echo ($articleDetailCount); ?>;
        }
        $(function(){
            for (var m = 0; m < i; m++) {
                manyPicture(m);
            }
        })
        function addInfo(){
            if ( i >= <?php echo ($totalPhotoVidioInfo); ?> ) {
                toastr.error('总量超过了限制！');
                return false;
            }
            var newRow = "<tr>\n\
                            <td>\n\
                                <div style='display: none;' id='file_"+i+"'>已经上传视频附件</div>\n\
                                <img src='' style='height:100px; width:100px; color:#ccc; display: none;' id='img_"+i+"'/>\n\
                                <span>\n\
                                    <input class='btn' type='button' style='margin-top:15px;height:30px;' value='上传' id='btnUpload"+i+"' onclick='manyPicture("+i+")'/>\n\
                                </span>\n\
                                <input type='hidden' class='count-suffix' value='' name=\"articleDetail["+i+"][photo_path]\" id='img"+i+"'/>\n\
                            </td>\n\
                            <td class='area'><textarea placeholder='本项可不编辑文字。无文字时，前台不显示本框。字数不限' name=\"articleDetail["+i+"][content]\" rows=\"10\" cols=\"57\"></textarea></td>\n\
                            <td><input class='sort' type='text' value='' name=\"articleDetail["+i+"][sort]\"  onkeyup='value=value.replace(/[^\\d]/g,\"\")'></td>\n\
                            <td align='center'>\n\
                                <a class='tw-tool-btn-del' onclick='deleteLine(this)'><i class='tw-icon-minus-circle'></i> &nbsp;&nbsp;删除&nbsp;&nbsp;</a>\n\
                            </td>\n\
                        </tr>";
            var newCommoditySelection = "<tr>\n\
                            <td>\n\
                                <img src='' style='height:100px; width:100px; color:#ccc; display: none;' id='img_"+i+"'/>\n\
                                <span>\n\
                                    <input class='btn' type='button' style='margin-top:15px;height:30px; display: none;' value='上传' id='btnUpload"+i+"' onclick='manyPicture("+i+")'/>\n\
                                </span>\n\
                                <input type='hidden' class='count-suffix' value='' name=\"articleDetail["+i+"][photo_path]\" id='img"+i+"'/>\n\
                                <input type='hidden' value='' name=\"articleDetail["+i+"][record_id]\" id='recordId"+i+"'/>\n\
                            </td>\n\
                            <td class='area'><textarea placeholder='本项可不编辑文字。无文字时，前台不显示本框。字数不限' name=\"articleDetail["+i+"][content]\" rows=\"10\" cols=\"57\"></textarea></td>\n\
                            <td><input  onkeyup='value=value.replace(/[^\\d]/g,\"\")' class='sort' type='text' value='' name=\"articleDetail["+i+"][sort]\"></td>\n\
                            <td align='center'>\n\
                                <a class='tw-tool-btn-del'  onclick='deleteLine(this)' style='display: none;' id='del_"+i+"'><i class='tw-icon-minus-circle'></i> &nbsp;&nbsp;删除&nbsp;&nbsp;</a>\n\
                                <a class='tw-tool-btn-view' onclick='commoditySelection("+i+")' id='goodsSelect_"+i+"'><i class='tw-icon-check-square-o'></i> &nbsp;&nbsp;商品选择&nbsp;&nbsp;</a>\n\
                            </td>\n\
                        </tr>";
            if ( <?php echo ($type); ?>==3 || <?php echo ($type); ?>==4 ) {                
                $("#options_tr").append(newCommoditySelection);
            } else {
                $("#options_tr").append(newRow);                
            }            
            manyPicture(i);
            i++;
        }

        if (<?php echo ($type); ?>== 1) {
            $('#mark').attr('placeholder', '最多可输入30个字符！');
            $(function(){
                $('#mark').on('input propertychange', function() {
                    var $this = $(this);
                    var val = $this.val();
                    if (val.length > 30) {
                        $this.val(val.substring(0, 30));
                    }  
                });
            })
        }
        
        function manyPicture(i){
            ajaxUploadAll('#btnUpload'+i, '#img'+i, 'Temp', ''+i, <?php echo ($type); ?>, <?php echo ($photoAccessInfo); ?>, <?php echo ($vidioAccessInfo); ?>,true,'Article');       
        }
        
        // i传输的是-1就表示为是主商品选择
        function commoditySelection(i){
            var url = "<?php echo U('Article/getGoodsPics');?>/imgId/"+i;           
            var title = '商品图片选择';
            layParams = new Array();
            layParams['type']            = 2;
            layParams['shadeClose']      = true;
            layParams['shade']           = 0.8;
            layParams['width']           = '800px';
            layParams['height']          = '500px';
            layParams['titleColor']      = '#fff';
            layParams['titleBackground'] = '#aaa';
            
            layer.open({
                type: layParams['type'], 
                shadeClose: layParams['shadeClose'],
                shade: layParams['shade'],
                area: [layParams['width'], layParams['height']],
                title:  [title, 'color: '+ layParams['titleColor'] +'; background:'+ layParams['titleBackground'] +';'],
                content: url
            });
        }
        
        function getGoodsIdAndImg(checkbox, shopName, shopImg, imgId){
            if( imgId == -1 ) {
                $("#goodsid").val(checkbox);
                $("#goodsname").val(shopName);
            } else {
                $("#del_"+imgId).show();// 将删除按钮显示出来
                $("#shear"+imgId).show();// 将剪切按钮显示出来
                $("#btnUpload"+imgId).show();// 将上传按钮显示出来
                $("#goodsSelect_"+imgId).hide();// 将商品选择按钮隐藏起来
                $("#img_"+imgId).attr('src', shopImg).show();
                $("#img"+imgId).val(shopImg);
                $("#recordId"+imgId).val(checkbox);                
            }
        }        
        
        function deleteLine(obj){
            if(confirm('确认删除该条数据，删除提交后无法恢复？')){
                $(obj).parent().parent().remove();
                 i--;               
            }
        }
        
    </script>

</body>
</html>