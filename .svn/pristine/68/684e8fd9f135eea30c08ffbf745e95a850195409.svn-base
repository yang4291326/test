<?php
namespace Home\Controller;

/**
 * Created by liuniukeji.com
 * 首页模板
 * @author goryua <1661745274@qq.com>
*/
class IndexController extends \Common\Controller\CommonApiController {

    public function goodsApi() {
        $type = I('type', 0, 'intval'); //1首页模板 2商品列表
        $category_id = I('category_id', 0, 'intval');
        if ($type == 0) {
            $this->apiReturn(0, '类型参数错误');
        }
        if ($type == 1) {
            $data = $this->index();
        }
        if ($type == 2) {
            $data = $this->goodsList($category_id);
        }
        $this->apiReturn(1, '商品列表', $data);
    }
    /**
     * 首页模板接口
     */
    protected function index(){
        $where['article.member_id'] = UID;
        $where['article.type'] = array('eq', 4);
        $where['article.status'] = array('eq', 0);

        $field = 'article.id,article.name,detail.photo_path,detail.record_id';
        $list = D('Template/Article')->getArt($where, $field, 'article.sort asc');
        foreach ($list as $k => $v) {
            $article_array[$v['id']]['title'] = $v['name'];
            $article_array[$v['id']]['goods'][$v['record_id']]['photo_path'] = $v['photo_path'];
            $article_array[$v['id']]['goods'][$v['record_id']]['goods_id'] = $v['record_id'];
        }

        if (empty($article_array) && !is_array($article_array)) {
            $this->apiReturn(0, '首页模板不存在');
        }
        unset($where);
        $g_field = 'id';
        $goods_id_array = array();
        foreach ($article_array as $key => $value) {
            $goods_id = array_keys($article_array[$key]['goods']);
            $where['id'] = array('in', implode(',', $goods_id));
            $goods_list[$key] = D('Goods/ShopGoods')->getGoodsList($where, $g_field, 'id desc', '1,3,4,7,8,9');
            unset($where);
            $goods_id_array = array_merge($goods_id_array, $goods_id);
        }
        $all_goods_id = array_unique($goods_id_array);
        //取出商户收藏商品id
        $fav_goods_id = D('Goods/Favorite')->getFavGoodsId($all_goods_id);
        //取出商户可用vr商品id
        $vr_goods_id = D('Goods/ShopGoodsModel')->getVrGoodsIds($all_goods_id);
        //根据商品id取出商品颜色
        $color_where['goods_id'] = array('in', implode(',', $all_goods_id));
        $goods_color = D('Goods/ShopGoods')->getUniqueColor($color_where, 'id,goods_id');
        $m = 0;
        foreach ($article_array as $k => $list) {
            $data[$m]['title'] = $list['title'];
            $n = 0;
            foreach ($list['goods'] as $goods_key => $goods_value) {
                $data[$m]['goods'][$n]['goods_id'] = $goods_value['goods_id'];
                $data[$m]['goods'][$n]['goods_name'] = $goods_list[$k][$goods_key]['attr_value'][1]['attr_value']; // 商品标题
                $data[$m]['goods'][$n]['goods_price'] = $goods_list[$k][$goods_key]['attr_value'][3]['attr_value']; //商品原价
                $data[$m]['goods'][$n]['sale_price'] = $goods_list[$k][$goods_key]['attr_value'][4]['attr_value']; //商品现价
                $data[$m]['goods'][$n]['photo_path'] = thumb($goods_value['photo_path'], 485, 275);
                $data[$m]['goods'][$n]['goods_size'] = $this->getSize($goods_list[$k][$goods_key]['attr_value'][7]['attr_value']); //商品尺寸
                $data[$m]['goods'][$n]['goods_style'] = $goods_list[$k][$goods_key]['attr_value'][8]['attr_value']; //商品风格
                $data[$m]['goods'][$n]['goods_material'] = $goods_list[$k][$goods_key]['attr_value'][9]['attr_value']; //商品材料
                $data[$m]['goods'][$n]['goods_colorid'] = $goods_color[$goods_value['goods_id']] ? $goods_color[$goods_value['goods_id']]['id'] : 0; //商品颜色
                $data[$m]['goods'][$n]['is_fav'] = in_array($goods_value['goods_id'], $fav_goods_id) ? 1 : 0;
                $data[$m]['goods'][$n]['is_vr'] = in_array($goods_value['goods_id'], $vr_goods_id) ? 1 : 0;
                $n++;
            }
            $m++;
        }
        //var_dump($data);die;
        return $data;
    }

     /**
     * 商品列表接口
     */
    protected function goodsList($parent_id){
       
        //获取分类信息
        $category_info = D('Goods/ShopGoodsType')->getCategoryInfo(array('id'=>$parent_id), 'name');
        //获取子类id
        $get_son_id = getChildIds('shop_goods_type', $parent_id);
        $where['goods_category_id'] = array('in', implode(',', $get_son_id));
        $where['status'] = array('eq', 0);
        //var_dump($where);die;
        $goods_list = D('Goods/ShopGoods')->getGoodsListByPage($where, 'id, goods_img', '', '1,3,4,7,8,9');
        if (empty($goods_list['list'])) {
            $this->apiReturn(0, '该分类下商品为空');
        }
        //取出商户收藏商品id
        $fav_goods_id = D('Goods/Favorite')->getFavGoodsId(array_keys($goods_list['list']));
        //取出商户可用vr商品id
        $vr_goods_id = D('Goods/ShopGoodsModel')->getVrGoodsIds(array_keys($goods_list['list']));
        //var_dump($vr_goods_id);die();
        //根据商品id取出商品颜色
        $color_where['goods_id'] = array('in', implode(',', array_keys($goods_list['list'])));
        $goods_color = D('Goods/ShopGoods')->getUniqueColor($color_where, 'id,goods_id');
        
        $data['title'] = $category_info['name'];
        $m = 0;
        foreach ($goods_list['list'] as $key => $value) {
            $data['goods'][$m]['goods_id'] = $value['id'];
            $data['goods'][$m]['goods_name'] = $value['attr_value'][1]['attr_value']; // 商品标题
            $data['goods'][$m]['goods_price'] = $value['attr_value'][3]['attr_value']; //商品原价
            $data['goods'][$m]['sale_price'] = $value['attr_value'][4]['attr_value']; //商品现价
            $data['goods'][$m]['photo_path'] = thumb($value['goods_img'], 485, 275);
            $data['goods'][$m]['goods_size'] = $this->getSize($value['attr_value'][7]['attr_value']); //商品尺寸
            $data['goods'][$m]['goods_style'] = $value['attr_value'][8]['attr_value']; //商品风格
            $data['goods'][$m]['goods_material'] = $value['attr_value'][9]['attr_value']; //商品材料
            $data['goods'][$m]['goods_colorid'] = $goods_color[$value['id']] ? $goods_color[$value['id']]['id'] : 0; //商品颜色
            $data['goods'][$m]['is_fav'] = in_array($value['id'], $fav_goods_id) ? 1 : 0;
            $data['goods'][$m]['is_vr'] = in_array($value['id'], $vr_goods_id) ? 1 : 0;
            $m++;
        }
        return $data;
    }

    protected function getSize($data) {
        if ($data != '') {
            $array = explode(',', $data);
            return $array[0];
        } else {
            return '';
        }

    }
    
}
