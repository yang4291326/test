<?php
namespace Skin\Controller;

/**
 * Created by liuniukeji.com
 * 用户换肤接口
 * @author yuanyulin <7556870234@qq.com>
*/
class SkinApiController extends \Common\Controller\CommonApiController {
    
    // 获取用户可以获取的换肤地址
    public function skin(){
        $defaultSkinId = M('Member')->where('id='. UID)->getfield('skin_id');
        $where['id']       = array('EQ', $defaultSkinId);
        $where['disabled'] = array('EQ', 0);
        $where['status']   = array('EQ', 0);
        $skinInfo = M('Skin')->field('name, photo_path, file_path')->where($where)->find();
        $skinConfigPath = '.'.$skinInfo['file_path'] . 'config.json';
        if(file_exists($skinConfigPath)){
            $fp = fopen($skinConfigPath, "r");
            $str = fread($fp,filesize($skinConfigPath));//指定读取大小，这里把整个文件内容读取出来
            $skinInfo['color_config'] = json_decode($str, true);
        }
        if ($skinInfo) {
            $this->apiReturn(1, '默认皮肤文件', $skinInfo);             
        } else {
            $this->apiReturn(0, '没有皮肤文件'); 
        }
    }
}
