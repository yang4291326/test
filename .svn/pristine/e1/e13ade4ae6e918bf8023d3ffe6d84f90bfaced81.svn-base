<?php
namespace Admin\Model;
use Think\Model;

/**
 * Created by liuniukeji.com
 * 商品确认表模型
 * @author goryua <1661745274@qq.com>
*/

class ShoppingCartModel extends Model {
     
	protected $updateFields = array('id','collection_sn','remark','collection_id','status');
	protected $selectFields = array('id','collection_sn','remark','add_time','collection_id','cart_photo','member_id','status'); 


    /**
     * 获取商品确认列表分页
     * @param array $where 传入where条件
     * @param string $order 排序方式
     * @return array 搜索数据和分页数据
    */
    public function getGoodsCartList($where, $field = null, $order = 'id desc') {
        if ($field == null) {
            $field = $this->selectFields;
        }

        $count = $this->alias('cart')
            ->join('__MEMBER__ member ON cart.member_id = member.id', 'left')
            ->where($where)
            ->count('cart.id');
        $page = get_page($count);
        
        $data = $this->alias('cart')
            ->join('__MEMBER__ member ON cart.member_id = member.id', 'left')
            ->field($field)
            ->where($where)
            ->limit($page['limit'])
            ->order($order)
            ->select();
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