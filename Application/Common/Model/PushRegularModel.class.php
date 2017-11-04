<?php
namespace Common\Model;
use Think\Model;

/**
 * 定时任务提交
 * @author wangzhiliang QQ:1337841872 liniukeji.com
 *
 */
class PushRegularModel extends Model{
	
	protected $insertFields = array('id','title','url','content','description','img','add_time','push_time','open_type','userId','type','record_id','record_table');
	protected $updateFields = array('id','title','url','content','description','img','add_time','push_time','open_type','status','delete_time','send_state','userId','type','record_id','record_table');

	protected function _before_insert(&$data,$options) {
		$data['add_time'] = time();
	}

	// 插入数据
	public function addPushRegular($data){
		$rules = array(
			array('title', 'require', '公告推送名称不能为空', 1, 'regex', 3),
	        array('title', '1,100', '公告推送标题长度有误', 0, 'length', 3),
	        array('description', 'require', '公告推送描述不能为空', 0, 'regex', 3),
	        array('description', '1,255', '公告推送描述文字过长，小于100字', 0, 'length', 3),    
	        array('content', 'require', '公告推送内容不能为空', 0, 'regex', 3),
			array('url','/^http:\/\//','跳转url有误！必须以http://开头', 0, 'regex', 3),
			array('url','1,255','跳转url有误！', 0, 'length', 3),
	        array('open_type', array(1,2), '推送公告打开方式有误', 0, 'in', 3),
			array('push_time', 'require', '推送时间不能为空', 1, 'regex', 3),
			array('type', 'require', '推送类型type不能为空', 1, 'regex', 3),
	        array('record_id', 'require', '业务表主键id不能为空', 1, 'regex', 3),
	        array('record_table', 'require', '业务表名称不能为空', 1, 'regex', 3),
		);
		$data = $this->validate($rules)->create($data);
        if($data){
        	if ($data['id'] == 0) {
        		$result = $this->add();
        		return V(1, '保存成功', $result);
        	} else {
        		if ($this->save() !== false) {
        			return V(1, '保存成功');
        		} else {
        			return V(0, '保存失败');
        		}	
        	}
        	
        } else {
        	return V(0, $this->getError());
        }
	}

	// 定时任务查询推送数据并推送
	public function regularPushList($time){
		$where['status'] = 0;
		$where['send_state'] = 1;
		$where['push_time'] = array('between',array($time,$time+60));
		$list = $this->where($where)->select();

		$count = count($list);
		$nowTime = $time;
		$j = 1;
		for ($i=0; $i < $count; $i++) { 
			if ($i == $j * 600) {
				while ($time = time()) {}
				$j++;
				$nowTime = time();
			}
			$list[$i]['userId'] = json_decode($list[$i]['userId']);
			$result = D('Common/Push')->push($list[$i]['title'], 'message', $list[$i]['userId'], $list[$i]['content'], $list[$i]['type'], $list[$i]['record_id'], $list[$i]['record_table']);
			if ($result) {
				M('PushRegular')->where(array('id' => $list[$i]['id']))->setField('send_state', 0);
			} else{
				M('PushRegular')->where(array('id' => $list[$i]['id']))->setInc('push_time', 300);
			}
			
		}
		return true;
	}
}