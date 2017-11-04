<?php
namespace Admin\Controller;

/**
 * 后台模块提示语控制器
 * @author yuanyulin <QQ: 756687023>
 */
class PromptLanguageController extends AdminCommonController {

    // 后台模块提示语显示列表
    public function index(){
        $arrayPromptLanguageData = D('PromptLanguage')->getPromptLanguageDataByPage();
        $prompt_tips = $this->_getPromptLanguage(); //获取提示语
        $this->assign('prompt_tips', $prompt_tips);
        $this->assign('list', $arrayPromptLanguageData['list']);
        $this->assign('page', $arrayPromptLanguageData['page']);
        $this->display();
    }
    
    // 后台模块提示语 (添加、修改)
    public function edit(){
        $id = I('id', 0, 'intval');
        if (IS_POST) {
            $menuId = I('post.menu_id', 0, 'intval'); 
            if($menuId == 0) // 如果后台模块名称不进行选择则提示信息
                $this->ajaxReturn(V(0, "后台模块名称必须选择！"));

            $PromptLanguageModel = D('PromptLanguage');
            if($PromptLanguageModel->create() !== false){
                if ($id > 0) {                   
                    $PromptLanguageModel->where('id='. $id)->save();
                } else {
                    $menuCount = M('PromptLanguage')->where('menu_id='.$menuId)->count();
                    if ( $menuCount != 0 )
                        $this->ajaxReturn(V(0, "后台模块提示语已经添加！"));
                    $PromptLanguageModel->add();
                }
                $this->ajaxReturn(V(1, '保存成功'));
            } else {
                $this->ajaxReturn(V(0, $PromptLanguageModel->getError()));
            }
        } else {
            $info = M('PromptLanguage')->field(true)->where('id='.$id)->find();
            
            $where['group'] = array('NEQ', '');
            $menuData = M('Menu')->field('id, title')->where($where)->select(); // 获取可以设置后台模块提示语的模块
            
            $this->assign('info', $info);
            $this->assign('menuData', $menuData);
            $this->display();
        }
    }

    public function recycle(){
        $this->_del('PromptLanguage');
    }
}
