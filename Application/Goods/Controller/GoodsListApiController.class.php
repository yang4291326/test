<?php
namespace Goods\Controller;

/**
 * Created by liuniukeji.com
 * 商品列表接口
 * @author goryua <1661745274@qq.com>
*/
class GoodsListApiController extends \Common\Controller\CommonApiController {
    
    public function index($parent_id){
        echo "s";
        exit;
        //$parent_id = I('category_id', 0, 'intval');
        //获取分类信息
        $category_info = D('Goods/ShopGoodsType')->getCategoryInfo(array('id'=>$parent_id), 'name');

        //获取子类id
        $get_son_id = getChildIds('shop_goods_type', $parent_id);
        $where['goods_category_id'] = array('in', implode(',', $get_son_id));
        $where['status'] = array('eq', 0);
        $goods_list = D('Goods/ShopGoods')->getGoodsList($where, 'id, goods_img', '', '1,3,4');
        if (empty($goods_list)) {
            $this->apiReturn(0, '该分类下商品为空');
        }
        //取出商户收藏商品id
        $fav_goods_id = D('Goods/Favorite')->getFavGoodsId(array_keys($goods_list));
        //取出商户可用vr商品id
        $vr_goods_id = D('Goods/ShopGoodsModel')->getVrGoodsId(array_keys($goods_list));
        
        $data['title'] = $category_info['name'];
        $m = 0;
        foreach ($goods_list as $key => $value) {
            $data['goods_list'][$m]['goods_id'] = $value['id'];
            $data['goods_list'][$m]['goods_name'] = $value['attr_value'][1]['attr_value']; // 商品标题
            $data['goods_list'][$m]['goods_price'] = $value['attr_value'][3]['attr_value']; //商品原价
            $data['goods_list'][$m]['sale_price'] = $value['attr_value'][4]['attr_value']; //商品现价
            $data['goods_list'][$m]['photo_path'] = $value['goods_img'];
            $data['goods_list'][$m]['is_fav'] = in_array($value['id'], $fav_goods_id) ? 1 : 0;
            $data['goods_list'][$m]['is_vr'] = in_array($value['id'], $vr_goods_id) ? 1 : 0;
            $m++;
        }
        return $data;
        //$this->apiReturn(1, '商品列表', $data);
    }



}
