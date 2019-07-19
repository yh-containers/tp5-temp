<?php
namespace app\index\widget;

class Component{
    //首页顶部导航
    public function header($act_menu = 'index'){
//        $list = \app\common\model\Category::where(['pid'=>0,'status'=>1])->order('sort', 'asc')->select();
        $content= view('common/header',[
            'act_menu'=>$act_menu,
//            'list'=>$list,
        ]);
        return $content->getContent();
    }

    //首页底部导航
    public function footer($act_menu = 'index'){
        $content= view('common/footer',['act_menu'=>$act_menu]);
        return $content->getContent();
    }

}