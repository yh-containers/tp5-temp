<?php
namespace app\common\validate;

use think\Validate;

class Partner extends Validate
{

    protected $rule = [
        'name'     =>  'require',
        'img'      =>  'require',
    ];

    protected $message = [
        'name.require'     => '合伙人名必须填写',
        'img.require'      => '图片必须上传',
    ];

}