<?php
namespace Upgrade\Model;
use Think\Model;
/**
 * 升级详情表前端模型.
 * @author wangwujiang QQ:1358140190
 */
class UpgradeDetailModel extends Model{
    protected $insertFields = array('upgrade_time', 'status');
    protected $updateFields = array('id','upgrade_time', 'status');
    protected $selectFields = array('id', 'member_id', 'upgrade_time', 'upgrade_id', 'status');
    protected $_validate = array(

        array('status', array(0,1,2), '非法数据, 用户升级状态：0.未升级，1.升级失败，2.升级成功', self::EXISTS_VALIDATE, 'in', 3),
    );
}