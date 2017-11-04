<?php
namespace Admin\Model;
use Think\Model;
/**
 * 升级信息详情表模型
 * @author wangwujiang QQ:1358140190
 */
class UpgradeDetailModel extends Model{
    protected $insertFields = array('member_id', 'upgrade_time', 'upgrade_id', 'status');
    protected $updateFields = array('id', 'member_id', 'upgrade_time', 'upgrade_id', 'status');
    protected $selectFields = array('id', 'member_id', 'upgrade_time', 'upgrade_id', 'status');
    protected $_validate = array(
        array('member_id', 'number', '非法数据, 用户id必须是数字！（必须选择升级用户）', self::MUST_VALIDATE, 'regex', 3),
        array('upgrade_id', 'number', '非法数据, upgrade_id必须是数字！', self::MUST_VALIDATE, 'regex', 3),
        array('upgrade_time', 'require', '升级时间不能为空', self::MUST_VALIDATE),
        array('status', array(0,1,2), '非法数据, 用户升级状态：0.未升级，1.升级失败，2.升级成功', self::MUST_VALIDATE, 'in', 3),
    );

    // 升级用户详情：member表与upgradeDetail表关联

    public function getUpgradeDetailList($where, $field = null, $order = 'id desc') {
        if ($field == null) {
            $field = $this->selectFields;
        }
        $count = $this->alias('detail')
            ->join('__MEMBER__ member ON detail.member_id = member.id', 'left')
            ->where($where)
            ->count('detail.id');
        $page = get_page($count);

        $data = $this->alias('detail')
            ->join('__MEMBER__ member ON detail.member_id = member.id', 'left')
            ->field($field)
            ->where($where)
            ->limit($page['limit'])
            ->order($order)
            ->select();

        return array(
            'list' => $data,
            'page' => $page['page']
        );
    }


    /**
     * 向升级信息详情表插入数据
     * @param string $data 传入data数据
     * @param string $id 升级信息表id
     * @return bool 插入数据成功
     */
    public function saveDetail($data, $id){
        $this->where('upgrade_id =' . $id)->delete();
        $userList = explode(',', $data);
        foreach ($userList as $key => $value) {
            $saveData['member_id'] = $value;
            $saveData['upgrade_time'] = time();
            $saveData['upgrade_id'] = $id;
            //自动验证$_validate
            if ($this->create($saveData) !== false) {
                $this->add();
            } else {
                return($this->getError());
            }
        }
            return true;
    }
}
