<?php
namespace Common\Controller;
/**
 * 用户登录后, 需要继承的基类
 * create by zhaojiping <QQ: 17620286>
 */
class CommonWebController extends CommonController {

    protected function _initialize(){
    	// //记录当前用户id
        // define('UID', is_login()['uid']);
        define('UID', user_is_login()['uid']);
        if( !UID ){// 还没登录 跳转到登录页面
            $this->redirect('/Member/Public/login');
        }
        $where['id'] = array('eq', UID);
        $disabled = M('Member')->where($where)->getfield('disabled');
        unset($where);
        if ($disabled == 1) {
            session(null);
            $this->redirect('/Member/Public/login');
        }
        /* 读取数据库中的配置 */
        $config =   S('DB_CONFIG_DATA');
        if(!$config){
            $config = api('Config/lists');
            S('DB_CONFIG_DATA',$config);
        }
        C($config); //添加配置


    }

}
