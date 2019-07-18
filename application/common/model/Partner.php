<?php
namespace app\common\model;

//
use think\model\concern\SoftDelete;

class Partner extends BaseModel
{
    use SoftDelete;
    //数据库表名
    protected $name = 'partner';


}