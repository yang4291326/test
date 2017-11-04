<?php
namespace Admin\Controller;

/**
 * Created by liuniukeji.com
 * 商品确认控制器
 * @author goryua <1661745274@qq.com>
*/

class GoodsConfirmController extends AdminCommonController {

    /**
     * 商品确认信息列表
     */
    public function index() {        
        $collectionSn = I('post.collection_sn', '', 'trim');
        if ($collectionSn) $where['cart.collection_sn'] = array('like', "%$collectionSn%");
        
        $where['cart.member_id'] = array('eq', UID);
        $where['cart.status'] = array('eq' ,0);
        //$cart_list = D('ShoppingCart')->getGoodsCartList($where, 'cart.id,collection_sn,cart.cart_photo,cart.remark,cart.add_time,member.user_name');

        /*杨yongjie  添加*/
        $cart_list = D('ShoppingCart')->getGoodsCartList($where, 'cart.id,collection_sn,cart.cart_photo,cart.remark,cart.price_total,cart.add_time,member.user_name');
        /*杨yongjie  添加*/

        //设置分页变量
        $this->assign('list', $cart_list['list']);
        $this->assign('page', $cart_list['page']);

        //自定义提示语
        $prompt_tips = $this->_getPromptLanguage();
        $this->assign('prompt_tips', $prompt_tips);

        $this->display();
    }
    
    /**
     * 商品确认详情列表
     */
    public function cartDetail() {

        $cart_id = I('get.id', 0, 'intval');
        if (!$cart_id)
            $this->ajaxReturn(V(0, '参数错误'));

        $cart_info = D('ShoppingCart')->getGoodsCartInfo(array('id' => $cart_id));
        $this->assign('cart_info', $cart_info);

        $goods_name = I('get.goods_name', '', 'trim');
        if ($goods_name) {
            $where['attr.attr_value'] = array('like', '%'.$goods_name.'%');
        }
        $where['detail.cart_id'] = array('eq' ,$cart_id);
        $where['detail.status'] = array('eq' ,0);
        $where['attr.attribute_id'] = array('eq' ,1);
        //$field = 'detail.id,style,size,material,color,like_level,add_time,attr.attr_value as goods_name';
        /*杨yongjie  添加*/
        $field = 'detail.id,style,size,material,color,like_level,goods_count,price,add_time,attr.attr_value as goods_name';
        /*杨yongjie  添加*/
        $detail_list = D('ShoppingCartDetail')->getGoodsCartDetailList($where, $field);
        //设置分页变量
        $this->assign('list', $detail_list['list']);
        $this->assign('page', $detail_list['page']);

        $this->display('cart_detail');
    }


    /**
     * 商品确认列表删除
     */
    public function recycle() {
        $this->_recycle('ShoppingCart');  
    }

    /**
     * 商品确认详情删除
     */
    public function detailRecycle() {
        $this->_recycle('ShoppingCartDetail');  
    }


    
}
?>