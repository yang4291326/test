<?php
namespace Common\Model;

/**
 * 生成多层树状下拉选框的工具模型
 */
class TreeModel {
	/**
	 * 将格式数组转换为树
	 *
	 * @param array $list
	 * @param integer $level 进行递归时传递用的参数
	 */
	private $formatTree; //用于树型数组完成递归格式的全局变量
	private function _toFormatTree($list,$level=0,$title = 'name') {
		foreach($list as $key=>$val){
			$tmp_str = str_repeat("&nbsp;&nbsp;",$level*2);
			$tmp_str .= "├";

			$val['level'] = $level;
			$val['title_show'] = $level==0?$val[$title]."&nbsp;&nbsp;":$tmp_str.$val[$title]."&nbsp;&nbsp;";
				// $val['title_show'] = $val['id'].'|'.$level.'级|'.$val['title_show'];
			if(!array_key_exists('_child',$val)){
				array_push($this->formatTree,$val);
			}else{
				$tmp_ary = $val['_child'];
				unset($val['_child']);
				array_push($this->formatTree,$val);
				$this->_toFormatTree($tmp_ary,$level+1,$title); //进行下一层递归
			}
		}
		return;
	}

	public function toFormatTree($list, $title = 'name', $pk = 'id', $pid = 'parent_id', $root = 0){
		$list = list_to_tree($list,$pk,$pid,'_child',$root);
		$this->formatTree = array();
		$this->_toFormatTree($list,0,$title);
		return $this->formatTree;
	}
}

