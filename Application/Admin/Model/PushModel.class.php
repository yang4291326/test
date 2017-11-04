<?php
namespace Admin\Model;
use Think\Model;

class PushModel extends Model{
	
	protected $insertFields = array('id','title','url','content','description','img','add_time','open_type');
	protected $updateFields = array('id','title','url','content','description','img','add_time','push_time','open_type','status','delete_time','send_state');
	protected $selectFields = array('id','title','url','content','description','img','add_time','push_time','open_type','status','delete_time','send_state');

	protected $_validate = array(
		array('title', 'require', '公告推送名称不能为空', 1, 'regex', 3),
        array('title', '1,100', '公告推送标题长度有误,请输入1到1000个字符', 0, 'length', 3),
        array('description', 'require', '公告推送描述不能为空', 1, 'regex', 3),
        array('description', '1,255', '公告推送描述文字过长，小于100字', 0, 'length', 3),    
        array('content', 'require', '公告推送内容不能为空', 0, 'regex', 3),
		array('url','/^http:\/\//','跳转url有误！必须以http://开头', 0, 'regex', 3),
		array('url','1,255','跳转url有误！', 0, 'length', 3),
        array('open_type', array(1,2), '推送公告打开方式有误', 0, 'in', 3),
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
}