<?php
namespace Admin\Controller;
use Common\Tools\Zip;

/**
 *  皮肤管理控制器
 *  @author yuanyulin <QQ:755687023>
 */
class SkinController extends AdminCommonController {
    
    // 皮肤管理列表 
    public function index(){
        $data = D('Skin')->getSkinByPage();
        $this->assign('data', $data['list']);
        $this->assign('page', $data['page']);
        $this->display('index');     
    }
    
    // 修改联盟商家
    public function edit(){        
        $id = I('id', 0, 'intval');
        if (IS_POST) {
            $skinModel = D('Skin');
            if( $skinModel->create() !== false ){
                if ($id > 0) {   
                    $skinModel->where('id='. $id)->save();
                } else {
                    $skinModel->add();
                }
                $this->ajaxReturn(V(1, '保存成功'));
            } else {
                $this->ajaxReturn(V(0, $skinModel->getError()));
            }
        } else {  
            $where['status'] = array('EQ', 0);
            $where['id']     = array('EQ', $id);
            $info = M('Skin')->field('id, name, photo_path, file_path, sort,member_ids, disabled')->where($where)->find();
            $operatePerson = explode(',', $info['member_ids']);
            foreach ($operatePerson as $key => $value) {
                $operatePerson[$key] = M('Member')->where('id='. $value)->getfield('user_name');
            }
            if (!isset($operatePerson[0])) {
                $operatePerson = '';
            } else {
                $operatePerson = implode(',', $operatePerson).',';
            } 
            $this->assign('info', $info);
            $this->assign('operatePerson', $operatePerson);
            $this->display();
        }
    }    
    
    // 设置默认皮肤
    public function configSkin(){
        $data = D('Skin')->getSkinByPage(1);// 获取登录人员可用的皮肤
        $defaultSkin = M('Member')->where('id='.UID)->getfield('skin_id'); // 获取登陆人员的默认皮肤
        $this->assign('defaultSkin', $defaultSkin);
        $this->assign('data', $data['list']);
        $this->assign('page', $data['page']);
        $this->display('configSkin');
    }
    
    // 解压zip文件
    public function startUnzip(){
        $path = I('post.tmpName', '');
        $zipUnpath = I('post.zipUnpath', '');

        $zip = new Zip();
        $result = $zip->unzip('./'.$path, '.'.$zipUnpath.'/'); 
        $jsonInfo = $this->isRightJson($result);
        if ($jsonInfo) {
            echo $result;
        } else {
            echo '0'; // json 不正确返回0
        }    
    }  
    
    // 判断上传的格式是否正确
    private function isRightJson($zipPath) {
        $jsonPath = '.'.$zipPath . 'config.json';
        if(file_exists($jsonPath)){
            $fp = fopen($jsonPath, "r");
            $str = fread($fp,filesize($jsonPath));//指定读取大小，这里把整个文件内容读取出来
            $jsonInfo = json_decode($str, true);
        }
        return $jsonInfo;   
    }

    // 上传图片
    public function uploadImg(){
        $this->_uploadImg();  //调用父类的方法
    }
    // 上传附件
    public function uploadField(){
        $this->_uploadField();  //调用父类的方法        
    }
    
    // 删除图片
    public function delImg(){
        $this->_delFile();  //调用父类的方法
    }
    
    // 逻辑删除
    public function del(){
        $this->_recycle('Skin');  //调用父类的方法
    }

    /*杨yongjie  添加*/
    // vr菜单图标设置
    public function setVricon(){
        if(!IS_POST){
            $where['member_id']=UID;
            $where['level']=2;
            $res=M('ShopGoodsType')->field('name,pic_path,pic_hover_path,id')->where($where)->select();
            $this->assign('res',$res);
            $this->display();
        }else{
            if(empty($_FILES)){
                $this->error('没有修改的数据','',1);
            }else{
                $config = array(
                    'mimes'         =>  array(), //允许上传的文件MiMe类型
                    'maxSize'       =>  8*1024*1024, //上传的文件大小限制 (0-不做限制)
                    'exts'          =>  array('jpg','png','gif','jpeg'), //允许上传的文件后缀
                    'autoSub'       =>  true, //自动子目录保存文件
                    'subName'       =>  array('date', 'Y-m-d'), //子目录创建方式，[0]-函数名，[1]-参数，多个参数使用数组
                    'rootPath'      =>  './Uploads/', //保存根路径
                    'savePath'      =>  'Picture/'.CONTROLLER_NAME.'/', //保存路径
                    'saveName'      =>  array('uniqid', ''), //上传文件命名规则，[0]-函数名，[1]-参数，多个参数使用数组
                    'saveExt'       =>  '', //文件保存后缀，空则使用原后缀
                    'replace'       =>  false, //存在同名是否覆盖
                    'hash'          =>  true, //是否生成hash编码
                    'callback'      =>  false, //检测文件是否存在回调，如果存在返回文件信息数组
                );

                $upload=new \Think\Upload($config);
                $info=$upload->upload($_FILES);
                //图片上传成功
                if($info){
                    foreach($info as $k => $v){
                        $length=strpos($v['key'],'-');//找到'-'第一次出现的位置
                        $where['id']=substr($v['key'],0,$length);//获取条件id
                        $name=substr($v['key'],$length+1);//获取修改字段
                        if($name =='pic_path'){//判断
                            $data['pic_path']='/Uploads/'.$v['savepath'].$v['savename'];
                            $res=M('ShopGoodsType')->where($where)->save($data);
                            if(!$res){
                                $this->error('修改失败');
                            }
                        }elseif($name =='pic_hover_path'){//判断
                            $data['pic_hover_path']='/Uploads/'.$v['savepath'].$v['savename'];
                            $rest=M('ShopGoodsType')->where($where)->save($data);
                            if(!$rest){
                                $this->error('修改失败');
                            }
                        }
                    }
                    $this->success('修改成功','/Admin/Skin/setVricon');
                //上传失败
                }else{
                    $this->error($upload->getError(),'',1);
                }
            }
        }
    }
    /*杨yongjie  添加*/

    // ajax设置默认启动皮肤
    public function ajaxChangeSkin(){
        if (IS_AJAX) {
            $id = I('id', 0, 'intval');
            $result = M('Member')->where('id='. UID)->setField('skin_id', $id);
            if ($result) {
                return 1;         
            }
        }
    }
}
