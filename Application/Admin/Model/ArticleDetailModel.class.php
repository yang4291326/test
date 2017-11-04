<?php
namespace Common\Model;
use Think\Model;

/**
 *  模版附加信息模型
 *  @author yuanyulin <QQ: 755687023>
 */
class ArticleDetailModel extends Model{
    protected $insertFields = array('content', 'photo_path', 'article_id', 'sort','record_id');

    protected $_validate = array(
        array('article_id', 'require', '关联模块id不能为空', self::MUST_VALIDATE, 'regex', 3),
        
        array('sort', '0,1000', '排序范围0~1000！', 2, 'between', 3),
    );

    /**
     * 修改模板附加表信息
     * @param type $data         需要修改的模板附加表的信息    
     * @param type $article_id   对应的article表的id
     * @return int
     */
    public function editarticleDetailValue($data, $article_id){

        $this->where('article_id='. $article_id)->delete(); // 先删除原来的信息

        foreach ($data as $key => $value) {// 将新的信息写入表中
            $value['article_id'] = $article_id;
            if($this->create($value) !== false){
                $this->add();
            } else {
                return($this->getError());
            }        
        }        
        return 1;
    }
}