<?php
namespace Map\Controller;

/**
 * Created by liuniukeji.com
 * 用户地图接口
 * @author yuanyulin <7556870234@qq.com>
*/
class MapApiController extends \Common\Controller\CommonApiController {
    
    // 获取用户的地图信息
    public function map(){
        $where['member_id']  = array('EQ', UID); // 用户的id
        $data = M('AllianceMerchantMap')->field('id, name, photo_path, sort')->order('sort desc, id desc')->where($where)->select();
        $AllianceMerchantDetailModel = M('AllianceMerchantDetail');
        foreach ($data as $key => $value) {            
            $imgInfo = getimagesize( '.' . $value['photo_path'] );
            $imgInfoPic = explode(" ", $imgInfo[3]); 
            $data[$key]['width']  = $this->returnPreg($imgInfoPic[0]);  
            $data[$key]['height'] = $this->returnPreg($imgInfoPic[1]);             
            $data[$key]['shop_data'] = $AllianceMerchantDetailModel->field('id, position_x, position_y, name, photo_path, address, phone, recommend, others')->where('map_id='. $value['id'])->select();
            foreach ($data[$key]['shop_data'] as $k => $v) {
                $data[$key]['shop_data'][$k]['position_y'] = $v['position_y'] - ($data[$key]['width']/33);
                $data[$key]['shop_data'][$k]['position_x'] = $v['position_x'] - ($data[$key]['width']/36);
            }
        }
        if ($data) {
            $this->apiReturn(1, '可查看的地图信息', $data);            
        } else {
            $this->apiReturn(0, '没有可以查看的地图信息');            
        }
    }
    
    // 获取用户的联盟商家信息
    public function getAllianceMerchant(){
        $mapId = I('post.mapid', 0, 'intval');
        $where['member_id']  = array('EQ', UID); // 用户的id
        $where['map_id']     = array('EQ', $mapId);//图片的id
        $data = M('AllianceMerchantDetail')->field('id, name, photo_path, address, phone, recommend, others')->where($where)->select();
        if ($data) {
            $this->apiReturn(1, '可查看的联盟商家信息', $data);            
        } else {
            $this->apiReturn(0, '没有商家，快去找商家吧！');            
        }
    }
    
    /**
     * 根据传入的字符串返回处理完成的字符
     * @param type $info 输入的字符串
     * @return 返回的字符
     */
    private function returnPreg($info) {
        preg_match('/\d+/', $info, $matches);
        return $matches[0];
    }
}
