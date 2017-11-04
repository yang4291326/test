<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <title><?php echo C('WEB_SITE_TITLE');?></title>
    <link href="/furnitureshop/Public/favicon.ico" type="image/x-icon" rel="shortcut icon">
    <link rel="stylesheet" type="text/css" href="/furnitureshop/Application/Admin/Static/css/base.css" media="all">
    <link rel="stylesheet" type="text/css" href="/furnitureshop/Application/Admin/Static/css/common.css" media="all">
    <link rel="stylesheet" type="text/css" href="/furnitureshop/Application/Admin/Static/css/module.css">
    <link rel="stylesheet" type="text/css" href="/furnitureshop/Application/Admin/Static/css/style.css" media="all">
    <link rel="stylesheet" type="text/css" href="/furnitureshop/Application/Admin/Static/css/default_color.css" media="all">
    <link rel="stylesheet" type="text/css" href="/furnitureshop/Public/toastr/toastr.css" media="all">
    <!--[if lt IE 9]-->
    <script type="text/javascript" src="/furnitureshop/Application/Admin/Static/js/jquery-1.10.2.min.js"></script>
    <!--[endif]-->
    <script type="text/javascript" src="/furnitureshop/Application/Admin/Static/js/jquery-2.0.3.min.js"></script>
    <style type="text/css">
        .header{min-width: 1004px;}
        html { overflow-x: auto; overflow-y: hidden; }

        .logo-img {
            height:50px;
        }
        .header .logo {
            float: left;
            margin-left: 60px;
            width: 140px;
        }
    </style>
    
</head>
<body id="mainbody">
    <!-- 头部 -->
    <div class="header">
        <!-- Logo -->
        <span class="logo"><img src='/Public/logo.png' class="logo-img">
        </span>
        <!-- /Logo -->

        <!-- 主导航 -->
        <ul class="main-nav" id="menu-nav"></ul>
        <!-- /主导航 -->

        <!-- 用户栏 -->
        <div class="user-bar">
            <a href="javascript:;" class="user-entrance"><i class="icon-user"></i></a>
            <ul class="nav-list user-menu hidden">
                <li class="manager">你好，<em title="<?php echo session('user_auth.username');?>"><?php echo session('admin_auth.username');?></em></li>
                <li><a href="<?php echo U('Member/adminSetting');?>" target="mainIframe">个人信息设置</a></li>
                <li><a href="<?php echo U('Public/logout');?>">退出</a></li>
            </ul>
        </div>
    </div>
    <!-- /头部 -->

    <!-- 边栏 -->
    <div class="sidebar" id="sidebar">
        <!-- 子导航 -->
        <div id="subnav" class="subnav"></div>
        <!-- /子导航 -->
    </div>
    <!-- /边栏 -->

    <!-- 内容区 -->
    <div id="main-content">
        <div id="main" class="main">
            <iframe src="<?php echo U('Admin/Index/welcome');?>" name="mainIframe" id="mainIframe" style="height:100%; width:100%; border: 0px;" frameborder="0"></iframe>
        </div>
    </div>
    <!-- /内容区 -->
    <!--[if gte IE 9]><!-->
    <script type="text/javascript" src="/furnitureshop/Application/Admin/Static/js/jquery.mousewheel.js"></script>
    <!--<![endif]-->
    <script type="text/javascript" src="/furnitureshop/Public/toastr/toastr.js" ></script>
    <script type="text/javascript" src="/furnitureshop/Public/assets/plugins/layer-v2.0/layer/layer.js"></script>
    <script type="text/javascript" src="/furnitureshop/Public/assets/plugins/laydate-v1.1/laydate/laydate.js"></script>
    <script type="text/javascript" src="/furnitureshop/Public/assets/js/common.js"></script>
    <script type="text/javascript">
    (function(){
        var ThinkPHP = window.Think = {
            "ROOT"   : "/furnitureshop", //当前网站地址
            "APP"    : "/furnitureshop/index.php", //当前项目地址
            "PUBLIC" : "/furnitureshop/Public", //项目公共目录地址
            "DEEP"   : "<?php echo C('URL_PATHINFO_DEPR');?>", //PATHINFO分割符
            "MODEL"  : ["<?php echo C('URL_MODEL');?>", "<?php echo C('URL_CASE_INSENSITIVE');?>", "<?php echo C('URL_HTML_SUFFIX');?>"],
            "VAR"    : ["<?php echo C('VAR_MODULE');?>", "<?php echo C('VAR_CONTROLLER');?>", "<?php echo C('VAR_ACTION');?>"]
        }
    })();
    </script>
    <script type="text/javascript" src="/furnitureshop/Application/Admin/Static/js/common.js"></script>
    <script type="text/javascript">
        var MENU = <?php echo ($menus); ?>;

        function CreatNav (nav, obj) {
            
            var str = '';
            for (var key in nav) {
                // console.log(key);
                str += '<h3><i class="icon icon-unfold"></i>'+ key +'</h3>';

                var len = nav[key].length;
                str += '<ul class="side-sub-menu">'
                for (var i = 0; i < len; i++) {
                    str += '<li><a href="/index.php/'+ nav[key][i]['url'] +'"  class="item" target="mainIframe"><span class="ico nav-list"></span>'+ nav[key][i]['title'] +'</a></li>';
                };
                str += '</ul>';

            }

            //填充到导航行栏
            $('#subnav').html(str);

            // 主菜单切换样式
            // console.log(nav['child']);
            $('#menu-nav li a').css('background', 'none');
            $(obj).css('background', 'rgba(48, 165, 255, 0.8)');
            // 子菜单切换样式
            $('#subnav li').click(function(){
                $('#subnav li').css('background', '');
                $(this).css('background', 'rgba(48, 165, 255, 0.8)');
            })
            //默认展示第一个二级菜单
            $("#sidebar .subnav h3").removeClass("curh");
            $("#sidebar .subnav").children("h3").first().addClass("curh");

            $("#sidebar .subnav").children("ul").first().addClass("cur");
            $("#sidebar .subnav").children("ul").not(".cur").slideUp("fast");
            slideUpOrDownMenu();
        }

        function CreatMenu () {
            var len = MENU.length;
            for (var i = 0; i < len; i++) {
                //alert(MENU[i][0]);
                //填充到菜单栏 
                $('#menu-nav').append('<li><a href="javascript:void(0)" onclick="javascript:CreatNav(MENU['+ i +'][\'child\'], this)">' + MENU[i]['title'] + '</a></li>');
            };

            //默认点击
            $('#menu-nav li:first-child a').click();
        }

        function ResizeWindow(){
            h = $(window).height();
            w = $(window).width();

            topHeight = $('.header').outerHeight(true);
            
            $('#sidebar, #main, #mainIframe').height(h - topHeight);
            $('#main, #mainIframe').width(w - $('#sidebar').outerWidth(true) );
        }

        $(function(){
            //生成菜单和左侧导航
            CreatMenu();

            //定位
            ResizeWindow();
            $(window).resize(function(){
                ResizeWindow();
            })
            //默认展示第一个二级菜单
            $("#sidebar .subnav h3").removeClass("curh");
            $("#sidebar .subnav").children("h3").first().addClass("curh");

            $("#sidebar .subnav").children("ul").first().addClass("cur");
            $("#sidebar .subnav").children("ul").not(".cur").slideUp("fast");
            slideUpOrDownMenu();
        })

        function slideUpOrDownMenu(){
            //点击菜单组
            $("#sidebar .subnav h3").click(function(){
                $("#sidebar .subnav h3").removeClass("curh");
                $(this).addClass("curh");
                $("#sidebar .subnav ul").removeClass("cur");
                $(this).next().addClass("cur");
                $(this).next().slideDown("fast");
                $(this).siblings('ul').not(".cur").slideUp("fast");
            })
        }

		/* 头部管理员菜单 */
        $(".user-bar").mouseenter(function(){
            var userMenu = $(this).children(".user-menu ");
            userMenu.removeClass("hidden");
            clearTimeout(userMenu.data("timeout"));
        }).mouseleave(function(){
            var userMenu = $(this).children(".user-menu");
            userMenu.data("timeout") && clearTimeout(userMenu.data("timeout"));
            userMenu.data("timeout", setTimeout(function(){userMenu.addClass("hidden")}, 100));
        });
    </script>
    
</body>
</html>