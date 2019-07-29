<?php
namespace app\common\model;

//
use think\model\concern\SoftDelete;

class Product extends BaseModel
{
    use SoftDelete;
    //数据库表名
    protected $name = 'product';
    //产品各种说明
    public static $default_intro = [
        ['name'=>'产品概述','content'=>'','ipt_type'=>'textarea'],
        ['name'=>'应用领域','content'=>'','ipt_type'=>'textarea'],
        ['name'=>'产品特点','content'=>'','ipt_type'=>'textarea'],
        ['name'=>'产品概述','content'=>'','ipt_type'=>'file'],
        ['name'=>'相关资源','content'=>'','ipt_type'=>'file'],
    ];

    public function getIntroAttr($value)
    {
        return empty($value)?[]:json_decode($value,true);
    }

    //关联栏目
    public function linkCate()
    {
        return $this->belongsTo('Navigation','cid');
    }

    //关联品牌
    public function linkBrand()
    {
        return $this->belongsTo('Brand','pid');
    }
}