<?php
namespace Admin\Model;
use Think\Model;

/**
 * 后台模块提示语模型
 * @author yuanyulin <QQ: 755687023>
 */
class PromptLanguageModel extends Model{
        protected $insertFields = array('menu_id', 'content','remark');
        protected $updateFields = array('id', 'menu_id', 'content','remark');

	protected $_validate = array(
            array('menu_id', 'number', '必须是数字', self::MUST_VALIDATE, 'regex', 3),
            
            array('content', 'require', '后台模块提示语内容必须填写',        self::MUST_VALIDATE, 'regex', 3),
            array('content', '1,50',    '后台模块提示语内容不能超过50个字符', self::MUST_VALIDATE, 'length', 3),
            
            array('remark', '0,200',   '后台模块提示语内容不能超过200个字符', self::MUST_VALIDATE, 'length', 3),
	);
    
    /**
     * 对后台模块提示语列表进行分页显示
     * @param  type $order  要排序的字段
     * @return array $list  分页完成的数据
     */
    public function getPromptLanguageDataByPage( $order = 'id desc' ){
        $keywords = I('keywords', '', trim);
        if ($keywords) 
            $where['menu.title'] = array('LIKE', "%$keywords%");
        
        $count = $this->where($where)->count();
        $page = get_page($count);

        $list = $this->alias('promptlanguage')->join('__MENU__ as menu ON promptlanguage.menu_id = menu.id')
                ->where($where)->field('menu.title, promptlanguage.id, promptlanguage.content, promptlanguage.remark')
                ->limit($page['limit'])->order($order)->select();
        return $list = array('page'=>$page, 'list'=>$list);
        
    }
	
}