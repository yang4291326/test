<?php

namespace Admin\Model;
use Think\Model;

/**
 * 菜单模型
 * @author liuyang <594353482@qq.com>
 */

class MenuModel extends Model {

	protected $_validate = array(
		array('url','require','url必须填写'), //默认情况下用正则进行验证
	);



	//获取人员所拥有的所有权限
	public function getMenus($uid){
		$rules = M('auth_group_access')->alias('ac')->field('ag.rules')->join(' ln_auth_group ag on ag.id=ac.group_id')->where('ac.uid='.$uid)->find();
		$_lst = explode(',',$rules['rules']);
		return $_lst;
	}


	//获取树的根到子节点的路径
	public function getPath($id){
		$path = array();
		$nav = $this->where("id={$id}")->field('id,pid,title')->find();
		$path[] = $nav;
		if($nav['pid'] >1){
			$path = array_merge($this->getPath($nav['pid']),$path);
		}
		return $path;
	}
}