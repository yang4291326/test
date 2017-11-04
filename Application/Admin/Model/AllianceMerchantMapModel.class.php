<?php
namespace Admin\Model;
use Think\Model;

/**
 * 联盟商家管理模型
 * @author yuanyulin <QQ: 755687023>
 */
class AllianceMerchantMapModel extends Model{
    protected $insertFields = array('name', 'photo_path', 'sort');
    protected $updateFields = array('id', 'name', 'photo_path', 'sort');
    
    protected $_validate = array(    
        array('name', 'require', '地图名称必须填写',            self::MUST_VALIDATE, 'regex',  3),
        array('name', '1,24',    '地图名称长度在1-24个字符之间', self::MUST_VALIDATE, 'length', 3),
        
        array('photo_path', 'require', '图片路径必须填写', self::MUST_VALIDATE, 'regex', 3),
        
        array('sort', 'number', '排序必须是数字', self::VALUE_VALIDATE, 'regex', 3),
    );
    
    protected function _before_insert(&$data,$option) {
        $data['member_id'] = UID;
        $data['add_time'] = time();
    }

    /**
     * @param sting $order 排序字段
     * @return array 返回处理好的数据和分页
     */
    public function getAllianceMerchantMapByPage($order = 'sort desc, id desc') { 
        $keywords = I('keywords', '', trim);
        if ($keywords) 
            $where['member.user_name'] = array('LIKE', "%$keywords%");
        if (UID != 1) 
            $where['member_id'] = UID;
        
        $count = $this->alias('alliancemerchantmap')->where($where)->count();
        
        $page = get_page($count);
        $data = $this->alias('alliancemerchantmap')->join('__MEMBER__ as member on alliancemerchantmap.member_id = member.id', 'LEFT')
                ->field('alliancemerchantmap.id, alliancemerchantmap.name, alliancemerchantmap.add_time, alliancemerchantmap.sort, member.user_name')
                ->where($where)->limit($page['limit'])->order($order)->select();
//        echo $this->_sql();

        return array('list' => $data, 'page' => $page);
    }
}
