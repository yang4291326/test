<?php
namespace Admin\Model;
use Think\Model;

/**
 * Created by liuniukeji.com
 * 商品模型
 * @author goryua <1661745274@qq.com>
*/

class ShopGoodsModelModel extends Model {
    
    protected $insertFields = array('goods_id', 'name', 'model_path','material_tiling','description','ico');
	protected $selectFields = array('id', 'goods_id', 'name', 'model_path','material_tiling','description','ico');

    protected $_validate = array(
        // array('model_path', 'require', '商品模型资源必须选择', self::MUST_VALIDATE),
        // array('ico', 'require', '商品缩略图不能为空', self::MUST_VALIDATE),
        // array('material_tiling', 'require', '材质Tiling值不能为空', self::MUST_VALIDATE),
    );


    /**
     * 获取商品模型详情
    */
    public function getModelInfo($where, $field = null) {
        if ($field == null) {
            $field = $this->selectFields;
        }
  
        return $this->field($field)->where($where)->find();
    }

    protected function _before_insert(&$data, $option){
        $data['member_id'] = UID;
    }
    

}
?>