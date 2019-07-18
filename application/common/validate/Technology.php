<?php
namespace app\common\validate;

use think\Validate;

class Technology extends Validate
{

    protected $rule = [
        'title'      =>  'require|min:2',
        'content'      =>  'require|min:5',
    ];

    protected $message = [
        'title.require'      => '问题标题必须输入',
        'title.min'          => '问题标题长度必须超过:rule位',
        'content.require'      => '答案必须输入',
        'content.min'          => '答案长度必须超过:rule位',
    ];


}