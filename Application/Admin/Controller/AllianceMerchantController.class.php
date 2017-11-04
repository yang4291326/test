<?php
namespace Admin\Controller;
/**
 * 互相引流控制器
 * @author wangwujiang <1358140190@qq.com>
 */
class AllianceMerchantController extends AdminCommonController{
    //联盟商家详情管理列表
    public function index() {
        $allianceData = D("AllianceMerchantDetail")->search();

        if($allianceData) {
            $this->assign('data',$allianceData['data']);
            $this->assign('page',$allianceData['page']);
        }
        $prompt_tips = $this->_getPromptLanguage(); //获取提示语
        $this->assign('prompt_tips', $prompt_tips);
        $this->display();
    }
    //联盟商家管理的添加与修改
    public function edit(){
        $id = I('id', 0, 'intval');
        if (IS_POST){
            $data = D('AllianceMerchantDetail');
            if ($data->create() !== false){
                if ($id > 0) {
                    $data->where('id='. $id)->save();
                } else {
                    $data->add();
                }
                $this->ajaxReturn(V(1, '保存成功'));
            } else {
                $this->ajaxReturn(V(0, $data->getError()));
            }
        } else {
            /* 获取数据 */
            $info = M('AllianceMerchantDetail')->field(true)->find($id);

            $this->assign('info', $info);

            $this->display();
        }
    }
    
   
    // 物理删除
    public function del(){
        $this->_del('AllianceMerchantDetail');  //调用父类的方法
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