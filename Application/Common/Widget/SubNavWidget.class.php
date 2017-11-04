<?php
namespace Common\Widget;
use Think\Controller;

/**
 * Menu
 */
class SubNavWidget extends Controller {

	public function getList(){
		$parent_id = I('main_nav_id', 0, 'intval'); // 父级页面ID
		$current_id = I('current_id', 0, 'intval'); // 当前页面ID

        $this->subNav = D('Basic/Nav')->getWebNavList($parent_id);
        $this->parent_id = $parent_id;
        $this->current_id = $current_id;
        $this->display(T('Common@Widget/SubNav/getList'));
    }

}