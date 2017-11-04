<?php
namespace Goods\Model;
use Think\Model;

/**
 * Created by liuniukeji.com
 * 商品分类模型
 * @author goryua <1661745274@qq.com>
*/
class ShopGoodsTypeModel extends Model{
	
	protected $selectFields = array('id','name','sort','parent_id','pic_path','pic_hover_path','level'); 

	//获取分类列表
	public function getCategoryList($where, $field = null, $order='sort asc, id asc', $limit){
		if ($field == null) {
			$field = $this->selectFields;
		}

		$list = $this->field($field)->where($where)->order($order)->limit($limit)->select();

        return $list;
	}

	public function getCategoryInfo($where, $field = null) {
		if ($field == null) {
			$field = $this->selectFields;
		}

		return $this->field($field)->where($where)->find();
	}
	
}
