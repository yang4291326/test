<?php
// +----------------------------------------------------------------------
// | Author: liuyang <594353482>
// +----------------------------------------------------------------------

namespace Admin\Controller;
use Think\Controller;

class AjaxController extends AdminCommonController {

    /**
     * 覆盖上传图片
     */
    public function uploadImg(){
        $oldImg = I('oldImg', '', 'htmlspecialchars');
        $savePath = 'Temp/';  //上传到临时文件夹

        if($oldImg != '') $oldImg = basename($oldImg, strrchr(basename($oldImg), '.'));

        $result = array( 'status' => 1, 'msg' => '上传完成'); 
        //判断有没有上传图片
        //p(trim($_FILES['photo2']['name']));
        if(trim($_FILES['photo']['name']) != ''){
            $upload = new \Think\Upload(C('upload')); // 实例化上传类
            $upload->maxSize = 1024 * 5000; //限制大小
            $upload->replace  = true; //覆盖
            $upload->savePath = $savePath; //定义上传目录
            //如果有上传名, 用原来的名字
            if($oldImg != '') $upload->saveName = $oldImg;
            //上传文件 
            $info = $upload->uploadOne($_FILES['photo']);
            if(!$info) {
                $result = array( 'status' => 0, 'msg' => $upload->getError()); 
            }else{
                $filename = C('UploadRoot') . '/' . $savePath . $info['savename'];
                //旋转图片, 修正手机上传问题
                $this->correctImageOrientation('./'. $filename);
                $result['src'] = $filename;
            }
            $this->ajaxReturn($result);
        }
    }

    //修改手机上传图片翻转问题
    private function correctImageOrientation($filename) {  
        if (function_exists('exif_read_data')) {

            $exif = exif_read_data($filename);
            if($exif && isset($exif['Orientation'])) {  
                $orientation = $exif['Orientation'];
                if($orientation != 1){
                    $img = imagecreatefromjpeg($filename);
                    $deg = 0;
                    switch ($orientation) {
                        case 3:
                        $deg = 180;
                        break;
                        case 6:
                        $deg = 270;
                        break;
                        case 8:
                        $deg = 90;
                        break;
                    }
                    if ($deg) {
                        $img = imagerotate($img, $deg, 0);    
                    }
                    // then rewrite the rotated image back to the disk as $filename 
                    imagejpeg($img, $filename, 95); 
                } // if there is some rotation necessary
            } // if have the exif orientation info
        } // if function exists      
    }

    /**
     * 裁剪图片
     */
    public function cropper(){
        //剪图
        $cropLeft = I('cropLeft', 0, 'intval');
        $cropTop = I('cropTop', 0, 'intval');
        $cropWidth = I('cropWidth', 0, 'intval');
        $cropHeight = I('cropHeight', 0, 'intval');
        //图片
        $canvasLeft = I('canvasLeft', 0, 'intval');
        $canvasTop = I('canvasTop', 0, 'intval');
        $canvasWidth = I('canvasWidth', 0, 'intval');
        $canvasHeight = I('canvasHeight', 0, 'intval');
        //原图地址
        $file = I('file', '', 'htmlspecialchars');
        $file = explode('?', $file)[0];
        //只允许裁剪TEMP目录下的文件
        $filename = basename($file);
        $file = '.'. C('UPLOAD_PICTURE_ROOT') . '/Temp/'.time_format(time(), 'Y-m-d').'/'. $filename;
        //图片截取后保存的图片
        $path = I('path', '', 'htmlspecialchars');
        
        try {
            $image = new \Think\Image(); 
            $image->open($file);

            $height = $image->height(); //返回图片的高度
            $width = $image->width(); //返回图片的高度
            
            //开始剪
            $image->thumb($canvasWidth, $canvasHeight, \Think\Image::IMAGE_THUMB_FIXED)->save($file);
            $image->crop($cropWidth, $cropHeight,$cropLeft-$canvasLeft,$cropTop-$canvasTop)->save($file);
            
            //把文件移动到正式文件夹
            if ($path != '') {
                $createImgPath = '.'. C('UPLOAD_PICTURE_ROOT') .'/'. $path;
            } else {
                $createImgPath = '.'. C('UPLOAD_PICTURE_ROOT') .'/User';
            }
            if ( !is_dir($createImgPath) ) {
                mkdir($createImgPath);
            }
            $createImgPath = $createImgPath . '/' . time_format(time(), 'Y-m-d');
            if ( !is_dir($createImgPath) ) {
                mkdir($createImgPath);
            }
            $newFile = $createImgPath .'/'. $filename;
            rename($file, $newFile);

            if (substr($newFile, 0, 1) == '.') {
                $newFile = substr($newFile, 1);
            }
            $result = array('status'=> 1, 'src'=> $newFile);
        } catch (Exception $e) {
            $result = array('status'=> 0, 'msg'=> '处理图片失败, 未知原因!');
        }
        $this->ajaxReturn($result);
    }

    /**
     * 删除图片
     */
    public function delFile(){
        $file = I('file', '', 'htmlspecialchars');

        if($file == ''){
            $this->ajaxReturn(array( 'status' => 0, 'msg' => '参数丢失'));
        }
        
        //获取文件扩展名, 并改为小写
        $info = pathinfo($file); 
        $ext = strtolower($info['extension']); 
        if(!($ext == 'jpg' || $ext == 'jpeg' || $ext == 'gif' || $ext == 'png')){
            $this->ajaxReturn(array( 'status' => 0, 'msg' => '非法操作'));
        }

        $file = './' . __ROOT__ . $file;
        if (file_exists($file) == true) {
            @unlink($file); 
        }
        $this->ajaxReturn(array( 'status' => 1, 'msg' => '删除完成'));
    }

}