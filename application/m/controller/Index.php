<?php
namespace app\m\controller;

class Index extends Common
{
    public function index()
    {
        //轮播图
        $flow_img =  \app\common\model\Ad::where(['type'=>0,'status'=>1])->order('sort asc')->select(3);
        //产品
        $product_cate = \app\common\model\Navigation::with(['linkChild'=>function($query){
            return $query->where(['status'=>1]);
        }])->where([['pid','=',0],['status','=',1],['url','=','product/index']])->find();
        //成功案例
        $case_cate = \app\common\model\Navigation::with(['linkCase'=>function($query){
            return $query->where(['status'=>1])->order('sort asc')->limit(6);
        }])->where([['pid','=',0],['status','=',1],['url','=','article/cases']])->find();
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
        //dump($product_cate);exit;
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