<?php
namespace app\common\model;

//
use think\model\concern\SoftDelete;

class Article extends BaseModel
{
    use SoftDelete;
    //数据库表名
    protected $name = 'article';



    public function linkCate()
    {
        return $this->belongsTo('Navigation','cid');
    }
}