<?php

/**
 * 前台配置文件
 * 所有除开系统级别的前台配置
 */
return array(

    /* 文件上传相关配置 */
    'DOWNLOAD_UPLOAD' => array(
        'mimes'    => '', //允许上传的文件MiMe类型
        'maxSize'  => 8*1024*1024, //上传的文件大小限制 (0-不做限制)
        'exts'     => 'jpg,gif,png,jpeg,zip,rar,tar,gz,7z,doc,docx,txt,xml', //允许上传的文件后缀
        'autoSub'  => true, //自动子目录保存文件
        'subName'  => array('date', 'Y-m-d'), //子目录创建方式，[0]-函数名，[1]-参数，多个参数使用数组
        'rootPath' => './Uploads/Download/', //保存根路径
        'savePath' => '', //保存路径
        'saveName' => array('uniqid', ''), //上传文件命名规则，[0]-函数名，[1]-参数，多个参数使用数组
        'saveExt'  => '', //文件保存后缀，空则使用原后缀
        'replace'  => false, //存在同名是否覆盖
        'hash'     => true, //是否生成hash编码
        'callback' => false, //检测文件是否存在回调函数，如果存在返回文件信息数组
    ), //下载模型上传配置（文件上传类配置）

    /* 编辑器图片上传相关配置 */
    'EDITOR_UPLOAD' => array(
		'mimes'    => '', //允许上传的文件MiMe类型
		'maxSize'  => 2*1024*1024, //上传的文件大小限制 (0-不做限制)
		'exts'     => 'jpg,gif,png,jpeg', //允许上传的文件后缀
		'autoSub'  => true, //自动子目录保存文件
		'subName'  => array('date', 'Y-m-d'), //子目录创建方式，[0]-函数名，[1]-参数，多个参数使用数组
		'rootPath' => './Uploads/Editor/', //保存根路径
		'savePath' => '', //保存路径
		'saveName' => array('uniqid', ''), //上传文件命名规则，[0]-函数名，[1]-参数，多个参数使用数组
		'saveExt'  => '', //文件保存后缀，空则使用原后缀
		'replace'  => false, //存在同名是否覆盖
		'hash'     => true, //是否生成hash编码
		'callback' => false, //检测文件是否存在回调函数，如果存在返回文件信息数组
    ),

    /* 模板相关配置 */
    'TMPL_PARSE_STRING' => array(
        '__UPLOADS__'   => __ROOT__ . '/'. APP_NAME . '/Uploads/',
        '__IMG__'       => __ROOT__ . '/'. APP_NAME . '/Admin/Static/images',
        '__CSS__'       => __ROOT__ . '/'. APP_NAME . '/Admin/Static/css',
        '__JS__'        => __ROOT__ . '/'. APP_NAME . '/Admin/Static/js',
        '__PUBLIC_IMG__' => __ROOT__ . '/Public/Static/images',
        '__COMMON__'     => __ROOT__ . '/'. APP_NAME . '/Common/Static',
        '__MAIN__'       => __ROOT__ . '/'. APP_NAME . '/Admin/Static/main',
    ),

    /* SESSION 和 COOKIE 配置 */
    'SESSION_PREFIX' => 'ln_admin', //session前缀
    'COOKIE_PREFIX'  => 'ln_admin_', // Cookie前缀 避免冲突
    'VAR_SESSION_ID' => 'session_id',	//修复uploadify插件无法传递session_id的bug


    // 第三方环信账号信息 -- by zhaojiping
    'EMCHAT' => array(
        'client_id' => 'YXA6bKCyEJAhEeazAbmp47B2nQ',
        'client_secret' => 'YXA6mQnBDFXb0i54oZhm_KOU7-NJrgs',
        'org_name' => 'lunanzhiyaodevelop',
        'app_name' => 'lnzy',
        ),
);
