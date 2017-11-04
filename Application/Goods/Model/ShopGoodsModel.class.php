<?php
namespace Goods\Model;
use Think\Model;

/**
 * Created by liuniukeji.com
 * 商品模型
 * @author goryua <1661745274@qq.com>
*/
class ShopGoodsModel extends Model{
	
	protected $selectFields = array('id','goods_category_id','goods_img','goods_remark','member_id'); 

	/**
     * 获取商品列表,并关联取出商品名称、属性等
     * @param string $attr_type 属性类型
	 */
	public function getGoodsListByPage($where, $field = null, $order = 'id desc', $attr_type = 0, $page_size = 12) {
		if ($field == null) {
			$field = $this->selectFields;
		}
		$count = $this->where($where)->count('id');
        $page = get_page($count, $page_size);
		$goods_list = $this->field($field)->where($where)->limit($page['limit'])->order($order)->select();
        //echo '<pre>';var_dump($goods_list);die();
		//echo $this->getLastSql();die;
		//$goods_list = $this->field($field)->where($where)->order($order)->select();
		if (empty($goods_list)) {
			return false;
		}
		foreach ($goods_list as $value) {
			$goods_array[$value['id']] = $value;
		}
		$goods_id = array_keys($goods_array);

        //获取商品对应的属性和属性值
		$map['value.goods_id'] = array('in', implode(',', $goods_id));
		if ($attr_type) { //如果有属性类型，根据属性类型取值
			$map['value.attribute_id'] = array('in', $attr_type);
		}
		$attr_list = D('Goods/ShopGoodsAttribute')->getGoodsAttrList($map);
		foreach ($goods_array as $k => $v) {
			$list_array[$k] = $v;
			$list_array[$k]['attr_value'] = $attr_list[$k];
		}
		return array('list' => $list_array,'page' => $page); 
		//return array('list' => $list_array);   
	}


    /*杨yjie添加*/
    public function getGoodsListByPageS($where, $field = null, $order = 'id desc', $attr_type = 0, $page_size = 12) {
		if ($field == null) {
			$field = $this->selectFields;
		}
		$count = $this->where($where)->count('id');
        $page = get_page($count, $page_size);
		$goods_list = $this->field($field)->where($where)->order($order)->select();
        //echo '<pre>';var_dump($goods_list);die();
		//echo $this->getLastSql();die;
		//$goods_list = $this->field($field)->where($where)->order($order)->select();
		if (empty($goods_list)) {
			return false;
		}
		foreach ($goods_list as $value) {
			$goods_array[$value['id']] = $value;
		}
		$goods_id = array_keys($goods_array);

        //获取商品对应的属性和属性值
		$map['value.goods_id'] = array('in', implode(',', $goods_id));
		if ($attr_type) { //如果有属性类型，根据属性类型取值
			$map['value.attribute_id'] = array('in', $attr_type);
		}
		$attr_list = D('Goods/ShopGoodsAttribute')->getGoodsAttrList($map);
		foreach ($goods_array as $k => $v) {
			$list_array[$k] = $v;
			$list_array[$k]['attr_value'] = $attr_list[$k];
		}
		return array('list' => $list_array); 
		//return array('list' => $list_array);   
	}

    /*杨yjie添加*/




	/**
     * 获取商品列表,并关联取出商品名称、属性等
     * @param string $attr_type 属性类型
	 */
	public function getGoodsList($where, $field = null, $order = 'id desc', $attr_type = 0) {
		if ($field == null) {
			$field = $this->selectFields;
		}
		$goods_list = $this->field($field)->where($where)->order($order)->select();
		if (empty($goods_list)) {
			return false;
		}
		foreach ($goods_list as $value) {
			$goods_array[$value['id']] = $value;
		}
		$goods_id = array_keys($goods_array);

        //获取商品对应的属性和属性值
		$map['value.goods_id'] = array('in', implode(',', $goods_id));
		if ($attr_type) { //如果有属性类型，根据属性类型取值
			$map['value.attribute_id'] = array('in', $attr_type);
		}
		$attr_list = D('Goods/ShopGoodsAttribute')->getGoodsAttrList($map);
		foreach ($goods_array as $k => $v) {
			$list_array[$k] = $v;
			$list_array[$k]['attr_value'] = $attr_list[$k];
		}
		return $list_array;
	}

	/**
     * 获取商品信息
	 */
	public function getGoodsInfo($where, $field = null) {
		if ($field == null) {
			$field = $this->selectFields;
		}

		$goods_info = $this->field($field)->where($where)->find();
		return $goods_info;
	}

	/**
     * 获取商品颜色,以颜色id作为键值
	 */
	public function getColorList($where) {

		$list = M('shop_goods_color')->where($where)->getField('id,goods_id,color,photo_path,default_color_pic');
		return $list;		
	}

	/**
     * 获取商品颜色
	 */
	public function getColor($where) {

		$list = M('shop_goods_color')->field('id,goods_id,color,photo_path')->where($where)->select();
		return $list;		
	}

	public function getDefaultColor($where) {
		$list = M('shop_goods_color')->where($where)->getField('color,id,color,default_color_pic');
		$m = 0;
		$data = array();
		foreach ($list as $key => $value) {
			$data[$m]['id'] = $value['id'];
			$data[$m]['color'] = $value['color'];
			$data[$m]['photo_path'] = $value['default_color_pic'];
			$m++;
		}
		return $data;
	}
    
    public function getUniqueColor($where, $field = null) {
    	if ($field == null) {
    		$field = 'id';
    	}
    	$list = M('shop_goods_color')->group('goods_id')->field($field)->where($where)->select();
    	foreach ($list as $key => $value) {
    		$array[$value['goods_id']] = $value;
    	}
    	return $array;
    }
    /**
     * 获取商品颜色
	 */

    /**
     * 获取商品详情
	 */
	public function getDetailList($id) {
		$limit = _getDataAccess('goods_detail_photo_num');
		$where['goods_id'] = array('eq', $id);
		$list = M('shop_goods_detail')->field('id,name,photo_path,remark')->where($where)->limit( $limit)->order('sort asc')->select();
		return !empty($list) ? $list : array();		
	}
        
    /**
     * 根据商品id 获取基础属性信息
     * @param integer $goods_id 商品id
     * @param integer $typeid 基础属性类型id 1名称 2编号 3原价 4现价 5优惠 6排序
     * @return string
    */
    public function getBasicAttrValue($goods_id, $typeid) {
        $where['goods_id'] = array('eq', $goods_id);
        $where['attribute_id'] = array('eq', $typeid);
        $info = M('ShopGoodsAttributeValue')->where($where)->getField('attr_value');
        return $info;
    }


}
