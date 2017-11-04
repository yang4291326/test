<?php
namespace Homelog\Controller;

/**
 * Created by liuniukeji.com
 * 前台日志写入接口
 * @author yuanyulin <7556870234@qq.com>
*/
class HomeLogApiController extends \Common\Controller\CommonApiController {
    
    // 向数据库中插入数据
    public function insertQuery(){
        $query = I('post.query', ''); // 获取需要写入到数据库的数据
        empty($query) &&  $this->apiReturn(0, '导入信息为空！');    
        $data = json_decode($query, true);
        $this->apiReturn(1, $data);
//        var_dump($data);die;
//        foreach ($data as $key => $value) {
//              M("HomeLog")->add($value);
//        }
//        $this->apiReturn(1, '导入数据库备份信息成功！');            
    }
}
