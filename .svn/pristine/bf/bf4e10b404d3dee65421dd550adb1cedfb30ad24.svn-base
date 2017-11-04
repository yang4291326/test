<?php
namespace Goods\Controller;

/**
 * Created by liuniukeji.com
 * VR模型接口
 * @author goryua <1661745274@qq.com>
*/
class VrApiController extends \Think\Controller {
    
    //获取商品户型
    public function scenceModel() {
        $this->_decode();
        $userCode = I('userCode','','trim');
        // $list = M('shop_goods_model_layout')->query("SELECT id,NAME,layout_scene AS Scence,layout_photo_path AS Icon,
        //             layout_path AS Model,
        //             initial_position AS 'Position',
        //             initial_direction AS Rotation,
        //             is_default AS 'Default'
        //             FROM ln_shop_goods_model_layout WHERE model_id IN (
        //             SELECT id FROM ln_shop_goods_model WHERE member_id = (
        //             SELECT member_id FROM ln_member_machine_code WHERE machine_code ='$userCode'))");
        $list = M('shop_goods_model_layout')->query("SELECT id,NAME,layout_scene AS Scence,
                    layout_photo_path AS Icon,
                    layout_path AS Model,
                    initial_position AS 'Position',
                    initial_direction AS Rotation,
                    is_default AS 'Default'
                    FROM ln_shop_goods_model_layout WHERE member_id = (
                    SELECT member_id FROM ln_member_machine_code WHERE machine_code ='$userCode')");
        $data = array();
        foreach ($list as $k => $v) {
            $data[$k]['ID'] = $v['id'];
            $data[$k]['Name'] = $v['NAME'];
            $data[$k]['Scence'] = $v['Scence'];
            $data[$k]['Icon'] = $v['Icon'];
            $data[$k]['Model'] = $v['Model'];
            $data[$k]['Position'] = $v['Position'];
            $data[$k]['Rotation'] = $v['Rotation'];
            $data[$k]['Default'] = $v['Default'];
        }
        $this->apiReturn(1, '商品户型数据', $data);
    }

    //获取商品模型列表
    public function commodityList() {
        $this->_decode();
        $userCode = I('userCode','', 'trim');
        $list = M('shop_goods_model')->query("SELECT goods_id AS CommodityID,
					ico AS Icon,
					model_path AS Model,
					description AS 'Describe',
					material_tiling AS Tiling,
					name AS Fname
					FROM ln_shop_goods_model 
					WHERE goods_id IN (SELECT id FROM ln_shop_goods WHERE STATUS = 0 AND member_id = (
					SELECT member_id FROM ln_member_machine_code WHERE machine_code = '$userCode'))");
        $data = array();
        foreach ($list as $k => $v) {
            $data[$k]['CommodityID'] = $v['CommodityID'];
            $data[$k]['Icon'] = $v['Icon'];
            $data[$k]['Describe'] = $v['Describe'];
            $data[$k]['Model'] = $v['Model'];
            $data[$k]['Tiling'] = $v['Tiling'];
            $data[$k]['Fname'] = $v['Fname'];
        }

        $this->apiReturn(1, '商品模型数据', $data);
    }

    //获取商品图片
    public function commodityPicture() {
        $this->_decode();
        $userCode = I('userCode','', 'trim');
        $list = M('shop_goods_model_resource')->query("SELECT sgm.goods_id AS CommodityID,
			photo_resource_path AS Icon,
			group_no AS TextureID,
			map_path AS Texture,
			normal_map_path AS NormalTexture,
			material_ball AS Material,
			material_ball_name AS MaterialName,
			is_default AS 'Default'
			FROM ln_shop_goods_model_resource gmr, ln_shop_goods_model sgm
			WHERE gmr.model_id = sgm.id AND
			sgm.goods_id IN (SELECT id FROM ln_shop_goods WHERE STATUS = 0 AND member_id = (
			SELECT member_id FROM ln_member_machine_code WHERE machine_code = '$userCode'))");

        $data = array();
        foreach ($list as $k => $v) {
            $data[$k]['CommodityID'] = $v['CommodityID'];
            $data[$k]['Icon'] = $v['Icon'];
            $data[$k]['TextureID'] = $v['TextureID'];
            $data[$k]['Texture'] = $v['Texture'];
            $data[$k]['NormalTexture'] = $v['NormalTexture'];
            $data[$k]['Material'] = $v['Material'];
            $data[$k]['MaterialName'] = $v['MaterialName'];
            $data[$k]['Default'] = $v['Default'];
        }
        $this->apiReturn(1, '商品图片数据', $data);
    }

    /*
     *获取模型数据(yyjie 添加)
     */
    public function getVRdata(){
        $this->_decode();
        $Usercode = I('Usercode','','trim');
        //获取用户属性版本号
        $list=M('member_attribute_value')->query("SELECT attr_value AS 'version' 
                FROM ln_member_attribute_value 
                WHERE attribute_id = 36 AND member_id = (
                SELECT member_id FROM ln_member_machine_code WHERE machine_code = '$Usercode')");
        //获取模型数据
        $result=M('shop_goods_model')->query("SELECT goods_id AS CommodityID,
                        VERSION AS 'version',
                        ico AS Icon,
                        model_path AS Model
                        FROM ln_shop_goods_model WHERE goods_id IN (
                        SELECT id FROM ln_shop_goods WHERE STATUS=0 AND goods_category_id IN (
                        SELECT id FROM ln_shop_goods_type WHERE STATUS=0 
                        AND member_id =(
                        SELECT member_id FROM ln_member_machine_code WHERE LEVEL=4 AND machine_code = '$Usercode')))");
        //模型资源数据
        $resource=M('shop_goods_model_resource')->QUERY("SELECT sgm.goods_id, sgmr.VERSION AS 'version',
						sgmr.photo_resource_path AS Icon,
						sgmr.map_path AS Texture,
						sgmr.normal_map_path AS NormalTexture,
						sgmr.material_ball AS Material
						FROM ln_shop_goods_model_resource sgmr, ln_shop_goods_model sgm
						WHERE sgmr.model_id = sgm.id AND sgm.member_id IN (SELECT member_id FROM ln_member_machine_code WHERE machine_code = '$Usercode')");

         // $lists=M('shop_goods_model_layout')->query("SELECT id,
         //                    VERSION AS 'version',
         //                    layout_photo_path AS Icon,
         //                    layout_path AS Model
         //                    FROM ln_shop_goods_model_layout WHERE model_id IN (
         //                    SELECT id FROM ln_shop_goods_model WHERE member_id = (
         //                    SELECT member_id FROM ln_member_machine_code WHERE machine_code = '$Usercode'))");
        $lists=M('shop_goods_model_layout')->query("SELECT id,
                            VERSION AS 'version',
                            layout_photo_path AS Icon,
                            layout_path AS Model
                            FROM ln_shop_goods_model_layout WHERE member_id = (
                            SELECT member_id FROM ln_member_machine_code WHERE machine_code = '$Usercode')");
        //整合数组
        if(!empty($result)){
              foreach($result as $k1=>$v1){
                    $CommodityID = !empty($v1['CommodityID'])?$v1['CommodityID']:0;
                    $result[$k1]['PictureData'] = array();
                    if(!empty($resource)){
                          foreach ($resource as $k2 => $v2) {
                                if((int)$CommodityID == (int)$v2['goods_id']){
                                  $result[$k1]['PictureData'][] = $v2;
                                }
                          }
                    }       
              }
        }
        foreach ($list as $key => $value) {
            $dat[$key]['version']=$value['version'];
            $dat[$key]['ModelData']=$result;
        }

        foreach ($dat as $key => $value) {
             $dat[$key]['layout']=$lists;
        }
       $this->apiReturn(1, '模型数据', $dat);
        /*杨yongjie  添加*/
    }
    protected function getModelId($goods_id) {
        if ($goods_id) {
            $where['goods_id'] = array('eq', $goods_id);
            $model_id = M('shop_goods_model')->where($where)->getField('id');
            return $model_id;
        } else {
            $this->apiReturn(0, '商品id错误');
        }
    }
    
    protected function getTwoLevel($cid) {
        
        $parent_id = M('shop_goods_type')->where(array('id'=>$cid))->getField('parent_id');
        $cate_info = M('shop_goods_type')->field('level,id')->where(array('id'=>$parent_id))->find();
        if ($cate_info['level'] == 3) {
            return $this->getTwoLevel($cate_info['id']);
        }
        return $cate_info['id'];
    }

    protected function apiReturn($status, $message='', $data=''){
        if ($status != 0 && $status != 1) {
            exit('参数调用错误 status');
        }

        if ($data != '' && C('APP_DATA_ENCODE') === true) {
            $data = json_encode($data); // 数组转为json字符串
            $aes = new \Common\Tools\Aes();
            $data = $aes->aes128cbcEncrypt($data); // 加密
        }

        if (is_null($data)) $data='';

        $this->ajaxReturn(V($status, $message, $data));
    }

    private function _decode(){
        $code = $_POST['code'];

        if ($code == '') {
            $this->ajaxReturn(V('0', '非法访问'));
        }

        if (C('APP_DATA_ENCODE') === true) {
            // 解密
            $aes = new \Common\Tools\Aes();
            $code = $aes->aes128cbcHexDecrypt($code);

            if ($code == '') {
                $this->ajaxReturn(V('0', '非法访问!'));
            }
        }

        $params = json_decode($code, true);

        // 重新赋值
        $_POST = null;
        foreach ($params as $key => $value) {
            // $_GET[$key] = $value;
            $_POST[$key] = $value;
        }
    }
}
