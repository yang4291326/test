<?php
namespace Goods\Controller;

/**
 * Created by liuniukeji.com
 * 分类列表接口
 * @author goryua <1661745274@qq.com>
*/
class GoodsCategoryApiController extends \Common\Controller\CommonApiController {
    
    /**
     * 根据二级父类id获取三四级分类列表
     */
    public function getCateListByParent(){
        $parent_id = I('parent_id', 0, 'intval');

        $field = 'id,name,sort,parent_id,level';
        $where['status'] = array('eq', 0);
        $where['parent_id'] = array('eq', $parent_id);
        $three_access_limit = _getDataAccess('goods_type_num_3');
        $data = D('Goods/ShopGoodsType')->getCategoryList($where, $field, '', $three_access_limit);
        if (empty($data)) {
            $this->apiReturn(0, '商品分类不存在');
        }
        foreach ($data as $k) {
            $parent_data[$k['id']] = $k;
        }
        unset($where);
        $where['parent_id'] = array('in', implode(',', array_keys($parent_data)));
        $where['status'] = array('eq', 0);
        $four_access_limit = _getDataAccess('goods_type_num_4');
        $son_data = D('Goods/ShopGoodsType')->getCategoryList($where, $field, '', $four_access_limit);
        foreach ($son_data as $v) {
            $son_array[$v['parent_id']][] = $v;
        }
        foreach ($data as $key => $value) {
            $array[$key] = $value;
            if (empty($son_array[$value['id']])) {
                $array[$key]['son_data'] = array();
            } else {
                $array[$key]['son_data'] = $son_array[$value['id']];
            }
        }

        $this->apiReturn(1, '商品分类列表', $array);
    }

    /**
     * 根据层级获取商品二级分类列表
     */
    public function getCateListByLevel(){
        $level = I('level', '');
        $where['member_id'] = array('eq', UID);
        $where['status'] = array('eq', 0);
        $where['level'] = array('in', $level);
        $access_limit = _getDataAccess('goods_type_num_2');

        $data = D('Goods/ShopGoodsType')->getCategoryList($where, '', 'sort asc, id asc', $access_limit);
   
        $this->apiReturn(1, '商品分类列表', $data);

    }

}
