<?php
namespace app\common\model;

//
use think\model\concern\SoftDelete;

class Technology extends BaseModel
{
    use SoftDelete;
    //数据库表名
    protected $name = 'technology';


}