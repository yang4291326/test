<?php
namespace Admin\Controller;

/**
 * 后台首页控制器
 * create by zhaojiping <QQ:17620286>
 */
class IndexController extends AdminCommonController {

    /**
     * 后台首页
     */
    public function index(){
    	// 重组成多维数据
        $menu = node_merge($this->getMenus());
        // p($menu);

        // 根据组名重新分组
        foreach ($menu as $k => $v) {
            // p($v);die;
            foreach ($v['child'] as $key => &$value) {
                unset($value['child']);
                $menu[$k]['child'][$value['group']][] = $value;
                unset($menu[$k]['child'][$key]);
            }
        }
        // echo(json_encode($menu));
        $this->menus = json_encode($menu);
		$this->meta_title = C('WEB_SITE_TITLE');
        $this->display();
    }

    //获取首页展示数据
    public function welcome(){
//        $this->display();
    }

    /**
     * 获取控制器菜单数组,二级菜单元素位于一级菜单的'_child'元素中
     */
    final public function getMenus($controller=CONTROLLER_NAME){
    	//获取用户拥有的权限
    	$admin_id=C('USER_ADMINISTRATOR');
    	//非超级管理员情况下需要根据关联的用户组的权限展示菜单
		if (UID!=$admin_id) {
			//下面代码暂时注释掉,当需要开放权限控制时释放即可
			$_lst = D('Member')->where('id='.UID)->getfield('menu_ids');
			$where['id'] = array('in',$_lst);
		}
        $where['display'] = 1;
        $menus =   M('Menu')->where($where)->order('sort asc')->select();
        return $menus;
    }

    /**
     * 返回后台节点数据
     * @param boolean $tree    是否返回多维数组结构(生成菜单时用到),为false返回一维数组(生成权限节点时用到)
     * @retrun array
     *
     * 注意,返回的主菜单节点数组中有'controller'元素,以供区分子节点和主节点
     *
     */
    final protected function returnNodes($tree = true){
        static $tree_nodes = array();
        if ( $tree && !empty($tree_nodes[(int)$tree]) ) {
            return $tree_nodes[$tree];
        }
        if((int)$tree){
            $list = M('Menu')->field('id,pid,title,url,tip,hide')->order('sort asc')->select();
            foreach ($list as $key => $value) {
                if( stripos($value['url'],MODULE_NAME)!==0 ){
                    $list[$key]['url'] = MODULE_NAME.'/'.$value['url'];
                }
            }
            $nodes = list_to_tree($list,$pk='id',$pid='pid',$child='operator',$root=0);
            foreach ($nodes as $key => $value) {
                if(!empty($value['operator'])){
                    $nodes[$key]['child'] = $value['operator'];
                    unset($nodes[$key]['operator']);
                }
            }
        }else{
            $nodes = M('Menu')->field('title,url,tip,pid')->order('sort asc')->select();
            foreach ($nodes as $key => $value) {
                if( stripos($value['url'],MODULE_NAME)!==0 ){
                    $nodes[$key]['url'] = MODULE_NAME.'/'.$value['url'];
                }
            }
        }
        $tree_nodes[(int)$tree]   = $nodes;
        return $nodes;
    }
}
