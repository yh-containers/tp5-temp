<?php
namespace app\index\controller;

use think\Request;

class Error
{

    public function _empty(Request $request)
    {
        $data = ['code'=>-1,'msg'=>'页面异常'];
        //当前控制器
        if(strtolower($request->controller())=='uploads'){
            $data['msg'] = '下载资源不存在';
        }

        return $request->isAjax()?$data:view('/error',$data);
    }
}
