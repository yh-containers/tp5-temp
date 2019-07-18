<?php
namespace app\common\validate;

use think\Validate;

class Ad extends Validate
{

    protected $rule = [
        'img'      =>  'require',
    ];

    protected $message = [
        'img.require'      => '图片必须上传',
    ];

}