<?php
namespace Common\Model;
use Think\Model;
/**
 *  前台日志列表模型
 *  @author liuyang QQ:594353482
 *
 */
class HomeLogModel extends Model{

    protected $selectFields = array('id', 'member_id', 'log_type', 'log_info', 'terminal_type', 'start_time', 'end_time', 'data_table', 'record_id');

    /**
     * 获取前台日志不分页方法
     * @param array $where 传入where条件
     * @param string $order 排序方式
     * @return array 搜索数据
    */
    public function getHomeLogNoPage($where, $limit, $field=null, $order='homelog.id desc'){
        if ($field == null) {
            $field = $this->selectFields;
        }
        $data = $this->alias('homelog')
            ->field('homelogmodular.name, homelog.log_info, homelog.start_time, homelog.end_time, \'\' as last_time, member.user_name, homelog.terminal_type')
            ->join('__MEMBER__ member on member.id=homelog.member_id','left')
            ->join('__HOME_LOG_MODULAR__ homelogmodular on homelogmodular.id=homelog.log_type','left')
            ->where($where)
            ->limit($limit)
            ->order($order)
            ->select();

        return $data;
    }
}
