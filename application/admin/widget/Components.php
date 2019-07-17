<?php
namespace app\admin\widget;


class Components
{
    //导航
    public function menu($current_index=[])
    {
        $menu = [
            ['name'=> '用户管理','icon'=>'fa fa-dashboard','index'=>'user','child'=>[
                ['name'=>'用户列表','url'=>'','index'=>'user/index','child'=>[]],
            ]],
            ['name'=> '栏目管理','icon'=>'fa fa-dashboard','index'=>'menu','child'=>[
                ['name'=>'栏目列表','url'=>'','index'=>'menu/index','child'=>[]],
            ]],
            ['name'=> 'test','icon'=>'fa fa-dashboard','index'=>'test','child'=>[
                ['name'=>'test1','index'=>'test/index','child'=>[
                    ['name'=>'test1-1','url'=>'','index'=>'test/index-1'],
                    ['name'=>'test1-2','url'=>'','index'=>'test/index-2']
                ]],
            ]],
            ['name'=> '系统设置','icon'=>'fa fa-dashboard','index'=>'system','child'=>[
                ['name'=>'常规设置','url'=>'system/index','index'=>'system/index','child'=>[]],
                ['name'=>'管理员设置','url'=>'system/manager','index'=>'system/manager','child'=>[]],

            ]],
        ];
        return view('/common/menu',[
            'menu'=>$menu,
            'current_index'=>$current_index
        ])->getContent();
    }
}