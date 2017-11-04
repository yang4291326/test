<?php
namespace Admin\Model;
use Think\Model;
/**
 * 联盟商家详情表模型
 * @author wangwujiang QQ:1358140190
 */
class AllianceMerchantDetailModel extends Model{
    protected $insertFields = array('name', 'position_x', 'position_y', 'add_time', 'address', 'phone', 'photo_path', 'recommend', 'others');
    protected $updateFields = array('id', 'name', 'position_x', 'position_y', 'add_time', 'address', 'phone', 'photo_path', 'recommend', 'others');
    protected $selectFields = array('id', 'photo_path', 'name', 'address', 'recommend', 'phone', 'add_time', 'others');

    protected $_validate = array(
        array('name', '1,24', '商家名称长度在1-24个字符之间', self::MUST_VALIDATE, 'length', 3),
        array('address', '1,56', '商家地址长度在1-56个字符之间', self::MUST_VALIDATE, 'length', 3 ),
        array('recommend', '0,90', '推荐理由不能超过90', self::MUST_VALIDATE, 'length', 3),
        array('phone', 'number', '电话号码必须是数字', self::MUST_VALIDATE),
        array('phone', '5,30', '电话号码长度在5-30个字符之间', self::MUST_VALIDATE, 'length', 3),
        array('others', '0,56', '其他信息不能超过56个字符', self::MUST_VALIDATE, 'length', 3),
    );

    // 获得联盟商家详情
    public function search(){
        $name = I('get.name', '','trim');
        if($name) {
            $where['name'] = array('like',"%$name%");
        }
        $data = $this->getAllianceMerchantDetailByPage($where, $field=null, $order='id desc');

        return $data;
    }
    protected function _before_insert(&$data,$option) {
        $data['member_id'] = UID;
        $data['add_time'] = time();
    }
    /**
     * 获取分页方法
     * @param array $where 传入where条件
     * @param string $order 排序方式
     * @return array 搜索数据和分页数据
     */
    public function getAllianceMerchantDetailByPage($where, $field=null, $order='id'){
        if ($field == null) {
            $field = $this->selectFields;
        }
        $count = $this->where($where)->count();
        $page = get_page($count);

        $data = $this->field($field)->where($where)->limit($page['limit'])->order($order)->select();
       // echo $this->_sql();
        return array(
                'data' => $data,
                'page' => $page['page']
            );
    }

}