<?php
namespace app\common\validate;

use think\Validate;

class Cases extends Validate
{
    //验证规则
    protected $rule = [
        'title'      =>  'require|min:1',
        'from'       =>  'require|min:1',
        'img'        =>  'require|min:1',
        'intro'      =>  'require|min:1',
        'content'    =>  'require|min:1',
    ];

    //提示信息
    protected $message = [
        'title.require'    => '标题必须输入',
        'from.require'     => '来源必须输入',
        'img.require'      => '图片必须输入',
        'intro.require'    => '简介必须输入',
        'content.require'  => '内容必须输入',
    ];

}