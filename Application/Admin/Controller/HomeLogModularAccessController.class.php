<?php
namespace Admin\Controller;

/**
 * 前台日志模块授权管理控制器
 * @author liuyang <594353482@qq.com>
 */
class HomeLogModularAccessController extends AdminCommonController {
    
    // 管理员配置日志模块
    public function adminConfig(){
        $this->logAuth();
    }
    
    // 用户自己配置日志模块
    public function memberConfig(){
        $this->logAuth();        
    }

    // 访问用户日志授权页面
    public function logAuth(){
        $member_id = I('member_id', 0 , 'intval');
        $dataNum = $this->_getDataAccess('data_num',$member_id); // 用户限制的日志权限的数据个数
        if (IS_POST) {
            $rules = I('post.rules', '');
            if ( empty($rules) ) $this->ajaxReturn(V(0, '必须选择授权日志！'));  
            
            foreach ($rules as $key => $value) { // 处理顶级的不算
                $parentId = M('HomeLogModular')->where('id='. $value)->getfield('parent_id');
                if ( $parentId  == 0 ) unset($rules[$key]);
                unset($parentId);
            }        
            $rulesCount = count($rules);
            if ( $rulesCount == 0 ) $this->ajaxReturn(V(0, '必须选择下级！'));  
            if ( $rulesCount > $dataNum ) $this->ajaxReturn(V(0, '可以配置的日志权限个数超过了限制！'));                
            //开始事务
            M()->startTrans();
            //删除之前的数据
            M('HomeLogModularAccess')->where('member_id='.$member_id)->delete();
            $singleData['member_id'] = $member_id;
            foreach ($rules as $key => $value) {
                $singleData['modular_id'] = $value;
                $result = M('HomeLogModularAccess')->add($singleData);
                if ($result === false) {
                    M()->rollback();
                    $this->ajaxReturn(V(0, '保存失败'));
                }
            }
            M()->commit();
            if ($result) {
                $this->ajaxReturn(V(1, '保存成功'));
            }
        } else {
            $memberAuths = M('HomeLogModularAccess')->where('member_id='. $member_id)->field()->select(); // 获取到的用户日志的权限
            $memberAuths = i_array_column($memberAuths, 'modular_id');
            $memberAuths = implode(',', $memberAuths);

            $nodeTreeList = $this->returnTreeNodes(); // 获取树状权限列表

//            $this->assign('data_num', $dataNum);
            $this->assign('member_id', $member_id);           // 将id传递到页面中
            $this->assign('nodeTreeList', $nodeTreeList);
            $this->assign('this_group', $memberAuths); 
            $this->display('logAuth');
        }
    }

    /**
     * 返回后台节点数据
     * @param boolean $tree    是否返回多维数组结构(生成菜单时用到),为false返回一维数组(生成权限节点时用到)
     * @retrun array
     * 注意,返回的主菜单节点数组中有'controller'元素,以供区分子节点和主节点
     */
    protected function returnTreeNodes($tree = true){
        static $tree_nodes = array();
        if ( $tree && !empty($tree_nodes[(int)$tree]) ) {
            return $tree_nodes[$tree];
        }
        if((int)$tree){
            $list = M('HomeLogModular')->field('id,parent_id,name')->order('sort asc')->where('status=0')->select();
            $nodes = list_to_tree($list,$pk='id',$pid='parent_id',$child='operator',$root=0);
            foreach ($nodes as $key => $value) {
                if(!empty($value['operator'])){
                    $nodes[$key]['child'] = $value['operator'];
                    unset($nodes[$key]['operator']);
                }
            }
        }else{
            $nodes = M('HomeLogModular')->field('id,parent_id,name')->order('sort asc')->where('status=0')->select();
        }
        $tree_nodes[(int)$tree]   = $nodes;
        return $nodes;
    } 
    
}