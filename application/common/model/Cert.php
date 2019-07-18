<?php
namespace app\common\model;

//
use think\model\concern\SoftDelete;

class Cert extends BaseModel
{
    use SoftDelete;
    //数据库表名
    protected $name = 'cert';


}