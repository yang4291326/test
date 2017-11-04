<?php
namespace Common\Model;
use Think\Model;
/**
 * 后台用户管理
 * @author zhaojiping QQ:17620286 liniukeji.com
 *
 */
class MemberModel extends Model{

	protected $_validate = array(
        array('username', '4,20', '用户名不正确, 请输入4到20位字符', self::MUST_VALIDATE, 'length', 4),
        array('password', '36,46', '登录密码长度不合法', self::MUST_VALIDATE, 'length', 4), //密码长度不合法, 只注册时验证
	);

	/**
	 * 用户登录认证
	 * @param  string  $password sha1 加密后的验证密码
	 * @return bool
	 */
	public function payPassword($password=''){
		$pay_password = $this->where('id='. UID)->getField('pay_password');
		if (md5($password) === $pay_password) {
			return true;
		} else {
			return false;
		}
	}

	/**
	 * 用户登录认证
	 * @param  string  $username 用户名
	 * @param  string  $password 用户密码
	 * @param  string  $type 登录用户类型 admin||user
	 * @return array
	 */
	public function login($username='', $password='', $type=''){
		if ($username == '' ||  $password == '' || $type == '') {
			exit('参数错误!');
		}
		$map['status'] = 0;
		/* 获取用户数据 */
		$member = $this
			->field('id,user_name,password,type')
			->where($map)->where('user_name="'. $username .'"')
			->find();
		// echo md5($password);echo '||||'; echo $member['password'];
		if(is_array($member)){
			/* 验证用户密码 */

			if(md5($password) === $member['password']){
				if ($member['disabled'] != 0) {
					return V(0, '用户账号已经被禁用');
				}
				$this->updateLogin($member['id']); //更新用户登录信息
				//登录成功，返回用户信息
				return V(1, '登录成功', $member);
			} else {
				return V(0, '用户名或密码错误!');
			}
		} else {
			return V(0, '用户名或密码错误.');
		}
	}

	/**
	 * 更新用户登录信息
	 * @param  integer $uid 用户ID
	 */
	protected function updateLogin($uid){
		$memberAttributeValueModel = M('MemberAttributeValue');
		$where['member_id'] = $uid;
		$where['attribute_id'] = C('MEMBER_LAST_LOGIN_TIME');
		$data = array(
			'attr_value' => NOW_TIME,
			'attribute_id'   => C('MEMBER_LAST_LOGIN_TIME'),
		);
		if ($memberAttributeValueModel->where($where)->count() > 0) {
			$memberAttributeValueModel->where($where)->save($data);
		} else {
			$data['member_id'] = $uid;
			$memberAttributeValueModel->where($where)->add($data);
		}
		unset($where);
		unset($data);
		$where['member_id'] = $uid;
		$where['attribute_id'] = C('MEMBER_LAST_LOGIN_IP');
		$data = array(
			'attr_value' => get_client_ip(),
			'attribute_id'   => C('MEMBER_LAST_LOGIN_IP'),
		);
		if ($memberAttributeValueModel->where($where)->count() > 0) {
			$memberAttributeValueModel->where($where)->save($data);
		} else {
			$data['member_id'] = $uid;
			$memberAttributeValueModel->where($where)->add($data);
		}
	}

	//获取商户的所有信息
	public function getMemberByLimit($where, $order = 'id desc') {                
        $where['type']   = array('eq', 0);
        $where['status'] = array('eq', 0); // 用户状态 0正常 1 删除
        $where['disabled']   = array('eq', 0);
        $list = $this->field('id,send_homelog_time')
        	->where($where)
        	->order($order)
        	->select();

        return $list;
    }

}
