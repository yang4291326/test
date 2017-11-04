<?php
namespace Goods\Model;
use Think\Model;

/**
 * Created by liuniukeji.com
 * 商品属性模型
 * @author goryua <1661745274@qq.com>
*/
class ShopGoodsAttributeModel extends Model{
	
	protected $selectFields = array('id','attr_name','attr_type'); 

	/**
     * 根据商品信息 取出单个商品属性和属性对应值
	 */
	public function getGoodsAttrInfo($goods_info) {

        $where['member_id'] = array('in', '0, '.$goods_info['member_id'].'');
        $where['attr_mode'] = array('in', '0,1');
        $where['cate_id'] = array('in', '0, '.$goods_info['goods_category_id'].'');

        //取出系统属性列表和商户自定义列表
		$attr_list = $this->field($this->selectFields)->where($where)->select();
		foreach ($attr_list as $v) {
			$attr_data[$v['id']] = $v;
		}
		//取出属性列表值
		$attr_list_value = $this->getGoodsAttrValue($goods_info['id']);
		$m = 0;
		foreach ($attr_list as $key => $data) { //合并商品属性和商品属性值
			if (($data['id'] == 6) || ($data['id'] == 7)){
				continue;
			}
			$all_data[$m]['attr_id'] = $data['id'];
			$all_data[$m]['attr_name'] = $data['attr_name'];
			$all_data[$m]['attr_type'] = $data['attr_type'];
			if ($data['attr_type'] == 2 || $data['attr_type'] == 3) {
				$all_data[$m]['attr_value'] = explode(',', $attr_list_value[$data['id']]['attr_value']);
				if (empty($all_data[$m]['attr_value'])) {
					$all_data[$m]['attr_value'] = array();
				}
			} else {
				$all_data[$m]['attr_value'] = $attr_list_value[$data['id']]['attr_value'];
				if (empty($all_data[$m]['attr_value'])) {
					$all_data[$m]['attr_value'] = '';
				}
			}
			$m++;
		}

		return $all_data;		
	}

	/**
     * 根据条件取出商品属性和属性值列表
	 */
	public function getGoodsAttrList($where) {
		$field = 'attr.id as attr_id,attr.attr_name,value.attr_value,value.goods_id';
		$attr_list = $this->alias('attr')
            ->join('__SHOP_GOODS_ATTRIBUTE_VALUE__ value ON attr.id = value.attribute_id', 'left')
            ->field($field)
            ->where($where)
            ->select();
        foreach ($attr_list as $value) {
        	$data[$value['goods_id']][$value['attr_id']] = $value;
        }
        return $data;
	}
    
    /**
     * 商品属性值
	 */
	protected function getGoodsAttrValue($id) {
        $field = 'id, attribute_id, attr_value';
		$list = M('shop_goods_attribute_value')->field($field)->where('goods_id='.$id)->select();
        foreach ($list as $v) {
        	$data[$v['attribute_id']] = $v;
        }
		
		return $data;		
	}

	
}
