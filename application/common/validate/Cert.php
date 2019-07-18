<?php
namespace app\common\validate;

use think\Validate;

class Cert extends Validate
{

    protected $rule = [
        'name'     =>  'require',
        'img'      =>  'require',
    ];

    protected $message = [
        'name.require'     => '证书名必须填写',
        'img.require'      => '图片必须上传',
    ];

}