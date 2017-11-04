<?php
namespace Alliancemerchant\Controller;
/**
 * 互相引流前端控制器
 * @author wangwujiang <1358140190@qq.com>
 */
class AllianceMerchantApiController extends \Common\Controller\CommonApiController{

    // 互相引流商家列表
    public function merchantList(){
        $where['map_id']=I('post.mapid','','intval');/*杨yongjie  添加*/
        $where['member_id'] = array('eq', UID);
        //$field = 'photo_path, name,address, recommend, phone, others';/*杨yongjie  修改*/
        $count = _getDataAccess('drainage_num');
        $data = D('Alliancemerchant/AllianceMerchantDetail')->merchantList($where, $field, $count);
        $data = $data['data'];
        $this->apiReturn(1, '商家列表', $data);
    }
}