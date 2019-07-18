<?php
namespace app\common\validate;

use think\Validate;

class Product extends Validate
{

    protected $rule = [
        'name'     =>  'require',
        'img'      =>  'require',
    ];

    protected $message = [
        'name.require'     => '产品名称必须填写',
        'img.require'      => '图片必须上传',
    ];

}