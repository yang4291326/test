<?php
namespace Admin\Controller;

/**
 * 前台日志模块管理控制器
 * @author liuyang <594353482@qq.com>
 */
class HomeLogModularController extends AdminCommonController {

    //前台日志模块列表
    public function index() {
        $homeLogModularModel=D('HomeLogModular');
        $where['status'] = 0;
        $info=$homeLogModularModel->field(true)->where($where)->order('sort, id')->select(); 
        //获取树形结构
        $data = D('Common/Tree')->toFormatTree($info);  
        $this->assign('data',$data);
        $prompt_tips = $this->_getPromptLanguage(); //获取提示语
        $this->assign('prompt_tips', $prompt_tips);
        $this->display();
    }
    //前台日志模块的添加与编辑
    public function edit($id = 0){
        $id = I('id', 0, 'intval');
        $homeLogModularModel = D('HomeLogModular');
        if(IS_POST){
            if($homeLogModularModel->create() !== false){
                if ($id > 0) {
                    if($homeLogModularModel->where('id='.$id)->save()===false){
                        $this->_addAdminLog(1, '修改名为'.I('name', '').'前台日志模块。', '', 1);
                        $this->ajaxReturn(V(0, $homeLogModularModel->getError()));
                    } else {
                        $this->_addAdminLog(1, '修改名为'.I('name', '').'前台日志模块。', '', 0);
                    }
                } else {
                    if ($homeLogModularModel->add()===false) {
                        $this->_addAdminLog(0, '新建名为'.I('name', '').'前台日志模块。', '', 1);
                    } else {
                        $this->_addAdminLog(0, '新建名为'.I('name', '').'前台日志模块。', '', 0);
                    }
                }
                $this->ajaxReturn(V(1, '保存成功'));
            } else {
                $this->ajaxReturn(V(0, $homeLogModularModel->getError()));
            }
        } else {
            /* 获取数据 */
            $info = $homeLogModularModel->field(true)->find($id);
            if(false === $info){
                $this->error('前台日志模块信息错误');
            }
            // 生成树型列表
            $homeLogModularTree = $homeLogModularModel->getHomeLogModularTree($id);

            $this->assign('homeLogModularTree', $homeLogModularTree);
            $this->assign('info', $info);
            $this->display();
        }
    }
    // 放入回收站
    public function recycle(){
        //判断是否有下级
        $id = I('id', 0);
        if ($id != 0) {
            $where['parent_id'] = array('in', $id);
            $where['status'] = array('eq', 0);
            $count = M('HomeLogModular')->where($where)->count();
            if ($count > 0) {
                $this->ajaxReturn(V(0, '日志模块存在下级，无法删除。'));
            }
            
        }
        $this->_recycle('HomeLogModular');  //调用父类的方法
    }
    
    // 删除图片
    public function delFile(){
        $this->_delFile();  //调用父类的方法
    }

    // 上传图片
    public function uploadImg(){
        $this->_uploadImg();  //调用父类的方法
    }
    
}