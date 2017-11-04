<?php
namespace Memberattributevalue\Controller;
/**
 * 前台自定义属性控制器
 * @author wangwujiang <1358140190@qq.com>
 */
class MemberAttributeValueApiController extends \Common\Controller\CommonApiController{
    // 首页问候语\VR问候语管理
    public function memberPropertyValue(){
        $where['member_id'] = array('eq', UID);
        $MemberValue = M('MemberAttributeValue');
        //首页问候语
        $indexValue = $MemberValue->where($where)->where(array('attribute_id' => 19))->getField('attr_value');
        //VR问候语
        $vrValue = $MemberValue->where($where)->where(array('attribute_id' => 20))->getField('attr_value');
        $data = array(
            'indexValue' => $indexValue,
            'vrValue' => $vrValue
        );
        $this->apiReturn(1, '首页问候语\VR问候语', $data);
    }

}