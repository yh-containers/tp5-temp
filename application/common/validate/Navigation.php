<?php
namespace app\common\validate;

use think\Validate;

class Navigation extends Validate
{

    protected $rule = [
        'name'      =>  'require|min:1',
    ];

    protected $message = [
        'name.require'      => '名称必须输入',
        'name.min'          => '名称长度必须超过:rule位',
    ];


}