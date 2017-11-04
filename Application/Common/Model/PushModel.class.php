<?php
namespace Common\Model;
use Think\Model;

class PushModel extends Model{
	
	protected $insertFields = array('id','title','url','content','description','img','add_time','open_type','member_id','record_id','record_table');
	protected $updateFields = array('id','title','url','content','description','img','add_time','push_time','open_type','status','delete_time','send_state','member_id','record_id','record_table');
	protected $selectFields = array('id','title','url','content','description','img','add_time','push_time','open_type','type','status','delete_time','send_state','member_id','record_id','record_table');

	protected $_validate = array(
		array('title', 'require', '公告推送名称不能为空', 1, 'regex', 3),
        array('title', '1,100', '公告推送标题长度有误', 0, 'length', 3),
        array('description', 'require', '公告推送描述不能为空', 0, 'regex', 3),
        array('description', '1,255', '公告推送描述文字过长，小于100字', 0, 'length', 3),    
        array('content', 'require', '公告推送内容不能为空', 0, 'regex', 3),
		array('url','/^http:\/\//','跳转url有误！必须以http://开头', 0, 'regex', 3),
		array('url','1,255','跳转url有误！', 0, 'length', 3),
        array('open_type', array(1,2), '推送公告打开方式有误', 0, 'in', 3),
        array('record_id', 'require', '业务表主键id不能为空', 0, 'regex', 3),
        array('record_table', 'require', '业务表名称不能为空', 0, 'regex', 3),
	);
	
	protected function _before_insert(&$data,$options) {
		$data['add_time'] = time();
	}

	protected function _before_update(&$data,$options) {
		$data['add_time'] = time();
	}

	// 查询推送列表
	public function getList($where, $field = null, $order = 'push_time desc'){
		if ($field == null) {
            $field = $this->selectFields;
        }
		$where['status'] = 0;
		$count = $this->where($where)->count();
        $page = get_page($count);
        $data = $this->field($field)->where($where)->limit($page['limit'])->order($order)->select();
        return array(
            'data' => $data,
            'page' => $page['page']
        ); 
	}

	/**
	 * 极光推送通用消息
	 * @param unknown $alert  提示标题
	 * @param unknown $contentType 信息类型
	 * @param unknown $userId 用户id 可传数组
	 * @param unknown $msg  信息内容
	 * @param unknown $type  推送类型 1新审批请求推送 2审批结果推送 3拜访计划提醒推送 4长久未拜访提醒推送 5官方公告推送 6会议安排提醒推送 7会议安排即将开始提醒推送 8上班打卡提醒推送 9考试安排提醒推送 10考试即将开始提醒推送
     * @param int $record_id 业务表主键id
     * @param string $record_table 业务表名称
	*/
    public function push($alert, $contentType, $userId, $msg, $type, $record_id = 0, $record_table = '') {
        if ($userId == '' || empty($userId))  {
            return V(0, '请选择推送人群');
        } elseif ($userId == 'all') {
            $userId = '';
        }
		$result = jPush( $alert, $contentType, $userId, $msg);
        $result = json_decode($result);
        if ($result) {   // 推送成功
        	// 把推送写进推送表
            if (is_array($userId)) {
                foreach ($userId as $key => $v) {
                    $this->_addPushInfo($alert, $v, $msg, $type, $record_id, $record_table);
                }
                return true;
            } else {
                $this->_addPushInfo($alert, $userId, $msg, $type, $record_id, $record_table);
                return true;
            }
        } else {  // 推送失败
        	$this->_addErrorPushMessageHistory($alert, $msg, $userId);
            return false;
        }
    }

    // 写入推送记录
    private function _addSuccessPushMessageHistory($title, $content, $userId){
    	if ($userId) {
    		$user_type = 1;
    	} else {
    		$user_type = 0;
    	}
        $data = array(
            'user_type' => $user_type,
            'type'      => 0,
            'title'     => $title,
            'content'   => $content,
            'push_time' => time(),
            'status'    => 2,
        );
        M('PushMessageHistory')->add($data);
        return true;
    }
    private function _addErrorPushMessageHistory($title, $content, $userId){
    	if ($userId) {
    		$user_type = 1;
    	} else {
    		$user_type = 0;
    	}
        $data = array(
            'user_type' => $user_type,
            'type'      => 0,
            'title'     => $title,
            'content'   => $content,
            'push_time' => time(),
            'status'    => 1,
            'send_response_msg' => '推送失败，未知原因！请查看源码确认',
        );
        M('PushMessageHistory')->add($data);
        return true;
    }

    // 私有方法写进push表
    private function _addPushInfo($alert, $phone, $msg, $type, $record_id, $record_table){
        $member_id = M('Member')->where(array('phone' => $phone))->getField('id');
        $data = array(
            'title' => $alert,
            'content' => $msg,
            'add_time' => time(),
            'push_time' => time(),
            'send_state' => 0,
            'open_type' => 2,
            'type' => $type,
            'member_id' => $member_id,
            'record_id' => $record_id,
            'record_table' => $record_table,
        );
        if ($type != 5) {
            $result = $this->add($data);
        }
        $this->_addSuccessPushMessageHistory($alert, $msg, $phone);
        return true;
    }
}