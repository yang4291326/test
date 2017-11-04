<?php
namespace Banner\Model;
use Think\Model;
/**
 * 前台轮播图模型.
 * @author wangwujiang QQ:1358140190
 */
class BannerModel extends Model{

    protected $selectFields = array('id', 'title', 'img', 'sort', 'open_type', 'url', 'goods_id', 'is_default', 'type');
    //轮播图列表
    public function bannerList($where, $field=null, $order='sort asc, id desc'){
        if ($field == null) {
            $field = $this->selectFields;
        }
        $list = $this->where($where)->field($field)->order($order)->select();
        return $list;
    }

}