<?php
namespace Admin\Model;
use Think\Model;

/**
 * Created by liuniukeji.com
 * 商品颜色模型
 * @author goryua <1661745274@qq.com>
*/

class ShopGoodsColorModel extends Model {
    
    protected $insertFields = array('goods_id','color','photo_path');
	protected $selectFields = array('id','goods_id','color','photo_path'); 

    protected $_validate = array(
        array('goods_id', 'number', '非法数据, 必须是数字', self::MUST_VALIDATE, 'regex', 3),

    );

    public function getColorList($where, $field = null, $order = 'id asc') {
        if ($field == null) {
            $field = $this->selectFields;
        }

        $list = $this->field($field)->where($where)->order($order)->select();
        return $list;
    }

    
    /**
     * 保存商品属性值
     * @param array $color_name 颜色名称
     * @param array $color_pic 颜色图片路径
     * @param integer $goods_id 商品id
     * @return bool 成功返回true，否则返回错误提示
    */
    public function saveColor($color_name, $color_pic, $goods_id) {
        
        $color_list = $this->getColorList(array('goods_id' => $goods_id));
        if (!empty($color_list) && is_array($color_list)) {
            foreach ($color_list as $val) { //清空文件图片
                if (file_exists($val['default_color_pic']) == true) {
                    @unlink($val['default_color_pic']);
                }
                if (file_exists($val['photo_path']) == true) {
                    @unlink($val['photo_path']);
                }
            }
            $this->where('goods_id='.$goods_id)->delete();
        }
        
        foreach ($color_name as $name_key => $name_val) {
            foreach ($color_pic[$name_key] as $pic_key => $pic_val) {
                if ($color_pic[$name_key][1] == '') {
                    return $name_val.'请先上传颜色默认图';
                    exit;
                }
                if ($pic_key != 1 && $pic_val) {
                    $data['goods_id'] = $goods_id;
                    $data['color'] = $name_val;
                    $data['photo_path'] = $pic_val;
                    $data['default_color_pic'] = $color_pic[$name_key][1];
                    if (false === $this->add($data)) {
                        return false;
                    }
                }
            }

            unset($data);
        }

        return true;
    }

    /*杨yongjie  添加*/
    //通过商品id和颜色id获取收藏商品颜色
    public function getColor($goods_id,$color_id){
        $where['goods_id']=$goods_id;
        $where['id']=$color_id;
        $color=$this->where($where)->field('color')->find();
        return $color['color'];
    }
    //颜色id获取确认商品颜色
    public function getCartColor($color_id){
        $where['id']=$color_id;
        $color=$this->where($where)->field('color')->find();
        return $color['color'];
    }
    /*杨yongjie  添加*/
}
?>