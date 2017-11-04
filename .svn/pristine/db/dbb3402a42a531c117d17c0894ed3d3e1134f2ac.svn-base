<?php
namespace Admin\Model;
use Think\Model;

/**
 * Created by liuniukeji.com
 * 商品详情模型
 * @author goryua <1661745274@qq.com>
*/

class ShopGoodsDetailModel extends Model {
    
    protected $insertFields = array('goods_id', 'name', 'photo_path', 'remark', 'sort');
	protected $selectFields = array('id', 'goods_id', 'name', 'photo_path', 'remark', 'sort'); 

    protected $_validate = array(
        array('goods_id', 'number', '非法数据, 必须是数字', self::MUST_VALIDATE, 'regex', 3),
        array('name', 'require', '图片名称不能为空', self::MUST_VALIDATE, '', 4),
        array('name', '1,4', '图片名称最多不能超过4个字', self::VALUE_VALIDATE, 'length', 7),
        array('photo_path', 'require', '请上传详情图片', self::MUST_VALIDATE, '', 5),
        array('remark', 'require', '详情描述不能为空', self::MUST_VALIDATE, '', 6),
    );
    
    /**
     * 获取商品详情列表
    */
    public function getDetailList($where, $field = null, $order = 'sort asc, id asc') {
        if ($field == null) {
            $field = $this->selectFields;
        }

        $list = $this->field($field)->where($where)->order($order)->select();
        return $list;
    }
    
    /**
     * 保存商品详情
     * @param array $data 数组值
     * @param integer $id 商品id
     * @return bool 成功返回true，否则返回错误提示
    */
    public function saveDetailValue($data, $id) {
        $detail_list = $this->getDetailList(array('goods_id' => $id));
        if (!empty($detail_list) && is_array($detail_list)) {
            $this->where('goods_id='.$id)->delete();
        }
        foreach ($data['name'] as $key => $value) {
            if (!$value) {
                $_validate = 4;
            } else {
                $_validate = 7;
            }
            if (!$data['path'][$key]) {
                $_validate = 5;
            }
            if (!$data['remark'][$key]) {
                $_validate = 6;
            }
            $save_data['goods_id'] = $id;
            $save_data['name'] = $value;
            $save_data['photo_path'] = $data['path'][$key];
            $save_data['remark'] = $data['remark'][$key];

            if ($this->create($save_data, $_validate) !== false) {
                unset($_validate);
                $this->add();
            } else {
                unset($_validate);
                return($this->getError());
            }
            unset($save_data);
        }

        return true;
    }

    /*杨yongjie  添加*/
    public function usableCount($goods_id){
        $where['goods_id']=$goods_id;
        $count=$this->where($where)->count();//统计可用的详情图片总数
        return $count;
    }
    /*杨yongjie  添加*/
}
?>