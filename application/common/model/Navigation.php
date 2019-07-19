<?php
namespace app\common\model;

use think\model\concern\SoftDelete;

class Navigation extends BaseModel
{
    use SoftDelete;
    public static $fields_label = ['其它栏目','文章栏目','商品栏目'];
    //数据库表名
    protected $name = 'navigation';

    public function linkChild()
    {
        return $this->hasMany('Navigation','pid')->order('sort asc');
    }

    //关联具体信息
    public function linkNews()
    {
        return $this->hasMany('Article','cid');
    }
    //关联具体信息
    public function linkCase()
    {
        return $this->hasMany('Cases','cid');
    }
}