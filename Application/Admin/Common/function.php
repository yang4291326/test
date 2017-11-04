<?php

/**
 * 检测用户是否登录
 * @return integer 0-未登录，大于0-当前登录用户ID
 */
function is_login(){
	$admin = session('admin_auth');
	if (empty($admin)) {
		return 0;
	} else {
		return $admin;
	}
}

// 获取数据的状态操作
function show_status($status) {
    switch ($status) {
        case 0  : return    '<span class = "status_0">正常</span>';     break;
        case 1  : return    '<span class = "status_1">禁用</span>';   break;
        default : return    false;      break;
    }
}

// 获取日志类型状态  日志类型  0 新增  1 修改 2 删除   3 登录  4 上传
function show_log_type($type) {
    switch ($type) {
        case 0  : return    '新增';     break;
        case 1  : return    '修改';   break;
        case 2  : return    '删除';   break;
        case 3  : return    '登录';   break;
        case 4  : return    '上传';   break;
        default : return    '';      break;
    }
}

// 获取日志的操作状态  0 成功  1 失败
function show_log_status($status) {
    switch ($status) {
        case 0  : return    '成功';     break;
        case 1  : return    '失败';   break;
        default : return    '';      break;
    }
}

// 获取数据的状态操作
function show_hide($hide) {
    switch ($hide) {
        case 0  : return    '<span class = "hide_0">显示</span>';   break;
        case 1  : return    '<span class = "hide_1">隐藏</span>';   break;
        default : return    false;      break;
    }
}
// 获取数据的状态操作
function show_disabled($disabled) {
    switch ($disabled) {
        case 0  : return    '<span class = "disabled_0">正常</span>';   break;
        case 1  : return    '<span class = "disabled_1">禁用</span>';   break;
        default : return    false;      break;
    }
}

/**
 * 根据状态生成按钮
 * @param int $id 主键ID
 * @param int $disabled 状态改变前的状态值
 * @return mixed
 */
function change_disabled($id = '', $disabled = '' ) {
    if ($id == '' || $disabled == '') {
        return '参数错误, 所需参数未传递';
    }
    switch ($disabled){
        case 0 :
            $str = '<a class="tw-tool-btn-stop" href="javascript:void(0)" onclick="javascript:change_disabled(\''. $id .'\', \''. $disabled .'\')" ><i class="tw-icon-crosshairs"></i> 禁用</a>';
            return $str;
            break;
        case 1 :
            $str = '<a class="tw-tool-btn-stop" href="javascript:void(0)" onclick="javascript:change_disabled(\''. $id .'\', \''. $disabled .'\')" ><i class="tw-icon-crosshairs"></i> 启用</a>';
            return $str;
            break;
        default :
            return false;
            break;
    }
}


// 分析枚举类型配置值 格式 a:名称1,b:名称2
function parse_config_attr($string) {
    $array = preg_split('/[,;\r\n]+/', trim($string, ",;\r\n"));
    if(strpos($string,':')){
        $value  =   array();
        foreach ($array as $val) {
            list($k, $v) = explode(':', $val);
            $value[$k]   = $v;
        }
    }else{
        $value  =   $array;
    }
    return $value;
}

/**
 * 获取配置的类型
 * @param string $type 配置类型
 * @return string
 */
function get_config_type($type = 0){
    $list = C('CONFIG_TYPE_LIST');
    return $list[$type];
}

/**
 * 获取配置的分组
 * @param string $group 配置分组
 * @return string
 */
function get_config_group($group = 0){
    $list = C('CONFIG_GROUP_LIST');
    return $group?$list[$group]:'';
}

function int_to_string(&$data,$map=array('status'=>array(1=>'正常',-1=>'删除',0=>'禁用',2=>'未审核',3=>'草稿'))) {
    if($data === false || $data === null ){
        return $data;
    }
    $data = (array)$data;
    foreach ($data as $key => $row){
        foreach ($map as $col=>$pair){
            if(isset($row[$col]) && isset($pair[$row[$col]])){
                $data[$key][$col.'_text'] = $pair[$row[$col]];
            }
        }
    }
    return $data;
}

// 13位时间戳转换时间
function microtime_format($tag, $time){
    if (!$tag) {
        $tag = 'Y-m-d H:i:s';
    }
    $time = $time/1000;
    list($usec, $sec) = explode(".", $time);
    $date = date($tag,$usec);
    return str_replace('x', $sec, $date);
}

// 上传附件
function uploadFiled(){
    $upload = new \Think\Upload();// 实例化上传类
    $upload->maxSize = 3145728 ;// 设置附件上传大小
    $upload->exts = array('jpg', 'gif', 'png', 'jpeg', 'doc', 'docx', 'ppt', 'pptx', 'pps', 'xls', 'xlsx', 'pot', 'vsd', 'rtf', 'wps', 'et', 'dps', 'pdf', 'txt');// 设置附件上传类型
    $upload->savePath = '/Uploads/uploadFileds/'; // 设置附件上传目录
    $info = $upload->upload();
    if (!$info) {// 上传错误提示错误信息
        return V(0, $upload->getError());
    } else {
        // 上传成功 获取上传文件信息    
        return V(1, $info);
    }
}

//将数组key还原成默认数字 多维数组只还原第一层
function restore_array($arr){
        if (!is_array($arr)){ 
            return $arr; 
        }
        $c = 0; $new = array();
        while (list($key, $value) = each($arr)){
            if (is_array($value)){
                $new[$c] = $value;
            }else { 
                $new[$c] = $value; 
            }
            $c++;
        }
        return $new;
}

// 获取属性类型
function show_attr_status($status) {
    switch ($status) {
        case 0  : return    '<span class = "status_0">文本</span>';   break;
        case 1  : return    '<span class = "status_1">数字</span>';   break;
        case 2  : return    '<span class = "status_2">枚举</span>';   break;
        default : return    false;      break;
    }
}

// 获取商品属性类型 0文本  1数字  2单选 3多选
function show_goods_attr_status($status) {
    switch ($status) {
        case 0  : return    '<span class = "status_0">文本</span>';   break;
        case 1  : return    '<span class = "status_1">数字</span>';   break;
        case 2  : return    '<span class = "status_2">单选</span>';   break;
        case 3  : return    '<span class = "status_3">多选</span>';   break;
        default : return    false;      break;
    }
}

// 获取升级方式
function show_upgrade_status($status) {
    switch ($status) {
        case 0  : return    '<span class = "status_0">下载页</span>';   break;
        case 1  : return    '<span class = "status_1">点击提示</span>';   break;
        case 2  : return    '<span class = "status_2">静默升级</span>';   break;
        default : return    false;      break;
    }
}

// 获取用户升级状态
function show_upgradeDetail_status($status) {
    switch ($status) {
        case 0  : return    '<span class = "status_0">未升级</span>';   break;
        case 1  : return    '<span class = "status_1">升级失败</span>';   break;
        case 2  : return    '<span class = "status_2">升级成功</span>';   break;
        default : return    false;      break;
    }
}

// 获取商品收藏夹类型 0 比较满意 1 感觉还好 2 再想一想
function show_favorite_like_level($status) {
    switch ($status) {
        case 0  : return    '比较满意';   break;
        case 1  : return    '感觉还好';   break;
        case 2  : return    '再想一想';   break;
        default : return    '';      break;
    }
}

// 显示模板分类
function show_article_type($type) {
    switch ($type) {
        case 0  : return    '背景介绍';   break;
        case 1  : return    '二维码模板';   break;
        case 2  : return    '实例分享模板';   break;
        case 3  : return    '收藏夹推荐';   break;
        case 4  : return    '首页模板';   break;
        case 5  : return    '解决方案模板';   break;
        default : return    '';      break;
    }
}
//根据分页返回编码
function page_code($num) {
    $page_size = C('PAGE_SIZE');
    $p = intval($_GET['p']);
    if ($p) {
        $data = ($p-1)*$page_size + $num;
    } else {
        $data = $num;
    }
    return $data;
}
//分割图片/文件,只返回文件名
function get_file_name($str='') {
    $data = explode('/', $str);
    return $data[5];
}