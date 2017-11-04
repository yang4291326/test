<?php
namespace Admin\Model;
use Think\Model;
/**
 * 升级信息表模型
 * @author wangwujiang QQ:1358140190
 */
class UpgradeModel extends Model{
    protected $insertFields = array('name', 'version', 'type', 'mode', 'remark', 'file_path');
    protected $updateFields = array('id', 'name', 'version', 'type', 'mode', 'remark','file_path');
    protected $selectFields = array('id', 'name', 'version', 'type', 'mode', 'add_time', 'add_id', 'update_time', 'update_id', 'file_path', 'remark');

    protected $_validate = array(
        array('name', '1,100', '升级名称长度在1-100个字符之间', self::MUST_VALIDATE, 'length', 3),
        array('mode', array(0,1), '非法数据, 升级方式是否为下载页或者点击提示', self::MUST_VALIDATE, 'in', 3),
        array('version', '1,60', '升级版本名称长度在1-60个字符之间', self::MUST_VALIDATE, 'length', 3),
    );

    // 升级信息表详情
    public function search(){
        $name = I('post.name', '','trim');
        if ($name) {
            $where['name'] = array('like',"%$name%");
        }
        $where['update_id'] = array('eq', UID);
        $data = $this->getUpgradeByPage($where, $field=null, $order='id desc');
        return $data;
    }
    protected function _before_insert(&$data,$option) {
        $data['add_time'] = time();
        $data['add_id'] = UID;
        $data['update_time'] = time();
        $data['update_id'] = UID;
    }
    protected function _before_update(&$data,$option) {
        $data['update_time'] = time();
        $data['update_id'] = UID;
    }
    /**
     * 获取分页方法
     * @param array $where 传入where条件
     * @param string $order 排序方式
     * @return array 搜索数据和分页数据
     */
    public function getUpgradeByPage($where, $field=null, $order='id'){
        if ($field == null) {
            $field = $this->selectFields;
        }
        $count = $this->where($where)->count();
        $page = get_page($count);
        $data = $this->field($field)->where($where)->limit($page['limit'])->order($order)->select();
        return array(
            'data' => $data,
            'page' => $page['page']
        );
    }

}