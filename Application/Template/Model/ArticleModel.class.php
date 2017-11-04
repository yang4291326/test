<?php
namespace Template\Model;
use Think\Model;

/**
 * 模板分类模型
 * create by yuanyulin <QQ: 755687023>
 */
class ArticleModel extends Model{
	
    protected $selectFields = array('id','name','remark');

    /**
     * 根据传入的type值获取模板列表
     * @param type $type  传入的type值 （type 模版页面分类 0背景介绍 1二维码 2实例分享 3收藏夹 4首页 5解决方案）
     * @param type $field 需要查询出来的字段
     * @param type $order 排序的字段
     * @return 
     */
    public function getArticleList($type, $field = null, $order = 'sort asc,id') {
        if ($field == null) $field = $this->selectFields;
        switch ($type) {
            case '0': // 背景介绍 
                $titleAccess = 'interface_template_num';// 背景介绍模板-标题数量
                break;
            case '1': // 二维码模板
                break;
            case '2': // 实例分享模板
                $titleAccess = 'interface_switch_num';// 实例分享模板-分类数量
                break;
            case '3': // 收藏夹模板
                break;
            case '4':// 首页模板
                $titleAccess = 'custom_template_num'; // 自定义模板数量
                break;
            case '5':// 解决方案模板
                $titleAccess = 'olution_num';// 解决方案-标题数量
                break;
        }
        if ($type == 1) {
            $titleAccessInfo = 1;
        } elseif ($type == 3) {
           $titleAccessInfo = M('ShopGoods')->where('member_id='. UID)->count();
        } elseif ($type == 4) {
            $titleAccessInfo = 3;
        } else {
            $titleAccessInfo = _getDataAccess($titleAccess); // 标题数量
        }
        $where['type']      = array ('EQ', $type); 
        $where['member_id'] = array ('EQ', UID);
        $where['status']    = array ('EQ', 0);		
        $data = $this->field($field)->where($where)->order($order)->limit($titleAccessInfo)->select();

        return $data;
    }

    public function getArt($where, $field = null, $order = 'article.sort asc,article.id desc') {
        if ($field == null) $field = $this->selectFields;

        $article_list = $this->alias('article')
        ->join('__ARTICLE_DETAIL__ detail ON article.id = detail.article_id', 'left')
        ->order($order)
        ->field($field)
        ->where($where)
        ->limit()
        ->select();
        return $article_list;
    }	
}