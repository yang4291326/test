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
			菜单管理
		</div>
		<?php if(!empty($prompt_tips)): ?><div class="tw_list_tips">
				<div class="tips-name">提示语：</div>
				<div class="tips-content"><?php echo ($prompt_tips); ?></div>
			</div><?php endif; ?>
	   <div class="tw-list-top">
				<div class="tw-tool-bar">
	    		<a class="tw-tool-btn-add" href="<?php echo U('add',array('pid'=>I('get.pid',0)));?>">
	                <i class="tw-icon-plus-circle"></i> 添加
	            </a>
	    		<a class="tw-tool-btn-del" onclick="javascript:recycle('chkbId', '确认删除?!此步骤无法恢复!',true)">
	                <i class="tw-icon-minus-circle"></i> 批量删除
	            </a>
	            <a class="tw-tool-btn-setting" href="<?php echo U('sort',array('pid'=>I('get.pid',0)),'');?>" >
	                <i class="tw-icon-cogs"></i> 排序
	            </a>
	          </div>
	        <form action="/index.php/Admin/Menu/index" method="post" id='frmSearch'>
                <div class="tw-search-bar">
			        <!-- 高级搜索 -->
			        <div class="search-form fr cf">
			            <div class="sleft">
							<input type="hidden"  name='pid' value="<?php echo I('pid');?>">
			                <input type="text" name="title" class="search-input" value="<?php echo I('title');?>" placeholder="请输入菜单名称">
			                <a type="submit" class="sch-btn" onclick="$('#frmSearch').submit();"><i
                                    class="btn-search"></i></a>
			            </div>
			        </div>
		        </div>
            </form>
	    </div>
		
		<div class="tw-list-wrap">
	            <table class="tw-table tw-table-list tw-table-fixed">
	                <colgroup>
	                    <col width="50">
	                    <col width="50">
	                    <col width="150">
	                    <col width="100">
	                    <col width="100">
	                    <col width="150">
	                    <col width="50">
	                    <col width="50">
	                    <col width="250">
	                </colgroup>
	                <thead>
	                    <tr>
	                        <th class="row-selected">
	                            <input class="checkbox check-all" type="checkbox">
	                        </th>
	                        <th>序号</th>
	                        <th>名称</th>
	                        <th>上级菜单</th>
	                        <th>分组</th>
	                        <th>URL</th>
	                        <th>排序</th>
	                        <th>展示</th>
	                        <th>操作</th>
	                    </tr>
	                </thead>
	                <tbody>
	                	<?php if(!empty($list)): if(is_array($list)): $k = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$menu): $mod = ($k % 2 );++$k;?><tr>
			                        <td><input class="ids row-selected" type="checkbox" name="chkbId" value="<?php echo ($menu["id"]); ?>"></td>
			                        <td><?php echo (page_code($k)); ?></td>
			                        <td class="text-left"><?php echo ($menu["title"]); ?></td>
			                        <td><?php echo ((isset($menu["up_title"]) && ($menu["up_title"] !== ""))?($menu["up_title"]):'无'); ?></td>
			                        <td><?php echo ($menu["group"]); ?></td>
			                        <td class="text-left"><?php echo ($menu["url"]); ?></td>
			                        <td><?php echo ($menu["sort"]); ?></td>
			                        <td>
			                            <?php echo ($menu["display_text"]); ?>
			                        </td>
			                        <td>
				                        <a class="tw-tool-btn-copy" href="<?php echo U('index?pid='.$menu['id']);?>">
							                <i class="tw-icon-copy"></i> 子菜单
							            </a>
			                        
				                        <a class="tw-tool-btn-edit" href="<?php echo U('edit?id='.$menu['id']);?>">
							                <i class="tw-icon-pencil"></i> 修改
							            </a>
							            <a class="tw-tool-btn-del" onclick="javascript:recycle(<?php echo ($menu['id']); ?>, '确认删除?!此步骤无法恢复!',true)">

							                <i class="tw-icon-minus-circle"></i> 删除
							            </a>
			                        </td>
			                    </tr><?php endforeach; endif; else: echo "" ;endif; ?>
						<?php else: ?>
							<td colspan="9" class="text-center"> aOh! 暂时还没有内容! </td><?php endif; ?>
					</tbody>
		</table>
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
        $(function() {
            //点击排序
        	$('.list_sort').click(function(){
        		var url = $(this).attr('url');
        		var ids = $('.ids:checked');
        		var param = '';
        		if(ids.length > 0){
        			var str = new Array();
        			ids.each(function(){
        				str.push($(this).val());
        			});
        			param = str.join(',');
        		}

        		if(url != undefined && url != ''){
        			window.location.href = url + '/ids/' + param;
        		}
        	});
        });
    </script>

</body>
</html>