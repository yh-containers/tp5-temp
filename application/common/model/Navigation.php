<?php
namespace app\common\model;

use think\model\concern\SoftDelete;

class Navigation extends BaseModel
{
    use SoftDelete;
    //数据库表名
    protected $name = 'navigation';

    public function linkChild()
    {
        return $this->hasMany('Navigation','pid')->order('sort asc');
    }
}