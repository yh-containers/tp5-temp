<?php
namespace app\m\controller;

class Index extends Common
{
    public function index()
    {
        //轮播图
        $flow_img =  \app\common\model\Ad::where(['type'=>0,'status'=>1])->order('sort asc')->select();
        //产品
        $product_cate = \app\common\model\Navigation::with(['linkChild'=>function($query){
            return $query->where(['status'=>1]);
        }])->where([['pid','=',0],['status','=',1],['url','=','product/index']])->find();
        //成功案例
        $case_cate = \app\common\model\Navigation::where([['pid','=',0],['status','=',1],['url','=','article/cases']])->find();
        $cate_ids = [];
        if(!empty($case_cate)){
            $cate_ids[]=$case_cate['id'];
            $case_cate->linkChild->each(function($item,$key)use(&$cate_ids){
                array_push($cate_ids,$item['id']);
            });
        }
        $case_list = \app\common\model\Cases::where(['status'=>1,'cid'=>$cate_ids])->order('sort asc')->limit(6)->select();
        $case_cate['link_case']= empty($case_list)?[]:$case_list;
        //解决方案
        $solution_cate = \app\common\model\Navigation::with(['linkChild'=>function($query){
            return $query->where(['status'=>1])->limit(4);
        }])->where([['pid','=',0],['status','=',1],['url','=','article/solution']])->find();
        //新闻资讯
        $news_cate = \app\common\model\Navigation::with(['linkChild'=>function($query){
            return $query->with(['linkNews'=>function($q){
                return $q->where(['status'=>1])->order('show_time desc')->limit(2);
            }])->where(['status'=>1]);
        }])->where([['status','=',1],['url','=','article/news']])->find();
        //dump($case_cate);exit;
        return view('index',[
            'flow_img' =>$flow_img,
            'product_cate' =>$product_cate,
            'case_cate' =>$case_cate,
            'solution_cate' =>$solution_cate,
            'news_cate' =>$news_cate,
        ]);
    }

    //百度地图
    public function map()
    {
        return view('map');
    }
}