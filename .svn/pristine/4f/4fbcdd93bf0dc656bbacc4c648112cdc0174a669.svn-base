<?php
namespace Admin\Model;
use Think\Model;

/**
 * Created by liuniukeji.com
 * 商品确认详情表模型
 * @author goryua <1661745274@qq.com>
*/

class ShoppingCartDetailModel extends Model {
     
    protected $insertFields = array('cart_id','goods_id','style','size','material','color','like_level','add_time','status');
	protected $updateFields = array('id','style','size','material','color','like_level','status');
	protected $selectFields = array('id','cart_id','goods_id','style','size','material','color','like_level','add_time','status'); 


    /**
     * 获取商品确认列表分页
     * @param array $where 传入where条件
     * @param string $order 排序方式
     * @return array 搜索数据和分页数据
    */
    public function getGoodsCartDetailList($where, $field = null, $order = 'id desc') {
        if ($field == null) {
            $field = $this->selectFields;
        }

        $count = $this->alias('detail')
            ->join('__SHOP_GOODS_ATTRIBUTE_VALUE__ attr ON detail.goods_id = attr.goods_id', 'left')
            ->where($where)
            ->count('detail.id');
        $page = get_page($count);
        
        $data = $this->alias('detail')
            ->join('__SHOP_GOODS_ATTRIBUTE_VALUE__ attr ON detail.goods_id = attr.goods_id', 'left')
            ->field($field)
            ->where($where)
            ->limit($page['limit'])
            ->order($order)
            ->select();
        /*杨yongjie  添加   颜色*/
        $ShopGoodsColor=D('ShopGoodsColor');
        foreach($data as $k => $v){
            $data[$k]['color']=$ShopGoodsColor->getCartColor($v['color']);
        }
        /*杨yongjie  添加*/
        return array(
            'list' => $data,
            'page' => $page['page']
        );   
    }
    
    /**
     * 获取商品确认详情
    */
    public function getGoodsCartInfo($where, $field = null) {
        if ($field == null) {
            $field = $this->selectFields;
        }

        return $this->field($field)->where($where)->find();
    }
    
    
    

}
?>