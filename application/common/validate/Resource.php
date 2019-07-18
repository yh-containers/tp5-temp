<?php
namespace app\common\validate;

use think\Validate;

class Resource extends Validate
{

    protected $rule = [
        'name'     =>  'require',
        'file'      =>  'require',
    ];

    protected $message = [
        'name.require'     => '资源名必须填写',
        'file.require'      => '资源文件必须上传',
    ];

}