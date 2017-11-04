<?php
namespace Admin\Controller;

/**
 * 后台配置控制器
 * @author 袁玉林 <755687023@qq.com>
 */
class MenuController extends AdminCommonController {

    /**
     * 后台菜单首页
     * @return none
     */
    public function index(){
        $pid  = I('pid', 0, 'intval');
        if($pid){
            $data = M('Menu')->where("id={$pid}")->field(true)->find();
            $this->assign('data',$data);
        }
        $title      =   trim(I('post.title'));
        $all_menu   =   M('Menu')->getField('id,title');
        $map['pid'] =   $pid;
        if($title)
            $map['title'] = array('like',"%{$title}%");
        $list       =   M("Menu")->where($map)->field(true)->order('sort asc,id asc')->select();
        int_to_string($list,array('display'=>array(1=>'是',0=>'否')));
        if($list) {
            foreach($list as &$key){
                if($key['pid']){
                    $key['up_title'] = $all_menu[$key['pid']];
                }
            }
            $this->assign('list',$list);
        }
        $this->meta_title = '菜单列表';
        $prompt_tips = $this->_getPromptLanguage(); //获取提示语
        $this->assign('prompt_tips', $prompt_tips);
        $this->display();
    }
    
    //删除菜单
	public function del(){
        $this->_del('Menu');  //调用父类的方法
    }

    /**
     * 新增菜单
     * @author liuyang <594353482@qq.com>
     */
    public function add(){
        if(IS_POST){
            $Menu = D('Menu');
            $data = $Menu->create();
            if($data){
                $id = $Menu->add();
                if($id){
                    $this->ajaxReturn(v(1, '保存成功'));
                } else {
                    $this->ajaxReturn(v(0, '新增失败'));
                }
            } else {
                $this->ajaxReturn(v(0, $Menu->getError()));
            }
        } else {
            $this->assign('info',array('pid'=>I('pid')));
            $menus = M('Menu')->field(true)->select();
            $menus = D('Common/Tree')->toFormatTree($menus, 'title', 'id', 'pid');
            $menus = array_merge(array(0=>array('id'=>0,'title_show'=>'顶级菜单')), $menus);
            $this->assign('Menus', $menus);
            $this->meta_title = '新增菜单';
            $this->display('edit');
        }
    }

    /**
     * 编辑菜单
     * @author liuyang <594353482@qq.com>
     */
    public function edit($id = 0){
        if(IS_POST){
            $Menu = D('Menu');
            $data = $Menu->create();
            if($data){
                if($Menu->save()!== false){
                    // S('DB_CONFIG_DATA',null);
                    $this->ajaxReturn(v(1, '保存成功'));
                } else {
                    $this->ajaxReturn(v(0, '新增失败'));
                }
            } else {
                $this->ajaxReturn(v(0, $Menu->getError()));
            }
        } else {
            $info = array();
            /* 获取数据 */
            $info = M('Menu')->field(true)->find($id);
            $menus = M('Menu')->field(true)->select();
            $menus = D('Common/Tree')->toFormatTree($menus, 'title', 'id', 'pid');

            $menus = array_merge(array(0=>array('id'=>0,'title_show'=>'顶级菜单')), $menus);
            $this->assign('Menus', $menus);
            if(false === $info){
                $this->error('获取后台菜单信息错误');
            }
            $this->assign('info', $info);
            $this->meta_title = '编辑后台菜单';
            $this->display();
        }
    }

    public function toogleHide($id,$value = 1){
        $this->editRow('Menu', array('display'=>$value), array('id'=>$id));
    }

    public function toogleDev($id,$value = 1){
        $this->editRow('Menu', array('is_dev'=>$value), array('id'=>$id));
    }

    /**
     * 菜单排序
     * @author liuyang <594353482@qq.com>
     */
    public function sort(){
        if(IS_GET){
            $ids = I('get.ids');
            $pid = I('get.pid');

            //获取排序的数据
            $map = array('status'=>array('gt',-1));
            if(!empty($ids)){
                $map['id'] = array('in',$ids);
            }else{
                if($pid !== ''){
                    $map['pid'] = $pid;
                }
            }
            $list = M('Menu')->where($map)->field('id,title')->order('sort asc,id asc')->select();

            $this->assign('list', $list);
            $this->meta_title = '菜单排序';
            $this->display();
        }elseif (IS_POST){
            $ids = I('post.ids');
            $ids = explode(',', $ids);
            foreach ($ids as $key=>$value){
                $res = M('Menu')->where(array('id'=>$value))->setField('sort', $key+1);
            }
            if($res !== false){
                $this->ajaxReturn(v(1, '排序成功'));
            }else{
                $this->ajaxReturn(v(0, '排序失败'));
            }
        }else{
            $this->ajaxReturn(v(0, '非法请求'));
        }
    }
}
