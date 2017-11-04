<?php 
namespace Home\Controller;
use Think\Controller;

class ListController extends Controller{
     /**
     * 杨yjie 添加
     * Created by liuniukeji.com
     * 首页模板
    **/
    protected function _initialize(){
        $code = $_POST['code'];
        if ($code == '') {
           // $this->ajaxReturn(V('0', '非法访问'));
        }
        $params = json_decode($code, true);
        // 重新赋值
        $_POST = null;
        foreach ($params as $key => $value) {
            // $_GET[$key] = $value;
            $_POST[$key] = $value;
            if ($key == 'p') {
                $_GET['p'] = $value;
            }
        }

    }
    public function getGoodsApi(){
        $type = I('type', 2, 'intval'); //1首页模板 2商品列表
        $category_id = I('category_id', 2, 'intval');
        if ($type == 0) {
            $this->apiReturn(0, '类型参数错误');
        }
        if ($type == 1) {
            $data = $this->index();
        }
        if ($type == 2) {
            $data = $this->goodsLists($category_id);
        }
        $this->apiReturn(1, '商品列表', $data);
    }

    /*
     *商品列表
     */
    protected function goodsLists($parent_id){
        //获取分类信息
        $category_info = D('Goods/ShopGoodsType')->getCategoryInfo(array('id'=>$parent_id), 'name');
        //获取子类id
        $get_son_id = getChildIds('shop_goods_type', $parent_id);
        $where['goods_category_id'] = array('in', implode(',', $get_son_id));
        $where['status'] = array('eq', 0);
        $goods_list = D('Goods/ShopGoods')->getGoodsListByPageS($where, 'id, goods_img', '', '1,3,4,7,8,9');
        if (empty($goods_list['list'])) {
            $this->apiReturn(0, '该分类下商品为空');
        }
        //取出商户收藏商品id
        $fav_goods_id = D('Goods/Favorite')->getFavGoodsId(array_keys($goods_list['list']));
        //取出商户可用vr商品id
        $vr_goods_id = D('Goods/ShopGoodsModel')->getVrGoodsIds(array_keys($goods_list['list']));
        //根据商品id取出商品颜色
        $color_where['goods_id'] = array('in', implode(',', array_keys($goods_list['list'])));
        $goods_color = D('Goods/ShopGoods')->getUniqueColor($color_where, 'id,goods_id');
        //var_dump($goods_list);die;
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
        static $datas=array();
        //重新组装返回数据
        $datas['title'] = $category_info['name'];
        foreach($data as $k => $v){
            foreach($v as $x => $y){
                if($y['is_vr']==1){
                   $datas['goods'][]=$y;
                }
            }
        }
        return $datas;
    }
    protected function getSize($data) {
        if ($data != '') {
            $array = explode(',', $data);
            return $array[0];
        } else {
            return '';
        }

    }
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
}  
