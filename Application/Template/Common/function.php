<?php

function show_article_type($type) {
    switch ($type) {
        case 0  : return    '背景介绍';   break;
        case 1  : return    '二维码模板';   break;
        case 2  : return    '实例分享模板';   break;
        case 3  : return    '收藏夹模板';   break;
        case 4  : return    '首页模板';   break;
        case 5  : return    '解决方案模板';   break;
        default : return    '';      break;
    }
}
?>