<?php
namespace Common\Model;
use Think\Model;
/**
 *  ajax获取人员列表模型
 *  @author yuanyulin QQ:755687023
 *
 */
class AjaxMemberSelectModel extends Model{
    
    /**
     * ajax 获取分页信息
     * $ids 已添加用户id信息
     * $where 查询的条件
     * $page 页数
     */
    public function ajaxMemberPage($where, $page){
        $page_size = C('PAGE_SIZE');
        $count = M('Member')->where($where)->count();

        $list = M('Member')->where($where)->limit(($page-1)*$page_size, $page_size)->select();
        foreach ($list as $key => $value) {
            $list[$key]['shop_name'] = D('MemberAttributeValue')->getMemberAttributeValueByMemberIdAndMemeberProperty($value['id'], 15);
            $list[$key]['telphone'] = D('MemberAttributeValue')->getMemberAttributeValueByMemberIdAndMemeberProperty($value['id'], 14);
        }
        $pages = getPageData($page, $count);
        return array('list' => $list, 'page' => $pages);
    }

}
