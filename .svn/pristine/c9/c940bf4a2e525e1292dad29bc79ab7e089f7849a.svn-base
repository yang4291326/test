<?php
namespace Admin\Controller;

/**
 * 后台轮播图控制器
 * @author wangzhiliang QQ:1337841872 liniukeji.com
 */
class NavController extends AdminCommonController {

    // 手机APP首页导航
    public function mobileNav(){
        $result = $this->_navList();
        $promptTips = $this->_getPromptLanguage(); //获取提示语
        $this->assign('promptTips', $promptTips);
        $this->assign('list', $result['list']);
        $this->assign('page', $result['page']);
        $this->display('index');
    }

    // 查询列表
    private function _navList($where){
        $where['status'] = 0;
        $Nav = D('Nav');
        $list = $Nav->navList($where, $field, $order);
        //$list = D('Common/Tree')->toFormatTree($list);
        return $list;
    }

    // 轮播图添加、修改
    public function edit(){
        $id = I('id', 0, 'intval');     // Nav表的主键id
        $Nav = D('Nav');
        if (IS_POST) {
            if ($_POST['type'] == 1) {
                unset($_POST['img']);
            }
            if ($id == 0) {
                $data = $Nav->create(I('post.'), 1);
                if($data){
                    $Nav->add();
                    $this->ajaxReturn(V(1, '保存成功'));
                } else {
                    $this->ajaxReturn(V(0, $Nav->getError()));
                }
            } else{
                $data = $Nav->create(I('post.'), 2);
                if($data){
                    $Nav->save();
                    $this->ajaxReturn(V(1, '修改成功'));
                } else {
                    $this->ajaxReturn(V(0, $Nav->getError()));
                }
            }
            
        }
        $info = $Nav->detailInfo($id);
        //增加时间戳，处理缓存的问题
        if (!empty($info['img'])) {
            $info['img'] = $info['img'].'?'.rand();
        }
        $this->assign('info', $info);       
        $this->display();
    }

    public function recycle(){
        $this->_recycle('Nav');
    }

    // 删除图片
    public function delFile(){
        $this->_delFile();  //调用父类的方法
    }

    // 上传图片
    public function uploadImg(){
        $this->_uploadImg();  //调用父类的方法
    }

    // 改变可用状态
    public function changeDisabled(){
        $this->_changeDisabled('Nav');  //调用父类的方法
    }
}
