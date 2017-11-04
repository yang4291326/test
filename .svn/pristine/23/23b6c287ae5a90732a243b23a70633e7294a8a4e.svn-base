<?php
namespace Admin\Model;

use Think\Model;

/**
 * 用户自定义属性模型
 * @author yuanyulin <QQ:755687023>
 */
class MemberAttributeModel extends Model {
    protected $insertFields = array('attr_mode', 'attr_name', 'attr_type', 'attr_value', 'attr_sort', 'is_edit', 'arrt_control', 'attr_require', 'attr_status');
    protected $updateFields = array('id', 'attr_mode', 'attr_name', 'attr_type', 'attr_value', 'attr_sort', 'is_edit', 'arrt_control', 'attr_require', 'attr_status');

    protected $_validate = array(
        array('attr_mode', array(0, 1, 2), '非法数据！', self::MUST_VALIDATE, 'in', 3),
        
        array('attr_name', '1,20', '自定义属性名不正确， 请输入1到5个字符！', self::MUST_VALIDATE, 'length', 3),
        array('attr_name', '',     '该自定义属性名已经被使用！',             self::MUST_VALIDATE, 'unique', 1),
        
        array('attr_type', array(0, 1, 2), '非法数据！', self::MUST_VALIDATE, 'in', 3),
       
        array('attr_value', '1,20', '自定义属性值不正确，请输入1到5个字符！', self::VALUE_VALIDATE, 'length', 3), 
        
        array('attr_sort', 'number', '排序必须是数字！', self::MUST_VALIDATE, 'function', 3),
        
        array('is_edit', array(0, 1), '非法数据！', self::MUST_VALIDATE, 'in', 3),
        
        array('attr_control', array(0, 1, 2), '非法数据！', self::MUST_VALIDATE, 'in', 3),
        
        array('attr_require', array(0, 1, 2), '非法数据！', self::MUST_VALIDATE, 'in', 3),        

        array('status', array(0, 1), '非法数据，该属性值是否启用！', self::MUST_VALIDATE, 'in', 3),
    );
    
    protected function _before_insert(&$data, $option){
        if ( $data['attr_type'] != 2 ) { // 如果类型不是枚举就滞空属性值
            $data['attr_value'] = '';
        } 
    }

    protected function _before_update(&$data, $option){
        if ( $data['attr_type'] != 2 ) { // 如果类型不是枚举就滞空属性值
            $data['attr_value'] = '';
        } 
    }

    /**
     * 对自定义属性表进行分页显示
     * @param string $order 排序条件(默认根据用户自定义的排序排列，如果没有用户自定义的根据id进行倒序排列)
     * @return array 分页列表，分页数据
     */
    public function getCustomAttributeByPage($order = 'attr_sort desc, id desc') {
        $keywords = I('keywords', '', trim);
        if ($keywords) 
            $where['attr_name'] = array('LIKE', "%$keywords%");

        $count = $this->where($where)->count();
        $page = get_page($count);

        $list = $this->where($where)->limit($page['limit'])->order($order)->select();
//        echo $this->_sql();

        return array('list' => $list, 'page' => $page);
    }
}
