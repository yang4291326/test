<?php
namespace Admin\Model;
use Think\Model;

/**
 * 后台用户管理模型
 * @author yuanyulin <QQ: 755687023>
 */
class MemberModel extends Model{
    protected $insertFields = array('type', 'user_name', 'password', 'disabled', 'status', 'menu_ids', 'skin_id');
    protected $updateFields = array('id', 'type', 'user_name', 'password', 'disabled', 'status', 'menu_ids', 'skin_id');

    protected $_validate = array(
        array('type', array(0,1), '非法数据, 用户是否为管理员或者商户', self::MUST_VALIDATE, 'in', 3),

        array('user_name', '4,20',      '用户名不正确, 请输入4到20位字符', self::MUST_VALIDATE, 'length',   1),
        array('user_name', 'checkName', '用户名必须以字母开头',            self::MUST_VALIDATE, 'callback', 1),
        array('user_name', 'newName',   '用户名已被注册',                 self::MUST_VALIDATE,  'callback', 3),

        array('password', '36,41', '登录密码长度不合法', self::MUST_VALIDATE,  'length', 1), // 密码长度不合法, 只注册时验证
        array('password', '36,41', '登录密码长度不合法', self::VALUE_VALIDATE, 'length', 2), // 不为空时验证, 只修改时验证

        array('disabled', array(0,1), '非法数据, 用户是否启用', self::MUST_VALIDATE, 'in', 3),
    );


    // 判断用户名首字符必须为字母, 且是字母或数字或字母数字的组合
    protected function checkName($data){
        $firstCode = substr($data, 0, 1);
        if (ctype_alpha($firstCode))
            if (ctype_alnum($data))
                return true;
        return false;
    }

    //判断用户名是否已被注册
    protected function newName($data){
        $where['status'] = array('EQ', 0);
        $where['user_name'] = $data;
        $id = I('id', 0, 'intval');
        if ($id){
            $where['id'] = array('NEQ', $id);
        }
        $name = $this->where($where)->count();
        if ($name > 0){
            return false;
        }
        return true;
    }

    protected function _before_insert(&$data, $option){
        $data['password'] = md5($data['password']);
    }
    
    protected function _after_insert(&$data, $options) {
        // 获取所有的用户的id写入皮肤数据库
        $ids = M('Member')->where('type=0')->getfield('id',true);
        $ids = implode(',', $ids);
        M('Skin')->where('id=1')->setField('member_ids',$ids);
    }

    protected function _before_update(&$data, $option){
            
        if (empty($data['password'])) { // 判断密码为空就不修改这个字段
            unset($data['password']);
        } else {
            $data['password'] = md5($data['password']);
        }

        if ($data['id'] == 1) { // 如果是admin，则不允许更改
            unset($data['disabled']);
            unset($data['status']);
            unset($data['type']);
        }
    }
    
    /**
     * 对用户列表进行分页显示
     * @param string $map              判断用户是管理员还是商户 （0： 表示商户 1： 表示管理员）
     * @param array  $addTitleContent  要添加到用户标题显示的附加属性
     * @param string $order            排序条件(默认根据用户自定义的排序排列，如果没有用户自定义的根据id进行倒序排列)
     * @return array 分页列表，分页数据
     */
    public function getMemberByPage($map, $addTitleContent,$order = 'id desc') {        
        $keywords = I('keywords', '', trim);
        
        $where['type']   = array('EQ', $map);// 判断用户类型
        $where['status'] = array('EQ', 0);   // 用户状态 0正常 1 删除
        $where['id']     = array('NEQ', 1);  // 如果用户为1（超级管理员）就不显示
        if ($keywords) 
            $where['user_name'] = array('LIKE', "%$keywords%");

        $count = $this->where($where)->count();
        $page = get_page($count);

        $list = $this->where($where)->field(true)->limit($page['limit'])->order($order)->select();
        $list = $this->mergeTitleProperty($list, $addTitleContent); // 处理好的合并的用户附加属性

        return array('list' => $list, 'page' => $page);
    }
    
    /**
     * 合并用户的固有属性和需要合并的用户的附加属性
     * @param array $list              // 用户的固有属性
     * @param array $addTitleContent   // 需要合并的用户的附加属性
     * @return array $lsit             // 合并好的用户的附加属性
     */
    protected function mergeTitleProperty($list, $addTitleContent){
        $MemberAttributeValueModel = D('MemberAttributeValue');
        foreach ($list as $key => $value) {
            foreach ($addTitleContent as $k => $v) {
            $list[$key][] = $MemberAttributeValueModel->getMemberAttributeValueByMemberIdAndMemeberProperty($value['id'], $v['id']); // 根据需要显示的附加属性的id找到该用户的附加属性值
            }
        }
        return $list;
    }

    // 根据用户传递过来的id获取用户的登录名
    public function getMemberNameById( $id = 0 ){
        $memberName = $this->where("id = $id")->getField('user_name');
        return $memberName;
    }

}
