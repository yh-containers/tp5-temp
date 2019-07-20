<?php
namespace app\common\model;

//
use think\model\concern\SoftDelete;

class Solution extends BaseModel
{
    use SoftDelete;
    //数据库表名
    protected $name = 'solution';



    public function linkCate()
    {
        return $this->belongsTo('Navigation','cid');
    }
}