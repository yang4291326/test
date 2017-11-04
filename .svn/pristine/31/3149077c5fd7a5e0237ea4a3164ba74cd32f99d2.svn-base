<?php
namespace Goods\Controller;
use Think\Model;
/**
 * Created by liuniukeji.com
 * 商品接口
 * @author goryua <1661745274@qq.com>
*/
class GoodsApiController extends \Common\Controller\CommonApiController{
    
    /**
     * 商品详情
     */
    public function goodsDetail(){

        $goods_id = I('goods_id', 0, 'intval');
        if ($goods_id == 0) {
            $this->apiReturn(0, '非法参数goods_id');
        }

        $where['id'] = array('eq', $goods_id);
        $where['status'] = array('eq', 0);

        //获取商品基本信息
        $data['goods_info'] = D('ShopGoods')->getGoodsInfo($where);
        if ($data['goods_info']['goods_category_id']) {
            $data['goods_info']['two_category_id'] = $this->getTwoLevel($data['goods_info']['goods_category_id']);
        }
        //$data['goods_info']['is_vr'] = M('ShopGoodsModel')->where('goods_id='. $goods_id)->count();

        /*yangyongjie 添加*/
        $count= M('ShopGoodsModel')->query("select count(*) from ln_shop_goods_model where id in (select resource.model_id from ln_shop_goods_model_resource as resource
            where photo_resource_path is not null and photo_resource_path != '' 
            and group_no is not null and group_no != '' and 
            map_path is not null and map_path != '' and
            material_ball_name is not null and material_ball_name != '' ) and goods_id = $goods_id");
        $data['goods_info']['is_vr'] = $count[0]['count(*)'];
        //var_dump($data['goods_info']['is_vr']);die;
        /*yangyongjie 添加*/

        $goods_fav = M('favorite_detail')->where('goods_id='. $goods_id)->count();
        $data['goods_info']['is_fav'] = $goods_fav > 0 ? 1: 0;

        if (empty($data['goods_info']) && !is_array($data['goods_info'])) {
            $this->apiReturn(0, '该商品不存在');
        }

        //获取商品属性
        $data['goods_attr'] = D('ShopGoodsAttribute')->getGoodsAttrInfo($data['goods_info']);
        //获取商品颜色
        unset($where);
        $where['goods_id'] = array('eq', $data['goods_info']['id']);
        $data['goods_color'] = D('ShopGoods')->getDefaultColor($where);

        //获取商品尺寸
        $size_list = D('ShopGoods')->getBasicAttrValue($goods_id, 7);
        if ($size_list != '') {
            $data['goods_size'] = explode(',', $size_list);
        } else {
            $data['goods_size'] = array();
        }

        //获取商品详情
        $data['goods_detail'] = D('ShopGoods')->getDetailList($data['goods_info']['id']);

        $this->homeLogApi(UID, 13, '进入商品详情', 0, time() , '', $goods_id);

        $this->apiReturn(1, '商品详情', $data);
    }

    public function getGoodsDetailColorImg() {
        $goods_id = I('goods_id', 0, 'intval');
        $color = I('color_name', '');
        $where['goods_id'] = array('eq', $goods_id);
        $where['color'] = array('eq', $color);
        $color_list = M('shop_goods_color')->field('photo_path')->where($where)->select();
        $this->apiReturn(1, '商品颜色轮播图', $color_list);
    }

    /**
     * 为您推荐接口
     */
    public function toRecommend() {
        $goods_id = I('goods_id', 0, 'intval');
        if ($goods_id == 0) {
            $this->apiReturn(0, '参数错误！');
        }
        $where['article.member_id'] = array('eq', UID);
        $where['article.type'] = array('eq', 3);
        $where['article.status'] = array('eq', 0);
        $where['article.goods_id'] = array('eq',$goods_id);
        $field = 'article.id,article.name,detail.photo_path,detail.record_id';
        $list = D('Template/Article')->getArt($where, $field, 'article.sort asc');

        foreach ($list as $v) {
            $article_array[$v['record_id']] = $v; //以商品id作为键值
        }

        if (empty($article_array) && !is_array($article_array)) {
            $this->apiReturn(0, '推荐信息不存在');
        }

        $goods_id = array_keys($article_array);
        unset($where);
        $where['id'] = array('in', implode(',', $goods_id));
        $goods_list = D('ShopGoods')->getGoodsList($where, '', '', '1');

        foreach ($list as $key => $value) {
            $data[$key]['id'] = $value['id'];
            $data[$key]['goods_id'] = $value['record_id'];
            $data[$key]['photo_path'] = $value['photo_path'];
            $data[$key]['name'] = $goods_list[$value['record_id']]['attr_value'][1]['attr_value'];
        }

        $this->apiReturn(1, '为您推荐', $data);
    }

    public function getTwoLevel($cid) {
        $parent_id = M('shop_goods_type')->where(array('id'=>$cid))->getField('parent_id');
        $cate_info = M('shop_goods_type')->field('level,id')->where(array('id'=>$parent_id))->find();
        if ($cate_info['level'] == 3) {
            return $this->getTwoLevel($cate_info['id']);
        }
        return $cate_info['id'];
    }

    /*杨yongjie  添加*/

    //商品数量修改接口
    public function updateCount(){
        $id = I('post.id', '', 'intval');
        $goods_count=I('post.goods_count', '' , 'intval');
        $where['id']=$id;
        $data['goods_count']=$goods_count;
        $result=M('FavoriteDetail')->where($where)->save($data);
        if($result !== false){
            $this->apiReturn(1,'修改成功!');
        }else{
            $this->apiReturn(0,'修改失败!');
        }

    }
    //存储过程(按条件搜索)
    public function searchList(){
        $UserToken = I('post.token', '','trim');
        $CommodityName=I('post.CommodityName', '','trim');
        $CommodityStyle=I('post.CommodityStyle', '','trim');
        $CommodityType=I('post.CommodityType', '','trim');
        $CommodityPriceB=!empty($_POST['CommodityPriceB']) ? intval($_POST['CommodityPriceB']) : -1;
        $CommodityPriceS=!empty($_POST['CommodityPriceS']) ? intval($_POST['CommodityPriceS']) : -1;
        $M=new Model();
        //调用存储过程
        $sql="CALL SearchData('$UserToken','$CommodityName','$CommodityStyle','$CommodityType',$CommodityPriceB,$CommodityPriceS)";
        return $res=$M->query($sql);
    }
    //搜索商品接口
    public function searchGoods(){
        $res=$this->searchList();
        if($res===array('0'=>array(""=>""))){
            $this->apiReturn(0, '没有匹配商品');
        }else {
            $this->apiReturn(1, '商品列表', $res);
        }
    }
    //从搜索条件中筛选出有VR的单独返回
    public function Vrlist(){
        $res=$this->searchList();
        if($res) {
            foreach ($res as $k => $v) {
                if ($v['is_vr'] == 1) {
                    $data[] = $v;
                }
            }
            if(!empty($data)){
                $this->apiReturn(1, 'VR列表', $data);
            }else{
                $this->apiReturn(0, '没有VR模型');
            }

        }else{
            $this->apiReturn(0, '没有匹配商品');
        }
    }
    /*杨yongjie  添加*/
}
