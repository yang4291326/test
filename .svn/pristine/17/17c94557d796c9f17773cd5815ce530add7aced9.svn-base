<?php
namespace Template\Controller;

/**
 * APP模版控制器
 * create by jicy 
 */
class TemplateApiController extends \Common\Controller\CommonApiController {

    // 模版列表
    public function showArticleList(){
        $type = I('type', 0, 'intval'); //type 模版页面分类 0背景介绍  2实例分享 3收藏夹  5解决方案
        
        if ($type > 5) $this->apiReturn(0, '参数有误');
        
        $articleList = D('Template/Article')->getArticleList($type);
        if (empty($articleList)) $this->apiReturn(0, '信息不存在');
      
        foreach ($articleList as $key => $value) {
            
            $where['article_id'] = array('EQ', $value['id']);
            $result=D('Template/ArticleDetail')->getArticleDetailList($type, $where);
            empty($result)?$result=array():'';
            $articleList[$key]['info'] = $result;
        }
        $this->apiReturn(1, show_article_type($type), $articleList);
    }

    // 二维码模板
    public function qrcode(){
        $where['type'] = 1; 
        $where['member_id'] = UID;
        $where['status'] = 0;
        $art_list = M('article')->field('id,remark')->where($where)->find();
        unset($where);
        if (empty($art_list)) {
            $this->apiReturn(0, '二维码不存在');
        }
        $where['article_id'] = array('eq', $art_list['id']);
        $detail_list = M('article_detail')->order('sort,id')->where($where)->getField('photo_path', true);
        
        $data['welcome'] = $art_list['remark'];
        $data['pic'] = $detail_list;
        
        $this->apiReturn(1, '二维码', $data);
    }

}
