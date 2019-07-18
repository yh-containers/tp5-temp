<?php
namespace app\admin\widget;


class Components
{
    //导航
    public function menu($current_index=[])
    {

        $menu = [
//            ['name'=> '用户管理','icon'=>'fa fa-dashboard','index'=>'user','child'=>[
//                ['name'=>'用户列表','url'=>'','index'=>'user/index','child'=>[]],
//            ]],
            ['name'=> '栏目管理','icon'=>'fa fa-dashboard','index'=>'menu','child'=>[
                ['name'=>'栏目列表','url'=>'menu/index','index'=>'menu/index','child'=>[]],
            ]],
            ['name'=> '文章管理','icon'=>'fa fa-dashboard','index'=>'article','child'=>[
                ['name'=>'文章列表','url'=>'article/index','index'=>'article/index','child'=>[]],
                ['name'=>'技术支持','url'=>'article/technology','index'=>'article/technology','child'=>[]],
            ]],

            ['name'=> '系统设置','icon'=>'fa fa-dashboard','index'=>'system','child'=>[
                ['name'=>'轮播图设置','url'=>'system/flowImg','index'=>'system/flowImg','child'=>[]],
                ['name'=>'合作伙伴','url'=>'system/partner','index'=>'system/partner','child'=>[]],
                ['name'=>'常规设置','url'=>'system/setting','index'=>'system/setting','child'=>[]],
                ['name'=>'管理员设置','url'=>'system/manager','index'=>'system/manager','child'=>[]],

            ]],
        ];
        return view('/common/menu',[
            'menu'=>$menu,
            'current_index'=>$current_index
        ])->getContent();
    }
}