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
			菜单排序
	</div>
	<div class="tw-list-wrap tw-edit-wrap sort">
<!-- 			<div class="sort_top">
				查找：<input type="text"><button class="btn search" type="button">查找</button>
			</div> -->
			<div class="sort_center">
				<div class="sort_option">
					<select value="" size="8">
						<?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option class="ids" title="<?php echo ($vo["name"]); ?>" value="<?php echo ($vo["id"]); ?>"><?php echo ($vo["name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
					</select>
				</div>
				<div class="sort_btn">
					<a class="tw-tool-btn-copy top" href="javascript:void(0)">
					<i class="tw-icon-copy"></i> 第 一
					</a>
					<br>
					<br>
					<a class="tw-tool-btn-copy up" href="javascript:void(0)">
					<i class="tw-icon-copy"></i> 上 移
					</a>
					<br>
					<br>
					<a class="tw-tool-btn-copy down" href="javascript:void(0)">
					<i class="tw-icon-copy"></i> 下 移
					</a>
					<br>
					<br>
					<a class="tw-tool-btn-copy bottom" href="javascript:void(0)">
					<i class="tw-icon-copy"></i> 最 后
					</a>
				</div>
			</div>
			<div class="tw-tool-bar-bot">
            	<input type="hidden" name="ids">
                <button class="tw-act-btn-confirm">确 定</button>
                <button type="button" onclick="goback();" class="tw-act-btn-cancel">返回</button>
	        </div>
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
    
	<script type="text/javascript">
		$(function(){
			sort();
			$(".top").click(function(){
				rest();
				$("option:selected").prependTo("select");
				sort();
			})
			$(".bottom").click(function(){
				rest();
				$("option:selected").appendTo("select");
				sort();
			})
			$(".up").click(function(){
				rest();
				$("option:selected").after($("option:selected").prev());
				sort();
			})
			$(".down").click(function(){
				rest();
				$("option:selected").before($("option:selected").next());
				sort();
			})
			$(".search").click(function(){
				var v = $("input").val();
				$("option:contains("+v+")").attr('selected','selected');
			})
			function sort(){
				$('option').text(function(){return ($(this).index()+1)+'.'+$(this).text()});
			}

			//重置所有option文字。
			function rest(){
				$('option').text(function(){
					return $(this).text().split('.')[1]
				});
			}

			//获取排序并提交
			$('.tw-act-btn-confirm').click(function(){
				var arr = new Array();
				$('.ids').each(function(){
					arr.push($(this).val());
				});
				$('input[name=ids]').val(arr.join(','));
				$.post(
					"<?php echo U('sort');?>",
					{
					'ids' :  arr.join(',')
					},
					function(data){
						if(data.status == '1'){
							//window.location.reload();//原代码
			                toastr.success(data.info);
							/*杨yongjie  添加*/
							setTimeout(function(){
								window.location.href='/index.php/Admin/Article/index/type/<?php echo ($type); ?>';
							},1000);
							//window.location.reload();
							/*杨yongjie  添加*/
			            }else{
			                toastr.error(data.info);
			            }
					},
					'json'
				);
			});

			//点击取消按钮
			$('.sort_cancel').click(function(){
				window.location.href = $(this).attr('url');
			});
		})
	</script>

</body>
</html>