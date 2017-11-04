<?php
namespace Admin\Model;
use Think\Model;

/**
 *  模版列表模型
 *  @author yuanyulin <QQ: 755687023>
 */
class ArticleModel extends Model{
    protected $insertFields = array('name', 'member_id', 'type', 'add_time', 'sort', 'remark', 'member.user_name', 'goods_id');
    protected $selectFields = array('article.id', 'name', 'member_id', 'article.type', 'article.add_time', 'article.sort', 'remark', 'member.user_name', 'goods_id');
    protected $_validate = array(
        array('name', 'require', '标题名称不能为空', 1, 'regex', 3),
        array('name', 'checkTitle',   '标题名称不能重复', self::VALUE_VALIDATE, 'callback', 3),
        array('name', '1,20',   '标题名称不能超过20个字符', self::VALUE_VALIDATE, 'length', 3),

        array('sort', '0,1000', '排序范围0~1000！', self::VALUE_VALIDATE, 'between', 3),

        array('type', '0,5', '类型范围不正确', self::MUST_VALIDATE, 'between',3),
    );

    protected function _before_insert(&$data,$option) {
        $data['add_time'] = time();
        $data['member_id'] = UID;
    }

    /**
     * 获取模版信息方法
     * @param int    $type  获取模版的分类参数（文章分类 0 背景介绍 1 二维码模板 2 实例分享模板 3 收藏夹模板 4 首页模板 5 解决方案模板）
     * @param array  $field 获取需要返回的字段
     * @param string $order 排序方式
     * @return array  返回数据和分页数据
     */
    public function getArticleByPage($type, $where, $field=null, $order='article.sort, article.id desc'){


        $where['article.status'] = array('EQ', 0);
        $where['article.type']   = array('EQ', $type);
        //if (UID != 1) {
        $where['member_id'] = UID;
        //}


        if ($field == null) $field = $this->selectFields;

        $count = $this->alias('article')->where($where)->count();

        $page = get_page($count);
        $data = $this->alias('article')
            ->join('__MEMBER__ as member on article.member_id = member.id', 'LEFT')
            ->field($field)
            ->where($where)
            ->limit($page['limit'])
            ->order($order)
            ->select();

        $shopGoodsAttributeValueModel = D('ShopGoodsAttributeValue'); // 获取商品名称
        foreach ($data as $key => $value) {
            $data[$key]['goods_name'] = $shopGoodsAttributeValueModel->getBasicAttrValue($value['goods_id'], 1);
        }
        /*if (UID == 1) { //超级管理员的查看数量
            $where['member_id'] = UID;
            $count = $this->alias('article')->where($where)->count();
        }*/
        return array('list' => $data, 'page' => $page, 'count' => $count);
    }
    protected function checkTitle($data){
        $where['name'] = array('eq', $data);
        $where['status'] = array('eq', 0);
        $where['member_id'] = array('eq',UID);
        $where['id'] = array('neq', I('id'));
        $res = M('Article')->where($where)->count();
        if ($res > 0) {
            return false;
        }else {
            return true;
        }
    }
}
