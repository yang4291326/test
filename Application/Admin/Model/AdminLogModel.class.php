<?php
namespace Admin\Model;
use Think\Model;
/**
 *  后台日志列表模型
 *  @author liuyang QQ:594353482
 *
 */
class AdminLogModel extends Model{
    protected $insertFields = array('member_id', 'log_type', 'log_info', 'log_url', 'log_status', 'log_time');
    protected $updateFields = array('id', 'member_id', 'log_type', 'log_info', 'log_url', 'log_status', 'log_time');
    protected $selectFields = array('id', 'member_id', 'log_type', 'log_info', 'log_url', 'log_status', 'log_time');

    protected $_validate = array(
        array('log_type', array(0,1,2,3,4), '非法数据, 日志类型字段', self::MUST_VALIDATE, 'in', 3),
        array('log_info','require','日志内容不能为空', self::MUST_VALIDATE),
        array('log_info', '1,255', '日志内容不能超过255个字符', self::MUST_VALIDATE, 'length', 3),
        array('log_url','require','日志模块不能为空', self::MUST_VALIDATE),
        array('log_url', 'number', '非法数据, 日志模块字段', self::MUST_VALIDATE, 'function', 3),
        array('log_status', array(0,1), '非法数据, 日志状态字段', self::MUST_VALIDATE, 'in', 3),
    );

    /**
     * 获取后台日志分页方法
     * @param array $where 传入where条件
     * @param string $order 排序方式
     * @return array 搜索数据和分页数据
    */
    public function getAdminLogByPage($where, $field=null, $order='log_time desc'){
        if ($field == null) {
            $field = $this->selectFields;
        }
        $count = $this->alias('adminlog')
            ->join('__MENU__ menu on menu.id=adminlog.log_url','left')
            ->where($where)
            ->count();
        $page = get_page($count);
        
        $data = $this->field('adminlog.*,menu.title')->alias('adminlog')
            ->join('__MENU__ menu on menu.id=adminlog.log_url','left')
            ->where($where)
            ->limit($page['limit'])
            ->order($order)
            ->select();

        return array(
            'list' => $data,
            'page' => $page['page']
        );   
    }
}
