<?php
namespace Admin\Controller;

/**
 * 后台配置控制器
 */
class ConfigController extends AdminCommonController {

    /**
     * 配置管理
     */
    public function index(){
        /* 查询条件初始化 */
        $map = array();
        $map  = array('status' => 0);
        if(isset($_POST['group'])){
            $map['group']   =   I('group',0);
        }
        if(isset($_POST['name'])){
            $map['name']    =   array('like', '%'.(string)I('name').'%');
        }
        $list = $this->lists('Config', $map,'sort,id');
        $this->assign('group',C('CONFIG_GROUP_LIST'));
        $this->assign('group_id',I('get.group',0));
        $this->assign('list', $list);
        $this->meta_title = '配置管理';
        $prompt_tips = $this->_getPromptLanguage(); //获取提示语
        $this->assign('prompt_tips', $prompt_tips);
        $this->display();
    }
    
    /**
     * 逻辑删除配置
     */
	public function recycle(){
        $this->_recycle('Config');  //调用父类的方法
    }

    /**
     * 新增配置
     */
    public function add(){
        if(IS_POST){
            $Config = D('Config');
            $data = $Config->create();
            if($data){
                if($Config->add()){
                    S('DB_CONFIG_DATA',null);
                    $this->ajaxReturn(V(1, '保存成功'));
                } else {
                    $this->ajaxReturn(V(0, '新增失败'));
                }
            } else {
                $this->ajaxReturn(V(0, $Config->getError()));
            }
        } else {
            $this->meta_title = '新增配置';
            $this->assign('info',null);
            $this->display('edit');
        }
    }

    /**
     * 编辑配置
     */
    public function edit($id = 0){
        if(IS_POST){
            $Config = D('Config');
            $data = $Config->create();
            if($data){
                if($Config->save()){
                    S('DB_CONFIG_DATA',null);
                    $this->ajaxReturn(V(1, '保存成功'));
                } else {
                    $this->ajaxReturn(V(0, '修改失败'));
                }
            } else {
                $this->ajaxReturn(V(0, $Config->getError()));
            }
        } else {
            $info = array();
            /* 获取数据 */
            $info = M('Config')->field(true)->find($id);

            if(false === $info){
                $this->error('获取配置信息错误');
            }
            $this->assign('info', $info);
            $this->meta_title = '编辑配置';
            $this->display();
        }
    }

    /**
     * 批量保存配置
     */
    public function save($config){
        if($config && is_array($config)){
            $Config = M('Config');
            foreach ($config as $name => $value) {
                $map = array('name' => $name);
                $Config->where($map)->setField('value', $value);
            }
        }
        S('DB_CONFIG_DATA',null);
        $this->ajaxReturn(V(1, '保存成功'));
    }
    // 获取某个标签的配置参数
    public function group() {
        $id     =   I('get.id',1);
        $type   =   C('CONFIG_GROUP_LIST');
        $list   =   M("Config")->where(array('status'=>0,'group'=>$id))->field('id,name,title,extra,value,remark,type')->order('sort')->select();
        if($list) {
            $this->assign('list',$list);
        }
        $this->assign('id',$id);
        $this->meta_title = $type[$id].'设置';
        $prompt_tips = $this->_getPromptLanguage(); //获取提示语
        $this->assign('prompt_tips', $prompt_tips);
        $this->display();
    }

    /**
     * 配置排序
     */
    public function sort(){
        if(IS_GET){
            $ids = I('get.ids');

            //获取排序的数据
            $map = array('status'=>array('eq',0));
            if(!empty($ids)){
                $map['id'] = array('in',$ids);
            }elseif(I('group')){
                $map['group']	=	I('group');
            }
            $list = M('Config')->where($map)->field('id,title')->order('sort asc,id asc')->select();

            $this->assign('list', $list);
            $this->meta_title = '配置排序';
            $this->display();
        }elseif (IS_POST){
            $ids = I('post.ids');
            $ids = explode(',', $ids);
            foreach ($ids as $key=>$value){
                $res = M('Config')->where(array('id'=>$value))->setField('sort', $key+1);
            }
            if($res !== false){
                $this->ajaxReturn(V(1, '排序成功'));
            }else{
                $this->ajaxReturn(V(0, '排序失败'));
            }
        }else{
            $this->ajaxReturn(V(0, '非法请求'));
        }
    }
}
