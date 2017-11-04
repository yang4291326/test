<?php
namespace Admin\Controller;

/**
 * 模块管理控制器
 * @author yuanyulin <QQ:755687023>
 */
class ArticleController extends AdminCommonController {
    
    // 模块管理列表
    public function index() {  
        $type = I('type', 0, 'intval');
        $keywords = I('keywords', '', 'trim');
        if($keywords) $where['name'] = array('like',"%$keywords%");          
        $articleData = D("Article")->getArticleByPage($type,$where);
        switch ($type) {
            case '0': // 背景介绍 
                $titleAccess = 'interface_template_num';// 背景介绍模板-标题数量
                break;
            case '1': // 二维码模板
                break;
            case '2': // 实例分享模板
                $titleAccess = 'interface_switch_num';// 实例分享模板-分类数量
                break;
            case '3': // 收藏夹模板
                break;
            case '4':// 首页模板
                $titleAccess = 'custom_template_num'; // 自定义模板数量
                break;
            case '5':// 解决方案模板
                $titleAccess = 'olution_num';// 解决方案-标题数量
                break;
        }
        if ($type == 1) {
            $titleAccessInfo = 1;
        } elseif ($type == 3) {
           $titleAccessInfo = M('ShopGoods')->where('member_id='. UID)->count();
        } elseif ($type == 4) {
            $titleAccessInfo = 3;
        } else {
            $titleAccessInfo = $this->_getDataAccess($titleAccess); // 标题数量
        }

        $promptTips = $this->_getPromptLanguage(); //获取提示语
        $title = show_article_type($type);
        $this->assign('promptTips', $promptTips);
        $this->assign('type', $type);
        $this->assign('title', $title);
        $this->assign('titleAccessInfo', $titleAccessInfo);
        $this->assign('list', $articleData['list']);
       	$this->assign('page', $articleData['page']);
       	$this->assign('count', $articleData['count']);
        $this->display();        
    }
    // 模块管理的添加与编辑
    public function edit(){

        $type = I('type', 0, 'intval'); // 需要修改或者添加模块的类型
        $id = I('id', 0, 'intval'); // 需要修改的主表的id对应附表的article_id
        $count = I('count', 0, 'intval'); //用于判断已经添加的模版数量
        switch ($type) {
            case '0': // 背景介绍 
                $titleAccess = 'interface_template_num';// 背景介绍模板-标题数量
                $photoAccess = 'interface_template_photo_num'; // 背景介绍模板-图片数量
                $vidioAccess = 'interface_template_video_num'; // 背景介绍模板-视频数量
                break;
            case '1': // 二维码模板
                break;
            case '2': // 实例分享模板
                $titleAccess = 'interface_switch_num';// 实例分享模板-分类数量
                $photoAccess = 'interface_switch_photo_num'; // 实例分享模板-图片数量
                $vidioAccess = 'interface_switch_video_num'; // 实例分享模板-视频数量
                break;
            case '3': // 收藏夹模板
                break;
            case '4':// 首页模板                
                break;
            case '5':// 解决方案模板
                $titleAccess = 'olution_num';// 解决方案-标题数量
                $photoAccess = 'olution_photo_num';  // 解决方案-图片数量
                $vidioAccess = 'solution_video_num'; // 解决方案-视频数量
                break;
        }
        
        $titleAccessInfo = $this->_getDataAccess($titleAccess); // 标题数量
        $photoAccessInfo = $this->_getDataAccess($photoAccess); // 图片数量
        $vidioAccessInfo = $this->_getDataAccess($vidioAccess); // 视频数量
  
        if ( $type == 2 || $type == 5 || $type == 0) {
           $totalPhotoVidioInfo = $photoAccessInfo + $vidioAccessInfo; // 图片和视频的总数量            
        } elseif ( $type == 1 ){
            $titleAccessInfo = 1;
            $totalPhotoVidioInfo = 2; // 如果是二维码模板的话默认只能传入一个
        } elseif ($type == 3) { //收藏夹固定为1个模版8张图片
            $titleAccessInfo = M('ShopGoods')->where('member_id='. UID)->count();
            $totalPhotoVidioInfo = 8;
        } elseif ($type == 4) { //首页固定为3个模版 9张 第三个不限制
            $titleAccessInfo = 3;
            $totalPhotoVidioInfo = 9;//
            //获取已有模版的最大图片数量maxPictureNum
            $where['member_id'] = UID;
            $where['status'] = 0;
            $where['type'] = 4;
            $pictureId = M('Article')->where($where)->getField('id',true);//获取所有关联articledetail的id
            $maxId = max($pictureId);
            unset($where);

            foreach ($pictureId as $key => $value) {
                $where['article_id'] = $value;
                $pictureNum[$key] = M('ArticleDetail')->where($where)->count('id');
                unset($where);
            }
            $maxPictureNum = max($pictureNum);

            if ($count == 2 && $id == 0) { //添加时如果已经有图片数量大于9的不能创建新模版
                if ($maxPictureNum > $totalPhotoVidioInfo) {
                    $totalPhotoVidioInfo = 0;
                }else{
                    $totalPhotoVidioInfo = 1000;
                }
            }

            if ($count == 3 && $id ==$maxId) { //最新的id修改时数量不限（1000）
                $totalPhotoVidioInfo = 1000;
            }
        }
        if (IS_POST) {
            $articleData       = I('post.article', '');       // 获取到的需要加入到article主表中的信息
            $articleDetailData = I('post.articleDetail', ''); // 获取到的需要加入到articledetail附表中的信息

            $articleData['type'] = $type; // 获取类型
            
            $where['member_id'] = array('EQ', UID);
            $where['type']      = array('EQ', $type);
            $where['status']    = array('EQ', 0);
            $articleCount = M('Article')->where($where)->count();            
            unset($where);

            $articleModel = D('Article');
            M()->startTrans();  // 开启事务
            if($articleModel->create($articleData) !== false){
                if ($id > 0) {
                        $articleResult = $articleModel->where('id='. $id)->save();
                        $log_type = array('type' => 1, 'info' => '编辑');                
                    
                } else {
                    if ($articleCount >= $titleAccessInfo) {
                        $this->ajaxReturn(V(0, '已经超过添加限制！'));
                    }
                    $articleResult = $id = $articleModel->add(); // 此处的$id表示该用户是新加的那么就将该用户id保存下来，用于后续的表中。
                    $log_type = array('type' => 0, 'info' => '添加');
                }
            } else {
                $this->ajaxReturn(V(0, $articleModel->getError()));
            }

            // 插入模板附加属性信息表
            $articleDetailResult = D('articleDetail')->editarticleDetailValue($articleDetailData, $id);
            if ($articleDetailResult != 1) {
                $this->ajaxReturn(V(0, $articleDetailResult));
            }
            
            if ( ($articleResult && $articleDetailResult != 1) ) {

                M()->rollback(); // 事务回滚
                $this->_addAdminLog($log_type['type'], ''.$log_type['info'].'模版为'.$articleData['name'].'的记录成功', '', 1);
            } else {
                M()->commit(); // 事务提交
                $this->_addAdminLog($log_type['type'], ''.$log_type['info'].'模版为'.$articleData['name'].'的记录成功', '', 0);
                $this->ajaxReturn(V(1, '保存成功'));                
            } 
        } else {
            
            $articleData = M('Article')->field('id, member_id, name, sort, remark, goods_id')->where('id='. $id)->find(); // 查询模板表的主信息
            $articleData['goods_name'] = D('ShopGoodsAttributeValue')->getBasicAttrValue($articleData['goods_id'], 1); // 获取主商品的名称

            
            $articleDetailData = M('ArticleDetail')->where('article_id='. $id)->order('sort ,id')->select(); // 查询模板附加信息表的信息
            foreach ($articleDetailData as $key => $value) { // 获取附加文件的文件后缀
                $postfix = pathinfo($value['photo_path']);
                $articleDetailData[$key]['postfix'] = $postfix['extension'];
            }
            $articleDetailCount = M('ArticleDetail')->where('article_id='. $id)->count(); // 查询模板附加信息表的数量

            $this->assign('photoAccessInfo', $photoAccessInfo);
            $this->assign('vidioAccessInfo', $vidioAccessInfo);
            $this->assign('totalPhotoVidioInfo', $totalPhotoVidioInfo);
            $this->assign('info', $articleData);
            $this->assign('articleDetailData', $articleDetailData);
            $this->assign('articleDetailCount', $articleDetailCount);
            $this->assign('type', $type);
            $this->display();
        }        
    }
    
    // 获取商品的详细信息
    public function getGoodsPics(){
        $where['status'] = 0;
        $where['member_id'] = UID;
        $selectedGoodsId = M('Article')->distinct(true)->where($where)->getField('goods_id',true);
        unset($where);
        $imgId = I('get.imgId', 0, 'intval'); // 得到用户手动添加图片时获取到的图片变化id
        $shopGoodsData = D('ShopGoods')->getShopGoodsData();
        $shopGoodsAttributeModel = D('ShopGoodsAttributeValue'); // 实例化商品扩展信息
        foreach ($shopGoodsData['list'] as $key => $value) {
            $shopGoodsData['list'][$key]['goods_name'] = $shopGoodsAttributeModel->getBasicAttrValue($value['id'], 1);
        }
        $selectedGoodsId = json_encode($selectedGoodsId);

        $this->assign('imgId', $imgId);
        $this->assign('data', $shopGoodsData['list']);
        $this->assign('page', $shopGoodsData['page']);
        $this->assign('selectedGoodsId',$selectedGoodsId);
        $this->display('getGoodsPics');
    }

    // 上传图片
    public function uploadImg(){
        $this->_uploadField();  //调用父类的方法
    }
    
    public function recycle(){
        $this->_recycle('Article');
    }
    
    //模版排序
    public function sort(){
        if(IS_GET){           
            $type = I('get.type','', 'intval');
            $num = array(0,1,2,3,4,5);
            if (in_array($type, $num)) {
                
                    //获取排序的数据
                    $map['member_id'] = UID;
                    $map['status'] = 0;
                    $map['type'] = $type;
                if ($type !=3) {
                    $list = M('Article')->where($map)->field('id,name')->order('sort asc,id desc')->select();
                }else {

                    $arr = M('Article')->where($map)->field('id,goods_id')->order('sort asc,id desc')->select();
                   $shopValue = D('ShopGoodsAttributeValue');
                    foreach ($arr as $k => $v) {
                        $list[$k]['id'] = $v['id'];
                        $list[$k]['name'] =  $shopValue->getBasicAttrValue($v['goods_id'],1);
                    }
                }

                $this->assign('list', $list);
                /*杨yongjie  添加*/
                $this->assign('type', $type);//返回给前段,排序的时候跳转页面使用
                /*杨yongjie  添加*/
            }
            $this->display();
        }elseif (IS_POST) {
            $ids = I('post.ids');
            $ids = explode(',', $ids);
            foreach ($ids as $key=>$value) {
                $res = M('Article')->where(array('id'=>$value))->setField('sort', $key+1);
            }
            if ($res !== false) {
                $this->ajaxReturn(v(1, '排序成功'));
            } else {
                $this->ajaxReturn(v(0, '排序失败'));
            }
        } else {
            $this->ajaxReturn(v(0, '非法请求'));
        }
    }
    //预览详情
    public function preview() {

        $type = I('get.type','', 'intval');
        $id = I('get.id', 0, 'intval');
        $info = D('Article')->preview($type,$id);
        //p($info);
        foreach ($info as $key => $value) {
            $data[$key]['id'] = $value['id'];
            $data[$key]['name'] = $value['name'];
            $data[$key]['remark'] = nl2br($value['remark']);
            $data[$key]['goods_img'] = $value['goods_img'];
            $data[$key]['photo_path'] = D('Article')->previewDetail($value['id']);

        }

        $title = show_article_type($type);
        $this->assign('type', $type);
        $this->assign('title', $title);
        $this->assign('info',$data);
        $this->display('preview');
    }
}

