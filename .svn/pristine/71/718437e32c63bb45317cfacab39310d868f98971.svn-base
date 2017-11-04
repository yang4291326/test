<?php
namespace Goods\Model;
use Think\Model;

/**
 * Created by liuniukeji.com
 * 收藏夹模型
 * @author goryua <1661745274@qq.com>
*/
class ShopGoodsModelModel extends Model{

    protected $selectFields = array('id','member_id','goods_id','model_path'); 
  
    /**
     * 取出商户所有可用vr商品id
    */
    public function getVrGoodsId($goods_id_array) {
        $where['member_id'] = array('eq', UID);
        if (!empty($goods_id_array)) {
            $where['goods_id'] = array('in', implode(',', $goods_id_array));
        }
        $list = $this->where($where)->getField('id, goods_id');
        //var_dump($list);die;
        return $list;
    }
	/**
     * 取出商户所有可用vr商品id
    */
    public function getVrGoodsIds($goods_id_array) {
        //var_dump($goods_id_array);die;
        //$where['member_id'] = array('eq', UID);
        $goods_id_arrays=implode(',', $goods_id_array);
        if (!empty($goods_id_arrays)) {
            $goods_ids=$this->query("select goods_id from ln_shop_goods_model where id in (select model_id from ln_shop_goods_model_resource where 
                                    photo_resource_path is not null and photo_resource_path != '' and
                                    group_no is not null and group_no != '' and
                                    map_path is not null and map_path != '' and
                                    material_ball_name is not null and material_ball_name != '' and model_id in(select model.id from ln_shop_goods_model as model where goods_id in($goods_id_arrays)))");

            foreach($goods_ids as $k =>$v){
                  $goods_idy[$k]=$v['goods_id'];
            }
            //var_dump(implode(',',$goods_idy));
            $where['goods_id'] = array('in', $goods_idy);
        }
        $list = $this->where($where)->getField('id, goods_id');
        //
//        var_dump($list);die;
        return $list;
    }
   
}
