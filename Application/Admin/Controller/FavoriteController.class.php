<?php
namespace Admin\Controller;

/**
 * 后台收藏夹列表控制器
 * @author yuanyulin <QQ: 755687023>
 */
class FavoriteController extends AdminCommonController {

    // 显示用户收藏夹列表
    public function index(){        
        $favoriteData = D('Favorite')->getFavoriteDataByPage();
        $prompt_tips = $this->_getPromptLanguage(); //获取提示语
        $this->assign('prompt_tips', $prompt_tips);
        $this->assign('data', $favoriteData['list']);
        $this->assign('page', $favoriteData['page']);
        $this->display();        
    }
    
    // 显示用户收藏夹的详细信息
    public function showFavoriteDetail(){
        $id = I('id', 0, 'intval');
        $favoriteDetailData = D('FavoriteDetail')->getFavoriteDetailDataByPage($id);
        $this->assign('id', $id);
        $this->assign('data', $favoriteDetailData);
        $this->display('showFavoriteDetail');

    }

    /*杨yongjie  添加*/
    //修改用户收藏夹的用户信息
    public function edit(){
        if(IS_POST){
            $id=I('post.id','','intval');
            $post=I('post.','',trim);
            $where['id']=$id;
            $data['customer_name']=$post['customer_name'];
            $data['customer_phone']=$post['customer_phone'];
            $data['customer_address']=$post['customer_address'];
            $data['customer_deposit']=$post['customer_deposit'];
            $data['customer_code']=$post['customer_code'];
           if(!empty($post)){
              $result=D('Favorite')->where($where)->save($data);
              if($result){
                  $this->redirect('index',[],0);
              }else{
                  $this->error('修改失败','index',1);
              }
           }
        }else{
            $id=I('id', 0 ,'intval');
            //获取收藏夹用户信息
            $favoritedata=D('Favorite')->where('id='.$id)->select();
            $this->assign('favoritedata',$favoritedata);
            $this->display();
        }
    }
    /*杨yongjie  添加*/
    public function recycle(){
        $this->_recycle('Favorite');
    }
   
}
