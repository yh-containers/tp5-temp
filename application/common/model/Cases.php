<?php
namespace app\common\model;

use think\model\concern\SoftDelete;
class Cases extends BaseModel
{
    use SoftDelete;
    //数据库表名
    protected $name = 'cases';

    public function linkCate()
    {
        return $this->belongsTo('Navigation','cid');
    }
}
