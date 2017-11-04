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
    </style>

</head>
<body>
    
    <!-- 内容区 -->
    <div id="content">
        
    <div class="tw-layout">
        <div class="tw-list-hd"><?php echo isset($info['id'])?'编辑':'新增';?>用户</div>
        <form action="/index.php/Admin/Member/edit/id/2" method="post" class="ajaxForm">
            <div class="tw-list-wrap tw-edit-wrap">
                <table class="wf-form-table">
                    <colgroup>
                        <col width="15%">
                        <col width="35%">
                        <col width="15%">
                        <col width="35%">
                    </colgroup>
                    <tbody>
                        <tr>
                            <th colspan="4" class="information"><div class="fl offset">用户信息</div></th>
                        </tr>

                        <tr>
                            <th><em>*</em>登录名:</th>
                            <td>
                                <input type="text" class="text input-5x" name="member[user_name]" value="<?php echo ($info['user_name']); ?>" placeholder="4-20位字母或数字, 首字符必须为字母" id="username">
                            </td>
                            <th>用户类型:</th>
                            <td>                    
                                <?php if(($type == 1) OR ($info['type'] == 1) ): ?><input type="hidden" value="1" name="member[type]">管理员
                                <?php elseif(($type == 0) OR ($info['type'] == 0)): ?>
                                    <input type="hidden" value="0" name="member[type]">商户<?php endif; ?>                    
                            </td>
                        </tr> 

                        <tr>
                            <th><em>*</em>登录密码:</th>
                            <td>
                                <input type="password" id="password" class="text input-5x" name="member[password]" value="" placeholder = "<?php if($info["id"] <= 0): ?>用户登录密码, 4位及以上<?php else: ?>如果不修改, 请留空(4位以上字符)<?php endif; ?>">
                            </td>
                            <th><em>*</em>确认登录密码:</th>
                            <td>
                                <input type="password" id="re_password" class="text input-5x" name="member[re_password]" value="" placeholder="再次输入登录密码">
                            </td>
                        </tr>

                        <tr>
                            <th>启用状态:</th>
                            <td>
                                <label class="wf-form-label-rc">
                                    <input type="radio" value="0" name="member[disabled]" id="isUserTure" checked="checked"> 启用
                                </label>
                                <label class="wf-form-label-rc">
                                        <input type="radio" value="1" name="member[disabled]" id="isUserFalse" > 禁用
                                </label>
                                <?php if($info['disabled'] == 1): ?><script>
                                        $('#isUserFalse').attr('checked', 'checked');
                                    </script><?php endif; ?>
                            </td>
                        <tr>
                            <th colspan="4" class="information"><div class="fl offset">附加信息</div></th>
                        </tr>
                        
                        <?php $__FOR_START_2018__=0;$__FOR_END_2018__=count($mergeUserAttribute);for($i=$__FOR_START_2018__;$i < $__FOR_END_2018__;$i+=1){ ?><tr>
                                <th><?php if($mergeUserAttribute[$i]['attr_require'] == 1): ?><em>*</em><?php endif; echo ($mergeUserAttribute[$i]['attr_name']); ?><input type="hidden" name="userAttributeName[<?php echo ($mergeUserAttribute[$i]['id']); ?>]" value="<?php echo ($mergeUserAttribute[$i]['attr_name']); ?>"></th>
                                <?php if($mergeUserAttribute[$i]['attr_type'] == 2): ?><td>
                                        <select name="userAttributeValue[<?php echo ($mergeUserAttribute[$i]['id']); ?>]" id="option_<?php echo ($i); ?>_id">
                                            <option value="0">-----请选择-----</option>
                                                <?php $__FOR_START_17968__=0;$__FOR_END_17968__=count($mergeUserAttribute[$i]['attr_value']);for($k=$__FOR_START_17968__;$k < $__FOR_END_17968__;$k+=1){ ?><option value="<?php echo ($mergeUserAttribute[$i]['attr_value'][$k]); ?>"><?php echo ($mergeUserAttribute[$i]['attr_value'][$k]); ?></option><?php } ?>
                                        </select>
                                        <script>
                                            $('#option_<?php echo ($i); ?>_id').val("<?php echo ((isset($mergeUserAttribute[$i]['user_attr_value']) && ($mergeUserAttribute[$i]['user_attr_value'] !== ""))?($mergeUserAttribute[$i]['user_attr_value']):0); ?>");
                                        </script>
                                    </td>
                                <?php else: ?>
                                    <td> 
                                        <input type="text" class="text input-5x" name="userAttributeValue[<?php echo ($mergeUserAttribute[$i]['id']); ?>]" value="<?php echo ($mergeUserAttribute[$i]['user_attr_value']); ?>" id="option_<?php echo ($i); ?>_id">
                                        <script>
                                            if (<?php echo ($mergeUserAttribute[$i]['arrt_control']); ?> == 1) { 
                                                $('#option_<?php echo ($i); ?>_id').attr("onclick", "laydate({format: 'YYYY-MM-DD', istime:false, festival: true})");                                                
                                            } else if(<?php echo ($mergeUserAttribute[$i]['arrt_control']); ?> == 2) {
                                                $('#option_<?php echo ($i); ?>_id').attr("placeholder", "请输入邮箱格式！"); 
                                            }
                                            if (<?php echo ($mergeUserAttribute[$i]['is_edit']); ?> == 0) { 
                                                $('#option_<?php echo ($i); ?>_id').attr("disabled", "true");                                                
                                            }
                                        </script>
                                    </td><?php endif; ?>

                                <?php $i++;?>
                                <?php if($mergeUserAttribute[$i] != null): ?><th><?php if($mergeUserAttribute[$i]['attr_require'] == 1): ?><em>*</em><?php endif; echo ($mergeUserAttribute[$i]['attr_name']); ?><input type="hidden" name="userAttributeName[<?php echo ($mergeUserAttribute[$i]['id']); ?>]" value="<?php echo ($mergeUserAttribute[$i]['attr_name']); ?>"></th>
                                    <?php if($mergeUserAttribute[$i]['attr_type'] == 2): ?><td>
                                            <select name="userAttributeValue[<?php echo ($mergeUserAttribute[$i]['id']); ?>]" id="option_<?php echo ($i); ?>_id">
                                                <option value="0">-----请选择-----</option>
                                                    <?php $__FOR_START_26483__=0;$__FOR_END_26483__=count($mergeUserAttribute[$i]['attr_value']);for($k=$__FOR_START_26483__;$k < $__FOR_END_26483__;$k+=1){ ?><option value="<?php echo ($mergeUserAttribute[$i]['attr_value'][$k]); ?>"><?php echo ($mergeUserAttribute[$i]['attr_value'][$k]); ?></option><?php } ?>
                                            </select>
                                            <script>
                                                $('#option_<?php echo ($i); ?>_id').val("<?php echo ((isset($mergeUserAttribute[$i]['user_attr_value']) && ($mergeUserAttribute[$i]['user_attr_value'] !== ""))?($mergeUserAttribute[$i]['user_attr_value']):0); ?>");
                                            </script>
                                        </td>
                                    <?php else: ?>
                                        <td> 
                                            <input type="text" class="text input-5x" name="userAttributeValue[<?php echo ($mergeUserAttribute[$i]['id']); ?>]" value="<?php echo ($mergeUserAttribute[$i]['user_attr_value']); ?>" id="option_<?php echo ($i); ?>_id">
                                            <script>
                                                if (<?php echo ($mergeUserAttribute[$i]['arrt_control']); ?> == 1) { 
                                                    $('#option_<?php echo ($i); ?>_id').attr("onclick", "laydate({format: 'YYYY-MM-DD', istime:false, festival: true})");                                                
                                                } else if(<?php echo ($mergeUserAttribute[$i]['arrt_control']); ?> == 2) {
                                                    $('#option_<?php echo ($i); ?>_id').attr("placeholder", "请输入邮箱格式！"); 
                                                }
                                                if (<?php echo ($mergeUserAttribute[$i]['is_edit']); ?> == 0) { 
                                                    $('#option_<?php echo ($i); ?>_id').attr("disabled", "true");                                                
                                                }
                                            </script>
                                        </td><?php endif; endif; ?>
                            </tr><?php } ?>


                            <!-- <tr class="member_mechine_info">
                                <th colspan="4" class="information"><div class="fl offset">用户机器码表</div></th>
                            </tr>
                            <tr class="member_mechine_info">
                                <td colspan="4">
                                    <table class="content-table" id="family_relation_table">
                                        <colgroup>
                                            <col width="80%">
                                            <col width="20%">
                                        </colgroup>
                                        <thead>
                                            <tr>
                                                <th style="text-align:center;">用户机器码</th>
                                                <th style="text-align:center;">
                                                    <a class="tw-tool-btn-add" onclick="addFamilyRelationInfo()">
                                                        <i class="tw-icon-plus-circle"></i> &nbsp;&nbsp;增加&nbsp;&nbsp;
                                                    </a>
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody id="infotbody">
                                        <?php if(is_array($memberMachineCodeData)): $i = 0; $__LIST__ = $memberMachineCodeData;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
                                                <input type='hidden' name="memberMachineCodeData[<?php echo ($key); ?>][member_id]" value="<?php echo ($vo['member_id']); ?>">
                                                <td><input type="text" class="table-text" name="memberMachineCodeData[<?php echo ($key); ?>][machine_code]" value="<?php echo ($vo['machine_code']); ?>"></td>
                                                <td align="center">
                                                    <a class="tw-tool-btn-del" onclick="deleteLine(this)">
                                                        <i class="tw-icon-minus-circle"></i> &nbsp;&nbsp;删除&nbsp;&nbsp;
                                                    </a>
                                                </td>
                                            </tr><?php endforeach; endif; else: echo "" ;endif; ?>
                                        </tbody>
                                    </table>    
                                </td>
                            </tr>  -->

                        
	            </tbody>
                </table>
            </div>
            <div class="tw-tool-bar-bot">
                <input type="hidden" name="member[id]" value="<?php echo ($info['id']); ?>" >
                <input type="hidden" name="id" value="<?php echo ($info['id']); ?>" >
                <button type="submit" class="tw-act-btn-confirm">提交</button>
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
    
    <script type="text/javascript" src="/Public/assets/js/hex_sha1.js"></script>
    <script>
        
        // 密码验证和加密
        function validate(){
            var password = $('input[name="member[password]"]');
            var re_password = $('input[name="member[re_password]"]');

            if ($.trim(password.val()) != '' || $.trim(re_password.val()) != '') {
                if (password.val().length < 4 || password.val().length > 20) {
                    toastr.error('密码长度4-20位');
                    $('#password').val('');
                    $('#re_password').val('');
                    password.focus();
                    return false;
                }
                if (password.val() != re_password.val()) {
                    toastr.error('两次登录密码不相同');
                    $('#password').val('');
                    $('#re_password').val('');
                    password.focus();
                    return false;
                }
            }

            if ($.trim(password.val()) != '' || $.trim(re_password.val()) != '') {
                // 对发送出去的代码进行加密,  如果超过40位, 当做已经加密过, 不再加密
                if (password.val().length < 40 ) {
                    password.val( $.trim( hex_sha1( password.val() ) ) );
                    re_password.val( $.trim( hex_sha1( re_password.val() ) ) );
                    //console.log(hex_sha1(password.val()));
                }
            }
        }
        
        // 添加用户机器码记录关系
        if (<?php echo ($memberMachineCodeCount); ?> !== null) {
            m = <?php echo ($memberMachineCodeCount); ?>;
        } else {
            m = 0;
        }
        function addFamilyRelationInfo(){
            var newRow = "<tr>\n\
                        <input type='hidden' name=\"memberMachineCodeData["+m+"][member_id]\" value=\"<?php echo ($info[id]); ?>\">\n\
                        <td><input type='text' class='table-text' name=\"memberMachineCodeData["+m+"][machine_code]\"></td>\n\
                        <td align='center'><a class='tw-tool-btn-del' onclick='deleteLine(this)'><i class='tw-icon-minus-circle'></i> &nbsp;&nbsp;删除&nbsp;&nbsp;</a></td>\n\
                        </tr>";
            $("#family_relation_table tr:last").after(newRow);
            m++;
        }
        
        // 删除记录
        function deleteLine(obj){
            if(confirm('确认删除该条数据，删除后无法恢复？')){
                $(obj).parent().parent().remove();
            }
        }
        
        // 刚进入页面的时候判断属性值是否显示
        $(function(){
            if ( ("<?php echo ($info['type']); ?>" === "0") || ("<?php echo ($type); ?>" === "0") ) {
                $(".member_mechine_info").show();                
            } else {
                $(".member_mechine_info").hide();   
            }    
        }); 
   
    </script>

</body>
</html>