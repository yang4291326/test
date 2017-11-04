<?php
namespace Alliancemerchant\Model;
use Think\Model;
/**
 * 联盟商家详情表前端模型.
 * @author wangwujiang QQ:1358140190
 */
class AllianceMerchantDetailModel extends Model{

    protected $selectFields = array('id', 'photo_path', 'name', 'address', 'recommend', 'phone', 'others');
    public function merchantList($where, $field = null, $count, $order=' id desc'){
        if ($field == null) {
            $field = $this->selectFields;
        }
        $data = $this
            ->where($where)
            ->limit($count)
            ->field($field)
            ->order($order)
            ->select();
        return $data = array(
            'data' => $data

        );
    }

}