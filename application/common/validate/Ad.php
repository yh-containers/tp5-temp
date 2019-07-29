<?php
namespace app\common\validate;

use think\Validate;

class Ad extends Validate
{

    protected $rule = [
        'img'         =>  'require',
        'h5_img'      =>  'require',
    ];

    protected $message = [
        'img.require'         => 'pc端图片必须上传',
        'h5_img.require'      => '手机端图片必须上传',
    ];

}