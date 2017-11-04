<?php
namespace Admin\Model;
use Think\Model;

/**
 * Created by liuniukeji.com
 * 商品模型户型属性
 * @author goryua <1661745274@qq.com>
*/

class ShopGoodsModelResourceModel extends Model {
    
    protected $insertFields = array('model_id','photo_resource_path','group_no','map_path','normal_map_path','material_ball','material_ball_name','is_default','version');
    protected $selectFields = array('model_id','photo_resource_path','group_no','map_path','normal_map_path','material_ball','material_ball_name','is_default','id','version'); 

    protected $_validate = array(
        // array('photo_resource_path', 'require', '图标资源不能为空', self::MUST_VALIDATE, 'regex', 4),
        // array('group_no', 'require', '组号不能为空', self::MUST_VALIDATE, 'regex', 5),
        // array('map_path', 'require', '贴图资源不能为空', self::MUST_VALIDATE, 'regex', 6),
        // array('normal_map_path', 'require', '法线贴图资源不能为空', self::MUST_VALIDATE, 'regex', 7),
        // array('material_ball', 'require', '材质球不能为空', self::MUST_VALIDATE, 'regex', 8),
        // array('material_ball_name', 'require', '材质球名称不能为空', self::MUST_VALIDATE, 'regex', 9),
    );

     public function getResourceList($where, $field = null, $order = 'id asc') {
        if ($field == null) {
            $field = $this->selectFields;
        }

        $list = $this->field($field)->where($where)->order($order)->select();
        return $list;
    }
    
    /**
     * 保存模型属性值
     * @param array $vr_data 模型数据
     * @param integer $model_id 模型id
     * @return bool 成功返回true，否则返回错误提示
    */
    public function saveResource($vr_data, $model_id) {
        // if (empty($vr_data['photo_resource_path'])) {
        //  return '商品模型类型不能为空';
        //  exit;
        // }
        
        $list = $this->getResourceList(array('model_id' => $model_id));
        if (!empty($list) && is_array($list)) {
            foreach ($list as $val) { //清空文件图片
                if (file_exists($val['map_path']) == true) {
                    @unlink($val['map_path']);
                }
                if (file_exists($val['normal_map_path']) == true) {
                    @unlink($val['normal_map_path']);
                }
            }
            $this->where('model_id ='.$model_id)->delete();
        }

        /*杨yjie 添加*/
        //单独拿出查询到的id和版本号,以便于重新组装$data 
        foreach($list as $k =>$v){
            //unset($v['id']);
            $id[]=$v['id'];
            //var_dump($id);
            $version[]=$v['version'];
            //var_dump($version);
            $list[$k]=$v;
         }
        foreach($id as $k =>$v){
           $vr_data['id'][$k+1]=$v;
        }
        foreach($version as $k =>$v){
           $vr_data['version'][$k+1]=$v;
        }
        /*杨yjie 添加*/

        //var_dump($vr_data);die;
        foreach ($vr_data['photo_resource_path'] as $key => $value) {
            // if (!$value) {
            //     $_validate = 4; //图标资源不能为空
            // }
            // if (!$vr_data['group_no'][$key]) {
            //     $_validate = 5; //组号不能为空
            // }
            // if (!$vr_data['map_path'][$key]) {
            //     $_validate = 6; //贴图资源不能为空
            // }
            // if (!$vr_data['normal_map_path'][$key]) {
            //     $_validate = 7; //法线贴图资源不能为空
            // }
            // if (!$vr_data['material_ball'][$key]) {
            //     $_validate = 8; //材质球不能为空
            // }
            // if (!$vr_data['material_ball_name'][$key]) {
            //     $_validate = 9; //材质球名称不能为空
            // }
            $data['model_id'] = $model_id;
            $data['photo_resource_path'] = $value;
            $data['group_no'] = $vr_data['group_no'][$key];
            $data['map_path'] = $vr_data['map_path'][$key];
            $data['normal_map_path'] = $vr_data['normal_map_path'][$key];
            $data['material_ball'] = $vr_data['material_ball'][$key];
            $data['material_ball_name'] = $vr_data['material_ball_name'][$key];
            $data['is_default'] = $vr_data['is_default_mx'][$key];
            
            /*杨yjie 添加*/
            $data['id']=$vr_data['id'][$key];
            $data['version']=is_null($vr_data['version'][$key]) ? 1.0 : $vr_data['version'][$key];
            static $datas=array();
            $datas[]=$data;
            /*杨yjie 添加*/

            if ($this->create($data, $_validate) !== false) {
                unset($_validate);
                $this->add();
            } else {
                unset($_validate);
                return($this->getError());
            }
            unset($data);
        }

         /*杨yjie 添加*/
        // var_dump($list);die;
        // var_dump($datas);die;
        //设置一个开关
        $_POST['resource']['flag']=false;
        //循环对比每组插入的新数据与原数据是否相同
        foreach ($datas as $k => $v) {
            if($datas[$k] != $list[$k]){
                // echo 'OK';
                $_POST['resource']['id'][]=$v['id'];
                $_POST['resource']['flag']=true;
            }
        }
        /*杨yjie 添加*/

        return true;
    }
}
?>