<?php
namespace Admin\Model;
use Think\Model;
/**
 *  前台日志模块列表模型
 *  @author liuyang QQ:594353482
 *
 */
class HomeLogModularModel extends Model{

    protected $insertFields = array('name', 'parent_id', 'sort');
    protected $updateFields = array('id', 'name', 'parent_id','sort');
    protected $selectFields = array('id', 'name', 'parent_id', 'sort');

    protected $_validate = array(
        array('name','require','前台日志模块名称不能为空', self::EXISTS_VALIDATE),
        array('name', '1,25', '前台日志模块名称不能超过25个字符！', self::EXISTS_VALIDATE, 'length', 3),
        array('name', 'checkName', '前台日志模块名称已经存在, 不能重复添加', self::EXISTS_VALIDATE, 'callback', 3),
        array('parent_id','number','上级分类必须选择', self::EXISTS_VALIDATE,'',3),
        array('sort','0,1000','排序必须填写，填写范围0-1000', self::EXISTS_VALIDATE,'between',3),
    );

    protected function _before_update(&$data, $option) {
        $id = I('id', 0, 'intval');
        $parent_id = I('parent_id', 0, 'intval');
        $ids = getChildIds('HomeLogModular', $id);
        if (in_array($parent_id,$ids)) {
                $this->error='上级分类不能选本身和子类！';
                return false;
        }
    }
    
    protected function checkName($data){
        $id = I('id', 0, 'intval');
        $where['name'] = $data;
        $where['status']= array('eq',0);
        if ($id > 0) {
            $where['id'] = array('neq', $id );
        }
        $count = $this->where($where)->count();
        if ($count > 0) {
            return false;
        }
        return true;
    }

    //获取树形列表
    public function getHomeLogModularTree($id){
        $homeLogModularData = $this->where(array('status'=>0))->order('sort')->field('id, name, parent_id')->select();
        $homeLogModularData = D('Common/tree')->toFormatTree($homeLogModularData);
        return $homeLogModularData;
    }

    public function getHomeLogModularName($id){
        $homeLogModularName = $this->where(array('id'=>$id))->getField('name');
        return $homeLogModularName;
    }
    
    /**
     * 获取操作的数据库表名称 createby yuanyulin
     * @param  type     $id                        传入日志类型
     * @return varchar  $homeLogModularDataTable   返回操作的数据库表名称
     */
    public function getHomeLogModularDataTable($id) {
        $homeLogModularDataTable = $this->where(array('id'=>$id))->getField('data_table');
        return $homeLogModularDataTable;     
    } 
    
    /**
     * 获取操作的数据库表名称对应的name值 createby yuanyulin
     * @param  type     $id                            传入日志类型
     * @param  type     $dataTableId                   传入对应的需要获取该数据库表的id
     * @return varchar  $homeLogModularDataTableName   返回操作的数据库表名称对应的name值
     */
    public function getHomeLogModularDataTableName($id, $dataTableId) {
        $homeLogModularDataTable = $this->where(array('id'=>$id))->getField('data_table');
        
        switch ($homeLogModularDataTable) {
            case 'Member':
            $homeLogModularDataTableName = M('Member')->where('id='. $dataTableId)->getField('user_name');
            break;
            case 'ShopGoods':
            $homeLogModularDataTableName = D('ShopGoodsAttributeValue')->getBasicAttrValue($dataTableId, 1);
            break;
            case 'Favorite':
            $homeLogModularDataTableName = M('Favorite')->where('id='. $dataTableId)->getField('name');
            break;
            default:
            break;
        }
        
        return $homeLogModularDataTableName;     
    } 

}
