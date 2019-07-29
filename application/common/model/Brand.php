<?php
namespace app\common\model;


use think\model\concern\SoftDelete;

class Brand extends BaseModel
{
    use SoftDelete;
    //数据库表名
    protected $name = 'brand';


    public function linkCate()
    {
        return $this->belongsTo('Navigation','cid');
    }
}