<?php
namespace Admin\Controller;

/**
 * ajax获取商户数据控制器
 * @author yuanyulin <755687023@qq.com>
 */
class AjaxGetMemberController extends AdminCommonController {
    
    // 选择人员
    public function selectPerson(){
        $type = I('get.type', '');
        $ids = I('get.ids', '');
        if ($ids) {
            $ids = explode(",", $ids); 
            foreach($ids as $key => $value){
                $memberIds[$key]['id']=$value;
            }
            foreach ($memberIds as $key => $value) {
                $memberIds[$key]['name'] = D('Member')->getMemberNameById($value['id']);
            }
        }
        
        $positionTree = M('Position')->select();
        $departmentTree = M('UserDepartment')->select();
        $this->assign('positionTree', $positionTree);
        $this->assign('departmentTree', $departmentTree);
        $this->assign('type', $type);
        $this->assign('memberIds', $memberIds);
        $this->display('selectPerson');
    }

    // 获取用户信息
    public function ajaxMemberSelectData(){
        // 获取查询条件
        $keywords = I('post.keywords', '', 'trim');
        
        $page = trim(I('page', 1, 'intval'));

        $where['status'] = array('EQ', 0);
        $where['type'] = array('EQ', 0);
        if ($keywords)
            $where['user_name'] = array('LIKE', "%$keywords%");

        // 获取列表展示的用户数据
        $result = D('AjaxMemberSelect')->ajaxMemberPage($where, $page);
        $this->ajaxReturn($result);
    }

}