<?php
namespace app\index\widget;

class Component{
    //首页顶部导航
    public function header($act_menu = 'index'){
        $list = \app\common\model\Navigation::where(['pid'=>0,'status'=>1])->order('sort', 'asc')->select();
        return view('common/header',[
            'act_menu'=>$act_menu,
            'list'=>$list,
        ])->getContent();
    }

    //首页底部导航
    public function footer(){
        //导航
        $list = \app\common\model\Navigation::with(['linkChild'=>function($query){
            return $query->where(['status'=>1]);
        }])->where(['pid'=>0,'status'=>1])->order('sort', 'asc')->select();
        //合作伙伴
        $partner = \app\common\model\Partner::where('status',1)->limit('4')->order('sort asc')->select();
        return view('common/footer',[
            'list'=>$list,
            'partner'=>$partner,
        ])->getContent();
    }

    //获取系统设置信息
    public function getSysSetting($type,$field=false)
    {
        $content = \app\common\model\SysSetting::getContent($type);
        if($field){
            $content = json_decode($content,true);
            $content = empty($content[$field])?'':$content[$field];
        }
        return $content;
    }

    //获取系统设置信息
    public function hotKey($type,$field=false,$url='')
    {
        $content = \app\common\model\SysSetting::getContent($type);
        if($field){
            $content = json_decode($content,true);
            $content = empty($content[$field])?'':$content[$field];
        }
        $keyword = empty($content)?[]:explode("\r\n",$content);
        $str = '';
        foreach ($keyword as $vo){
            $str .='<a href="'.url($url).'?keyword='.$vo.'">'.$vo.'</a>';
        }
        return $str;
    }

    //分享
    public function share()
    {
        return view('share',[

        ])->getContent();
    }
}