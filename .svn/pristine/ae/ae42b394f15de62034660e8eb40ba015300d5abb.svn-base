<?php
namespace Upgrade\Controller;
use Think\Controller;
/**
 * 升级信息前端控制器.
 * @author wangwujiang <1358140190@qq.com>
 */
class UpgradeTypeApiController extends Controller{
    /*杨yongjie  添加*/
    //获取手机端路径和版本号
    public function getType(){
        $this->_decode();
        $UseCode=I('post.UserCode','','trim');
        $code['machine_code']=array('eq',$UseCode);
        $member=M('MemberMachineCode')->where($code)->field('member_id')->find();
        $where['member_id'] = array('eq',$member['member_id']);
        $upgrade=M('UpgradeDetail')->where($where)->order('id desc')->find();
        unset($where);
        $where['id']=array('eq', $upgrade['upgrade_id']);
        $where['type']=array('eq', 2);
        $field='file_path, version';
        $data = M('Upgrade')->where($where)->field($field)->select();
        if(!empty($data)){
            $this->apiReturn(1,'版本号,文件路径', $data);
        }else{
            $this->apiReturn(0,'没有数据');
        }
    }
    //获取平板端路径和版本号
    public function getSlabType(){
        $this->_decode();
        $UseCode=I('post.UserCode','','trim');
        $code['machine_code']=array('eq',$UseCode);
        $member=M('MemberMachineCode')->where($code)->field('member_id')->find();
        $where['member_id'] = array('eq',$member['member_id']);
        $upgrade=M('UpgradeDetail')->where($where)->order('id desc')->find();
        unset($where);
        $where['id']=array('eq', $upgrade['upgrade_id']);
        $where['type']=array('eq', 1);
        $field='file_path, version';
        $data = M('Upgrade')->where($where)->field($field)->select();
        if(!empty($data)){
            $this->apiReturn(1,'版本号,文件路径', $data);
        }else{
            $this->apiReturn(0,'没有数据');
        }
    }
    protected function apiReturn($status, $message='', $data=''){
        if ($status != 0 && $status != 1) {
            exit('参数调用错误 status');
        }

        if ($data != '' && C('APP_DATA_ENCODE') == true) {
            $data = json_encode($data); // 数组转为json字符串
            $aes = new \Common\Tools\Aes();
            $data = $aes->aes128cbcEncrypt($data); // 加密
        }

        if (is_null($data) || empty($data)) $data = array();
        $this->ajaxReturn(V($status, $message, $data));

    }
    private function _decode(){
        $code = $_POST['code'];

        if ($code == '') {
            $this->ajaxReturn(V('0', '非法访问'));
        }

        if (C('APP_DATA_ENCODE') === true) {
            // 解密
            $aes = new \Common\Tools\Aes();
            $code = $aes->aes128cbcHexDecrypt($code);

            if ($code == '') {
                $this->ajaxReturn(V('0', '非法访问!'));
            }
        }

        $params = json_decode($code, true);

        // 重新赋值
        $_POST = null;
        foreach ($params as $key => $value) {
            // $_GET[$key] = $value;
            $_POST[$key] = $value;
        }
    }
    /*杨yongjie  添加*/
}