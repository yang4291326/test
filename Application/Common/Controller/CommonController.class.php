<?php
namespace Common\Controller;
use Think\Controller;
/**
 * 用户登录后, 需要继承的基类
 * create by zhaojiping <QQ: 17620286>
 */
class CommonController extends Controller {

    protected function _initialize(){
        
    }

    /**物理删除
     * ajax 删除指定数据库的记录 
     * @param string $table: 操作的数据库
     * @return json: 直接返回客户端json
     */ 
    protected function _del($table){
        $id = I('id', 0);
        $result = V(0, '删除失败, 未知错误'); 
        if($table != '' && $id != 0){
            if( M($table)->delete($id) !== false ){
                $result = V(1, '删除成功'); 
            }
        }
        $this->ajaxReturn($result);
    }

    /**
     * ajax 数据更新到回收站
     * @param string $table: 操作的数据库
     * @return json: 直接返回客户端json
     */ 
    protected function _recycle($table){
        $id = I('id', 0);
        $result = V(0, '删除失败, 未知错误');
        if($table != '' && $id != 0){
            $where['id'] = array('in', $id);
            $data['status'] = 1;
            if( M($table)->data($data)->where($where)->save() !== false){
                $result = V(1, '删除成功'); 
            }
        }
        $this->ajaxReturn($result);
    }

    /**
     * ajax 还原回收站的数据
     * @param string $table: 操作的数据库
     * @return json: 直接返回客户端json
     */
    protected function _restore($table){
        $id = I('id', 0);
        $result = V(0, '还回失败, 未知错误');
        if($table != '' && $id != 0){
            $where['id'] = array('in', $id);
            $data['status'] = 0;
            if( M($table)->data($data)->where($where)->save() !== false){
                $result = V(1, '还原成功'); 
            }
        }
        $this->ajaxReturn($result);
    }

    /**disabled在数据库中代表启用和禁用
     * ajax 修改数据的启用性
     * @param string $table: 操作的数据库
     * @return json: 直接返回客户端json
     */ 
    protected function _changeDisabled($table){
        $id = I('id', 0, 'intval');
        $disabled = I('disabled', 0, 'intval');
        $result = V(0, '修改状态失败, 未知错误'. $table . $id);
        if ($disabled != 0 && $disabled != 1) {
            $this->ajaxReturn(V(0, '修改状态失败, 状态值不正常'));
        }
        if($table != '' && $id != 0){
            $where['id'] = array('in', array($id));
            if ($disabled == 0) {
                $data['disabled'] = 1;
            } else if ($disabled == 1) {
                $data['disabled'] = 0;
            }
            $result = V(1, '还原成功111'); 
            if( M($table)->data($data)->where($where)->save() !== false){
                $result = V(1, '修改状态成功'); 
            }
        }
        $this->ajaxReturn($result);
    }

    /**
     * 覆盖上传封面, 缩略图
     */
    protected function _uploadImg(){
        $oldImg = I('oldImg', '', 'htmlspecialchars');
        $savePath = I('savePath', '', 'htmlspecialchars');
        if($savePath != '') $savePath = $savePath . '/';

        $result = array( 'status' => 1, 'msg' => '上传完成'); 
        //判断有没有上传图片
        //p(trim($_FILES['photo2']['name']));
        if(trim($_FILES['photo']['name']) != ''){

            $upload = new \Think\Upload(C('PICTURE_UPLOAD')); // 实例化上传类
            $upload->replace  = true; //覆盖
            $upload->savePath = $savePath; //定义上传目录
            //如果有上传名, 用原来的名字 
            if($oldImg != '') $upload->saveName = $oldImg;
            // 上传文件 
            $info = $upload->uploadOne($_FILES['photo']);
            if(!$info) {
                $result = array( 'status' => 0, 'msg' => $upload->getError() ); 
            }else{
                if ($oldImg != '') {
                    //删除缩略图
                    $dir = '.'.C('UPLOAD_PICTURE_ROOT') . '/' . $info['savepath'];
                    $filesnames = dir($dir);
                    while($file = $filesnames->read()){
                        if ((!is_dir("$dir/$file")) AND ($file != ".") AND ($file != "..")) {
                            $count = strpos($file, $oldImg.'_');
                            if ($count !== false) {
                                if (file_exists("$dir/$file") == true) {
                                    @unlink("$dir/$file");
                                }
                            }
                        }   
                    }
                    $filesnames->close();
                }
                $result['src'] = C('UPLOAD_PICTURE_ROOT') . '/' . $info['savepath'] . $info['savename'];
            }
            $this->ajaxReturn($result);
        }
    }

    /**
     * 删除图片
     */
    protected function _delFile(){
        $file = I('file', '', 'htmlspecialchars');

        $result = array( 'status' => 1, 'msg' => '删除完成'); 

        if($file != ''){
            $file = './' . __ROOT__ . $file;

            if (file_exists($file) == true) {
                @unlink($file); 
            } 
        }
        $this->ajaxReturn($result);
    }
}
