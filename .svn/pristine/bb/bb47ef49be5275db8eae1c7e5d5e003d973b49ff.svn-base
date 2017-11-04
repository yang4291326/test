<?php
namespace Admin\Controller;

/**
 *  地图管理控制器
 *  @author yuanyulin <QQ:755687023>
 */
class MapController extends AdminCommonController {
    
    // 联盟商家地图列表 
    public function index(){
        $data = D('AllianceMerchantMap')->getAllianceMerchantMapByPage();
        $this->assign('data', $data['list']);
        $this->assign('page', $data['page']);
        $this->display();        
    }
    
    // 修改联盟商家
    public function edit(){
        $id = I('get.id', 0, 'intval');
        if (IS_POST) {
            $allianceMerchantMapModel = D('AllianceMerchantMap');
            if( $allianceMerchantMapModel->create() !== false ){
                if ($id > 0) {   
                    $allianceMerchantMapModel->where('id='. $id)->save();
                } else {
                    $allianceMerchantMapModel->add();
                }
                $this->ajaxReturn(V(1, '保存成功'));
            } else {
                $this->ajaxReturn(V(0, $allianceMerchantMapModel->getError()));
            }
        } else {            
            $where['id'] = array('EQ', $id);
            $info = M('AllianceMerchantMap')->where($where)->find();
            unset($where);
            
            if ( is_null($info) ) { $info['id'] = 0; }
            $where['map_id'] = array('EQ', $id);
            $allianceData = M('AllianceMerchantDetail')->field(true)->where($where)->select();
            
            $allianceMerchantDetailData = json_encode($allianceData); // 获取联盟商家详情表的信息（用于显示商家地图信息）
            if ( is_null($allianceMerchantDetailData)) { $allianceMerchantDetailData = 0; }

            $this->assign('info', $info);
            $this->assign('allianceMerchantDetailData', $allianceMerchantDetailData);
            $this->display();  
        }
    }    

    // 联盟商家信息录入
    public function allianceMerchantMemberEdit(){
        if (IS_POST) {
            $id = I('post.id', 0, 'intval');
            $allianceMerchantDetailModel = D('AllianceMerchantDetail');
            if( $allianceMerchantDetailModel->create() !== false ){
                if ($id > 0) {   
                    $allianceMerchantDetailModel->where('id='. $id)->save();
                    $mapMainId = $id;
                } else {
                    $mapMainId = $allianceMerchantDetailModel->add();
                }           
                $this->ajaxReturn(V(1, '保存成功', $mapMainId));                
            } else {
                $this->ajaxReturn(V(0, $allianceMerchantDetailModel->getError()));
            }            
        } else {
            $curXpage              = I('get.curXpage', 0, 'intval');              // 获取区块的x坐标
            $curYpage              = I('get.curYpage', 0, 'intval');              // 获取区块的y坐标
            $mapId                 = I('get.mapId', 0, 'intval');                 // 获取区块的id
            $mapMainId             = I('get.mapMainId', 0, 'intval');             // 获取联盟商家地图表自增id
            $allianceMerchantMapId = I('get.allianceMerchantMapId', 0, 'intval'); // 获取地图的id
            
            $info = M('AllianceMerchantDetail')->where('id='. $mapMainId)->find();

            $this->assign('info',$info);
            $this->assign('curXpage', $curXpage);
            $this->assign('curYpage', $curYpage);
            $this->assign('mapId', $mapId);
            $this->assign('mapMainId', $mapMainId);
            $this->assign('allianceMerchantMapId', $allianceMerchantMapId);
            $this->display('allianceMerchantMemberEdit');            
        }
    }
    
    // 上传图片
    public function uploadImg(){
        $this->_uploadImg();  //调用父类的方法
    }
    
    // 删除图片
    public function delFile(){
        $this->_delFile();  //调用父类的方法
    }
    
    // 逻辑删除
    public function del(){
        $this->_del('AllianceMerchantMap');  //调用父类的方法
        // 地图删除之后删除地图坐标点
        $id = I('get.id', 0, 'intval');
        $where['map_id'] = array('IN', $id);
        M('AllianceMerchantDetail')->where($where)->delete();
    }

    // 用于用户更换图片或者删除图片的时候清空数据库
    public function mapDetailDel(){
        $id = I('post.mapId', 0, 'intval');
        M('AllianceMerchantDetail')->where('map_id='.$id)->delete();        
    }
}
