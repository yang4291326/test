<?php
namespace Admin\Model;
use Think\Model;

/**
 *  用户数据权限表模型
 *  @author yuanyulin  <QQ:755687023>
 */
class DataAccessModel extends Model{
    
    protected $insertFields = array('member_id', 'force_upgrade', 'silent_upgrade', 'tip_upgrade', 'attribute_configuration', 'data_num', 'send_num', 'interface_switch', 'goods_type_num_1', 'goods_type_num_2', 'goods_type_num_3', 'goods_type_num_4', 'goods_type_num_5', 'goods_attribute_num', 'carousel_num', 'interface_switch_num', 'interface_switch_video_access', 'interface_switch_video_num', 'interface_switch_photo_access', 'interface_switch_photo_num', 'background_template_video_access', 'interface_template_video_num', 'interface_template_photo_access', 'interface_template_photo_num', 'interface_template_num', 'solution_video_num', 'olution_photo_num', 'olution_num', 'goods_recommendation_num', 'custom_template_num', 'drainage_num', 'goods_detail_photo_num', 'vr_move', 'vr_rotate', 'vr_zoom', 'vr_change_color', 'vr_favorites', 'vr_layout_style_switch', 'machine_code_num');
    protected $updateFields = array('id', 'member_id', 'force_upgrade', 'silent_upgrade', 'tip_upgrade', 'attribute_configuration', 'data_num', 'send_num', 'interface_switch', 'goods_type_num_1', 'goods_type_num_2', 'goods_type_num_3', 'goods_type_num_4', 'goods_type_num_5', 'goods_attribute_num', 'carousel_num', 'interface_switch_num', 'interface_switch_video_access', 'interface_switch_video_num', 'interface_switch_photo_access', 'interface_switch_photo_num', 'background_template_video_access', 'interface_template_video_num', 'interface_template_photo_access', 'interface_template_photo_num', 'interface_template_num', 'solution_video_num', 'olution_photo_num', 'olution_num', 'goods_recommendation_num', 'custom_template_num', 'drainage_num', 'goods_detail_photo_num', 'vr_move', 'vr_rotate', 'vr_zoom', 'vr_change_color', 'vr_favorites', 'vr_layout_style_switch', 'machine_code_num');
    
    protected $_validate = array(
        array('machine_code_num', 'number', '必须为数字！', self::MUST_VALIDATE, 'regex', 3),
        array('member_id', 'number', '必须为数字！', self::MUST_VALIDATE, 'regex', 3),
        /*array('force_upgrade', 'number', '必须为数字！', self::MUST_VALIDATE, 'regex', 3),*/
        /*array('silent_upgrade', 'number', '必须为数字！', self::MUST_VALIDATE, 'regex', 3),*/
        array('tip_upgrade', 'number', '必须为数字！', self::MUST_VALIDATE, 'regex', 3),
        array('attribute_configuration', 'number', '必须为数字！', self::MUST_VALIDATE, 'regex', 3),
        array('data_num', 'number', '数据个数必须为数字！', self::MUST_VALIDATE, 'regex', 3),
        array('send_num', 'number', '发送次数必须为数字！', self::MUST_VALIDATE, 'regex', 3),
        array('interface_switch', 'number', '必须为数字！', self::MUST_VALIDATE, 'regex', 3),
        /*array('goods_type_num_1', 'number', '一级商品分类个数必须为数字！', self::MUST_VALIDATE, 'regex', 3),*/
        array('goods_type_num_2', 'number', '二级商品分类个数必须为数字！', self::MUST_VALIDATE, 'regex', 3),
        array('goods_type_num_3', 'number', '三级商品分类个数必须为数字！', self::MUST_VALIDATE, 'regex', 3),
        array('goods_type_num_4', 'number', '四级商品分类个数必须为数字！', self::MUST_VALIDATE, 'regex', 3),
        /*array('goods_type_num_5', 'number', '五级商品分类个数必须为数字！', self::MUST_VALIDATE, 'regex', 3),*/
        array('goods_attribute_num', 'number', '商品属性个数必须为数字！', self::MUST_VALIDATE, 'regex', 3),
        array('carousel_num', 'number', '轮播图模板图片数量必须为数字！', self::MUST_VALIDATE, 'regex', 3),
        array('interface_switch_num', 'number', '实例分享模板数量必须为数字！', self::MUST_VALIDATE, 'regex', 3),
        array('interface_switch_video_access', 'number', '必须为数字！', self::MUST_VALIDATE, 'regex', 3),
        array('interface_switch_video_num', 'number', '必须为数字！', self::VALUE_VALIDATE, 'regex', 3),
        array('interface_switch_photo_access', 'number', '必须为数字！', self::MUST_VALIDATE, 'regex', 3),
        array('interface_switch_photo_num', 'number', '必须为数字！', self::VALUE_VALIDATE, 'regex', 3),
        array('background_template_video_access', 'number', '必须为数字！', self::MUST_VALIDATE, 'regex', 3),
        array('interface_template_video_num', 'number', '必须为数字！', self::VALUE_VALIDATE, 'regex', 3),
        array('interface_template_photo_access', 'number', '必须为数字！', self::MUST_VALIDATE, 'regex', 3),
        array('interface_template_photo_num', 'number', '必须为数字！', self::VALUE_VALIDATE, 'regex', 3),
        array('interface_template_num', 'number', '背景介绍模板数量必须为数字！', self::MUST_VALIDATE, 'regex', 3),
        array('solution_video_num', 'number', '解决方案 （视频数量）必须为数字！', self::MUST_VALIDATE, 'regex', 3),
        array('olution_photo_num', 'number', '解决方案（图片数量）必须为数字！', self::MUST_VALIDATE, 'regex', 3),
        array('olution_num', 'number', '解决方案（标题数量）必须为数字！', self::MUST_VALIDATE, 'regex', 3),
        /*array('goods_recommendation_num', 'number', '商品推荐个数必须为数字！', self::MUST_VALIDATE, 'regex', 3),*/
        /*array('custom_template_num', 'number', '自定义模板数量必须为数字！', self::MUST_VALIDATE, 'regex', 3),*/
        array('drainage_num', 'number', '互相引流个数必须为数字！', self::MUST_VALIDATE, 'regex', 3),
        array('goods_detail_photo_num', 'number', '商品详情图片数量必须为数字！', self::MUST_VALIDATE, 'regex', 3),
        array('vr_move', 'number', '必须为数字！', self::MUST_VALIDATE, 'regex', 3),
        array('vr_rotate', 'number', '必须为数字！', self::MUST_VALIDATE, 'regex', 3),
        array('vr_zoom', 'number', '必须为数字！', self::MUST_VALIDATE, 'regex', 3),
        array('vr_change_color', 'number', '必须为数字！', self::MUST_VALIDATE, 'regex', 3),
        array('vr_favorites', 'number', '必须为数字！', self::MUST_VALIDATE, 'regex', 3),
        array('vr_layout_style_switch', 'number', '必须为数字！', self::MUST_VALIDATE, 'regex', 3),
    );
    
    protected function _before_insert(&$data,$option) {
        if ($data['interface_switch_video_access'] == 0) { // 实例分享模板 (视频权限0）
            $data['interface_switch_video_num'] = 0; // 实例分享模板（视频数量就滞空）
        }
        if ($data['interface_switch_photo_access'] == 0) { // 实例分享模板 (图片权限0）
            $data['interface_switch_photo_num'] = 0; // 实例分享模板（图片数量就滞空）
        }
        if ($data['background_template_video_access'] == 0) { // 背景介绍模板 (视频权限0）
            $data['interface_template_video_num'] = 0; // 背景介绍模板（视频数量就滞空）
        }
        if ($data['interface_template_photo_access'] == 0) { // 背景介绍模板 (图片权限0）
            $data['interface_template_photo_num'] = 0; // 背景介绍模板（图片数量就滞空）
        }
    }
    
    protected function _before_update(&$data,$option) {
        if ($data['interface_switch_video_access'] == 0) { // 实例分享模板 (视频权限0）
            $data['interface_switch_video_num'] = 0; // 实例分享模板（视频数量就滞空）
        }
        if ($data['interface_switch_photo_access'] == 0) { // 实例分享模板 (图片权限0）
            $data['interface_switch_photo_num'] = 0; // 实例分享模板（图片数量就滞空）
        }
        if ($data['background_template_video_access'] == 0) { // 背景介绍模板 (视频权限0）
            $data['interface_template_video_num'] = 0; // 背景介绍模板（视频数量就滞空）
        }
        if ($data['interface_template_photo_access'] == 0) { // 背景介绍模板 (图片权限0）
            $data['interface_template_photo_num'] = 0; // 背景介绍模板（图片数量就滞空）
        }        
    }
}
