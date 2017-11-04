<?php
namespace Admin\Controller;

/**
 * 后台日志管理控制器
 * @author liuyang <594353482@qq.com>
 */
class AdminLogController extends AdminCommonController {

    //后台日志列表
    public function adminlog() {
    	$log_url = I('log_url', '', 'trim');
    	if (!empty($log_url)) {
    		$where['menu.title'] = array('like', '%'.$log_url.'%');
    	}
    	$log_type = I('log_type', '');
    	if ($log_type != '') {
    		$where['adminlog.log_type'] = array('eq', $log_type);
    	}
    	$log_status = I('log_status', '');
    	if ($log_status != '') {
    		$where['adminlog.log_status'] = array('eq', $log_status);
    	}
    	/*杨yongjie  添加*/
    	$where['member_id']=UID;//根据登录的用户展示对应的操作日志
        //如果是超级管理员,可以查看所有操作日志
        if($where['member_id']==1){
            unset($where['member_id']);
        }
        /*杨yongjie  添加*/
        $data = D('AdminLog')->getAdminLogByPage($where);
        $memberModel = M('Member'); 
        foreach ($data['list'] as $key => $value) {
        	$data['list'][$key]['member_name'] = $memberModel->where('id='.$value['member_id'])->getfield('user_name');
        }
        $prompt_tips = $this->_getPromptLanguage(); //获取提示语
        $this->assign('prompt_tips', $prompt_tips);
        //设置分页变量
       	$this->assign('list', $data['list']);
       	$this->assign('page', $data['page']);
        $this->display('adminlog');
    }

    // 放入回收站
    public function del(){
        $this->_del('AdminLog');  //调用父类的方法
    }
    
}