<?php
namespace Timepushremind\Controller;
use Think\Controller;

/**
 * 定时推送
 * @author wangzhiliang <1337841872@qq.com>
 * @param type 推送类型 1新审批请求推送 2审批结果推送 3 双十拜访计划提醒推送 4长久未拜访提醒推送 5官方公告推送 6会议安排提醒推送 7会议安排即将开始提醒推送 8上班打卡提醒推送 9考试安排提醒推送 10考试即将开始提醒推送 11 学术交流计划提醒推送   12  其他事务计划提醒推送
 */
class TimePushRemindController extends Controller {

	protected function _initialize(){

        /* 读取数据库中的配置 */
        $config =   S('DB_CONFIG_DATA');
        if(!$config){
            $config = api('Config/lists');
            S('DB_CONFIG_DATA',$config);
        }
        C($config); //添加配置

    }

	// 定时任务
	public function timePushRemind(){
		D('Common/PushRegular')->regularPushList(time());
		echo 'success';
	}

    //将前台的日志生成excel通过邮件形式发送给客户
    public function sendHomeLogToMemberByEmail() {
        //循环商户列表，获取商户信息
        $memberModel = D('Common/Member');
        $homeLogModel = D('Common/HomeLog');
        $memberMModel = M('Member');
        $memberAttributeValueModel = M('MemberAttributeValue');
        $homeLogModularAccessModel = M('HomeLogModularAccess');
        $memberData = $memberModel->getMemberByLimit();
        $now_time = time();
        foreach ($memberData as $k => $v) {
            //获取日志发送数量和发个时间间隔
            $log_data = $this->_getDataAccess($v['id'], 'data_num,send_num');
            if ($log_data['send_num'] == 0 || $log_data['data_num'] == 0) {
                continue;
            }
            //判断时间是否符合要求 上次发送时间+间隔《=现在的时间 满足要求
            if (($log_data['send_num']*24*3600+$v['send_homelog_time']) > $now_time) {
                continue;
            }
            //获取用户接收数据的邮箱
            $where['member_id']    = array('EQ', $v['id']);         // 用户的id
            $where['attribute_id'] = array('EQ', C('MEMBER_HOMELOG_EMAIL_ATTR_ID')); // 用户的扩展属性的id
            $email = $memberAttributeValueModel->where($where)->getfield('attr_value');
            if (empty($email)) {
                continue;
            }
            //获取数据并且导出
            unset($where);
            //获取用户配置的日志权限
            $memberAuths = $homeLogModularAccessModel->where('member_id='. $v['id'])->field()->select(); // 获取到的用户日志的权限
            $memberAuths = i_array_column($memberAuths, 'modular_id');
            $memberAuths = implode(',', $memberAuths);
            $where['homelog.log_type'] = array('in', $memberAuths);
            $where['homelog.start_time'] = array('between', array($v['send_homelog_time'], $now_time));
            $where['homelog.member_id'] = array('eq', $v['id']);
            $data = $homeLogModel->getHomeLogNoPage($where, $log_data['data_num']);
            foreach ($data as $key => $value) {
                if (!empty($value['start_time']) && !empty($value['end_time'])) {
                    $data[$key]['last_time'] = getTimeContent($value['end_time'] - $value['start_time']);
                }
                $data[$key]['start_time'] = time_format($value['start_time']);
                $data[$key]['end_time'] = time_format($value['end_time']);
                $data[$key]['terminal_type'] = show_homelog_terminal_type($value['terminal_type']);
            }
            $title_array = array('日志类型', '日志内容', '操作时间', '操作时间', '持续时间', '操作人', '终端类型');
            array_unshift($data, $title_array);
            $count = count($data);
            $result = create_xls($data, C('WEB_SITE_TITLE').'日志表', C('WEB_SITE_TITLE').'日志表', C('WEB_SITE_TITLE').'日志表', array('A','B','C','D','E','F', 'G'), $count, 1);
            $files = array(array('file_path'=>'.'.$result, 'file_name'=>C('WEB_SITE_TITLE').'日志.xls'));
            $email_result = sendEmail($email, C('WEB_SITE_TITLE').'日志', C('WEB_SITE_TITLE').'日志', $files);
            //保存发送日志时间
            if ($email_result['status'] == 1) {
                $memberMModel->where('id='.$v['id'])->data(array('send_homelog_time'=>$now_time))->save();
            }
        }
        echo 'success';
    }

    /**
     * 根据传入的用户数据权限类型获取该权限的值
     * @param string $accessType
     * @return int   $intAccessTypeValue
     */
    protected function _getDataAccess($member_id, $accessType){
        $where['member_id'] = $member_id; // 根据配置的常量获取登录的用户的id
        $intAccessTypeValue = M('DataAccess')->field($accessType)->where($where)->find(); // 根据用户id和需要获取的用户数据权限的类型获取该用户数据权限的类型的值 
        return $intAccessTypeValue;
    } 
   
}