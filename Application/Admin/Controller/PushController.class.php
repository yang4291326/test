<?php
namespace Admin\Controller;

/**
 * 后台推送控制器
 * @author wangzhiliang QQ:1337841872 liniukeji.com
 */
class PushController extends AdminCommonController {

    // 推送列表
    public function pushList(){
        $list = D('Common/Push')->getList();

        $this->assign('list', $list['data']);
        $this->assign('page', $list['page']);
        $this->display('pushList');
    }

    // 添加、修改
    public function edit(){

        $id = I('id', 0, 'intval');     // push表的主键id
        $push = D('Common/Push');
        if (IS_POST) {
            if ($_POST['open_type'] == 1) {
                $content = $_POST['url'];
                unset($_POST['content']);
            }
            if ($_POST['open_type'] == 2) {
                $content = $_POST['content'];
                unset($_POST['url']);
            }
            if ($id == 0) {
                $data = $push->create(I('post.'), 1);
                if($data){
                    $push->type = 5;
                    $push->push_time = time();
                    $push->send_state = 0;
                    $id = $push->add();
                    $pushInfo = $this->getInfo($id);
                    $result = $push->push($pushInfo['title'], 'message', 'all', $pushInfo['content'], 5);
                    if ($result) {
                        $this->ajaxReturn(V(1, '提交并推送成功'));
                    } else {
                        $this->ajaxReturn(V(0, '提交并推送失败'));
                    }
                } else {
                    $this->ajaxReturn(V(0, $push->getError()));
                }
            } else{
                $data = $push->create(I('post.'), 2);
                if($data){
                    $push->type = 5;
                    $push->push_time = time();
                    $push->send_state = 0;
                    $push->save();
                    $pushInfo = $this->getInfo($id);
                    $result = $push->push($pushInfo['title'], 'message', 'all', $pushInfo['content'], 5);
                    if ($result) {
                        $this->ajaxReturn(V(1, '提交并推送成功'));
                    } else {
                        $this->ajaxReturn(V(0, '提交并推送失败'));
                    }
                } else {
                    $this->ajaxReturn(V(0, $push->getError()));
                }
            }
            
        }
        $info = M('Push')->find($id);

        $this->assign('info', $info);       
        $this->display();
    }

    
    public function detail(){

        $id = I('id', 0, 'intval');     // push表的主键id
        $push = D('Common/Push');
        $info = M('Push')->find($id);
        $this->assign('info', $info);       
        $this->display();
    }

    // 获取公告推送基本信息
    public function getInfo($id){
        $pushmodel = D('Common/Push');
        $push = $pushmodel->field('id, title, url, img, open_type, description')->where(array('id'=>$id))->find();
        $openType = $push['open_type'];

        if($openType == 1){//url
            $pushType = 'url';
            $push['content'] = $push['url'];
        }else if($openType == 2){// 自定义文章
            $pushType='url';
            $push['content'] = 'http://'.$_SERVER['SERVER_NAME'].':'.$_SERVER["SERVER_PORT"].'/Article/Push/pushArticleDetail?id='.$id;
        }
        return $push;
    }

    

    public function recycle(){
        $this->_recycle('Push');
    }

    // 上传图片
    public function uploadImg(){
        $this->_uploadImg();  //调用父类的方法
    }
}
