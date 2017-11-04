<?php
namespace Template\Model;
use Think\Model;

/**
 * 模板详情模型
 * create by yuanyulin <QQ: 755687023>
 */
class ArticleDetailModel extends Model{
	
    protected $selectFields = array('article_id','photo_path','content','sort');
        
    /**
     * 根据where条件获取模板详情
     * @param type $where 传入的where条件值
     * @param type $field 需要获取的字段
     * @param type $order 排序的字段
     * @return array $data 返回的数据值
     */
    public function getArticleDetailList($type, $where, $field = null, $order = 'sort asc,id') {
        if ($field == null) $field = $this->selectFields;
        //权限
                switch ($type) {
            case '0': // 背景介绍 
                $titleAccess = 'interface_template_num';// 背景介绍模板-标题数量
                $photoAccess = 'interface_template_photo_num'; // 背景介绍模板-图片数量
                $vidioAccess = 'interface_template_video_num'; // 背景介绍模板-视频数量
                break;
            case '1': // 二维码模板
                break;
            case '2': // 实例分享模板
                $photoAccess = 'interface_switch_photo_num'; // 实例分享模板-图片数量
                $vidioAccess = 'interface_switch_video_num'; // 实例分享模板-视频数量
                break;
            case '3': // 收藏夹模板
                break;
            case '4':// 首页模板                
                break;
            case '5':// 解决方案模板
                $photoAccess = 'olution_photo_num';  // 解决方案-图片数量
                $vidioAccess = 'solution_video_num'; // 解决方案-视频数量
                break;
        }
        $photoAccessInfo = _getDataAccess($photoAccess); // 图片数量
        $vidioAccessInfo = _getDataAccess($vidioAccess); // 视频数量
        if ( $type == 2 || $type == 5 || $type == 0) {
           $totalPhotoVidioInfo = $photoAccessInfo + $vidioAccessInfo; // 图片和视频的总数量            
        } elseif ( $type == 1 ){
            $photoAccessInfo = 2; // 如果是二维码模板的话默认只能传入一个
            $vidioAccessInfo = 0;
        } elseif ($type == 3) { //收藏夹固定为1个模版8张图片
            $photoAccessInfo = 8;
            $vidioAccessInfo = 0;
        } elseif ($type == 4) { //首页固定为3个模版 9张 第三个不限制
            $photoAccessInfo = 9;//
            $vidioAccessInfo = 0;
            //获取已有模版的最大图片数量maxPictureNum
            $where['member_id'] = UID;
            $where['status'] = 0;
            $where['type'] = 4;
            $pictureId = M('Article')->where($where)->getField('id',true);//获取所有关联articledetail的id
            $maxId = max($pictureId);
            unset($where);

            foreach ($pictureId as $key => $value) {
                $where['article_id'] = $value;
                $pictureNum[$key] = M('ArticleDetail')->where($where)->count('id');
                unset($where);
            }
            $maxPictureNum = max($pictureNum);

            if ($count == 2 && $id == 0) { //添加时如果已经有图片数量大于9的不能创建新模版
                if ($maxPictureNum > $totalPhotoVidioInfo) {
                    $totalPhotoVidioInfo = 0;
                }else{
                    $photoAccessInfo = 1000;
                }
            }

            if ($count == 3 && $id ==$maxId) { //最新的id修改时数量不限（1000）
                $photoAccessInfo = 1000;
            }
        }
        //
        $data = $this->field($field)->where($where)->order($order)->select();
        $picNum = 0;
        $vidNum = 0;

        foreach ($data as $key => $value) {
            $data[$key]['photo_suffix'] = $this->getFileSuffix($data[$key]['photo_path']);  
            if ( $data[$key]['photo_suffix'] == 'mp4') {
                $data[$key]['photo_suffix_type'] = 1; // 是视频
                $vidNum++;
                if ($vidNum > $vidioAccessInfo) {
                    unset($data[$key]);
                }
            } else {
                $data[$key]['photo_suffix_type'] = 0; // 是图片
                $picNum++;
                if ($picNum > $photoAccessInfo) {
                    unset($data[$key]);
                }              
            }
        }
        $data = array_values($data);

        return $data;
    }
    
    /**
     * 根据传入的文件的名称获取文件的后缀名
     * @param type $fileName 传入的文件名
     * @return string 获取到的后缀名
     */
    protected function getFileSuffix($fileName) {
	$fileSuffix = explode(".", $fileName);
	return  array_pop($fileSuffix);
    }	
}