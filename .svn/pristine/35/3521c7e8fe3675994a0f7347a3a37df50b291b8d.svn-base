<?php
namespace Admin\Model;
use Think\Model;

/**
 * Created by liuniukeji.com
 * 商品分类模型
 * @author goryua <1661745274@qq.com>
*/

class ShopGoodsTypeModel extends Model {
     
    protected $insertFields = array('member_id','name','sort','remark','parent_id','level','pic_path','pic_hover_path','add_time','status');
	protected $updateFields = array('id','name','sort','remark','parent_id','level','pic_path','pic_hover_path','status');
	protected $selectFields = array('id','member_id','name','sort','remark','parent_id','pic_path','pic_hover_path','level','status'); 

    protected $_validate = array(
        array('name', 'require', '商品分类名称不能为空', self::MUST_VALIDATE, 'regex', 3),
        array('parent_id', 'checkCateLevel', '上级分类不能选择顶级分类', self::MUST_VALIDATE, 'callback', 3),
        array('name', '1,3', '二级分类最多不能超过3个字', self::VALUE_VALIDATE, 'length', 4),
        //array('pic_path', 'checkPic', '该层级下分类图标必须上传', self::MUST_VALIDATE, 'callback', 4),
        //array('pic_hover_path', 'checkHoverPic', '该层级下滑过分类图标必须上传', self::MUST_VALIDATE, 'callback', 4),
        array('name', '1,5', '三级分类最多不能超过5个字', self::VALUE_VALIDATE, 'length', 5),
        array('name', '1,7', '四级分类最多不能超过7个字', self::VALUE_VALIDATE, 'length', 6),
        array('sort', '0,1000', '分类排序范围在0--1000', 0, 'between', 3),
        array('remark', '1,20', '分类备注不能超过200字', self::VALUE_VALIDATE, 'length', 3),
    );

    public function getCateList($map, $field = null, $order = 'type.sort asc, type.id asc') {
        if ($field == null) {
            $field = $this->selectFields;
        }
        $condition = array();
        $condition['type.member_id'] = UID;
        $condition['type.status'] = 0;
        if (!empty($map)) {
            $condition = array_merge($condition, $map);
        }
        $list = $this->alias('type')
            ->join('__MEMBER__ member ON type.member_id = member.id', 'left')
            ->field($field)
            ->where($condition)
            ->order($order)
            ->select();

        return $list;
    }

    public function getCateInfo($field = null, $where) {
        if ($field == null) {
            $field = $this->selectFields;
        }

        return $this->field($field)->where($where)->find();
    }

    /**
     * 判断图标不能为空
     */
    protected function checkPic($data) {
        $pic_path = I('post.pic_path', '');        
        if ($pic_path == '') {
            return false;
        }
        return true;
    }
    protected function checkHoverPic($data) {
        $pic_hover_path = I('post.pic_hover_path', '');
        if ($pic_hover_path == "") {
            return false;
        }
        return true;
    }

    protected function _before_insert(&$data, $option){
        $data['member_id'] = UID;
        $data['add_time'] = NOW_TIME;
    }

    protected function _before_update(&$data,$option) {
        $data['add_time'] = time();
        $data['member_id'] = UID;
    }

    protected function checkCateLevel($data) {
        $id = I('id', 0, 'intval');
        if ($id) {
            $parent_id = M('shop_goods_type')->where('id='. $id)->getField('parent_id');
            if ($parent_id != 0){
                if ($data == '') return false;
            }
        } else {
            if ($data == '')
                return false;
        }
    }
}
?>