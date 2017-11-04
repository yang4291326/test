<?php
namespace Banner\Controller;
/**
 * 前台轮播图控制器
 * @author wangwujiang <1358140190@qq.com>
 */
class BannerApiController extends \Think\Controller{
    protected function apiReturn($status, $message='', $data=''){
        if ($status != 0 && $status != 1) {
            exit('参数调用错误 status');
        }

        if ($data != '' && C('APP_DATA_ENCODE') === true) {
            $data = json_encode($data); // 数组转为json字符串
            $aes = new \Common\Tools\Aes();
            $data = $aes->aes128cbcEncrypt($data); // 加密
        }

        if (is_null($data)) $data='';

        $this->ajaxReturn(V($status, $message, $data));
    }

    // 手机轮播图管理列表
    public function mobileBannerPicture(){
        $where['type'] = 1; // type轮播图类型  0表示手机APP启动页图片列表  1表示手机APP轮播图图片列表  2手机登录页背景图片
        $field = 'id, title, img, sort, open_type, url, goods_id';
        $data = $this->_bannerList($where, $field);
        $this->apiReturn(1, '手机轮播图列表', $data);
    }
    // 手机登录背景图\手机启动页管理
    public function mobileLoginPicture(){

        $where['type'] = array('in', '0, 2'); // type轮播图类型  0表示手机APP启动页图片列表  1表示手机APP轮播图图片列表  2手机登录页背景图片
        $field = 'title, img, sort';
        $result = $this->_bannerList($where, $field);
        $this->apiReturn(1, '手机登录背景图\手机启动页', $result);

    }
    // 根据条件查询banner图列表
    private function _bannerList($where, $field){
        $where['member_id'] = array('eq', UID);
        $where['status'] = 0;
        $Banner = D('Banner');
        $list = $Banner->bannerList($where, $field);
        return $list;
    }
}