<?php
namespace Admin\Controller;

/**
 * 后台管理员自定义属性控制器
 * @author  yuanyulin  <QQ:755687023>
 */
class CustomAttributeController extends AdminCommonController {

    // 后台管理员自定义属性列表
    public function index(){
        $getCustomAttributeDataByPageAndSearch = D('MemberAttribute')->getCustomAttributeByPage(); // 根据查询分页显示自定义属性列表
//        var_dump($getCustomAttributeDataByPageAndSearch);die;

        $this->assign('data', $getCustomAttributeDataByPageAndSearch['list']);
        $this->assign('page', $getCustomAttributeDataByPageAndSearch['page']);
        $prompt_tips = $this->_getPromptLanguage(); //获取提示语
        $this->assign('prompt_tips', $prompt_tips);
        $this->display();
    }
    
    //  添加或修改自定义属性列表
    public function edit(){
        $dataAccess = $this->_getDataAccess('attribute_configuration');
//        if ($dataAccess == 0) {
//            $this->error('没有操作权限！');
//            exit;
//        }
        /*杨yongjie  添加*/
        if (UID !=1 && $dataAccess == 0) {
            $this->error('没有操作权限！');
            exit;
        }
        /*杨yongjie  添加*/
        $id = I('id', 0, 'intval');
        if (IS_POST) {
            $customAttributeModel = D('MemberAttribute');
            if ($customAttributeModel->create() !== false) {
                if ($id > 0) { 

                    $customAttributeModel->where('id='. $id)->save();
                    $log_type = array('type' => 1, 'info' => '编辑');
                } else {
                    $id = $customAttributeModel->add();
                    $log_type = array('type' => 0, 'info' => '添加');
                }
                $this->_addAdminLog($log_type['type'], ''.$log_type['info'].'自定义属性id为'.$id.'的记录成功', '', 0);
                $this->ajaxReturn(V(1, '保存成功'));
            } else {
                $this->_addAdminLog($log_type['type'], ''.$log_type['info'].'自定义属性id为'.$id.'的记录失败', '', 1);
                $this->ajaxReturn(V(0, $customAttributeModel->getError()));
            }
        } else {
            $info = M('MemberAttribute')->field(true)->find($id);
            $this->assign('info', $info);
            $this->display();
        }
    }
    
    // 删除自定义属性
    public function recycle(){
        $id = I('id', 0, 'intval');
//        $count = M('MemberAttributeValue')->where('attribute_id='.$id)->count();// 删除之前判断该属性是否已经被使用，如果被使用了就不能删除！
//        if ($count > 0) {
//            $this->ajaxReturn(V(0, '该自定义属性已经被使用，不允许删除！'));
//        }
        /*杨yongjie  添加*/
        $attr_status=M('MemberAttribute')->where('id='.$id)->field('attr_status')->find();// 删除之前判断该属性是否已经被使用，如果被使用了就不能删除！
        if($attr_status['attr_status']==0){
            $this->ajaxReturn(V(0, '该自定义属性已经被使用，不允许删除！'));
        }
        /*杨yongjie  添加*/
        $this->_del('MemberAttribute');  //调用父类的方法
    }

}
