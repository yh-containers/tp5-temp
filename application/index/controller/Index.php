<?php
namespace app\index\controller;


class Index extends Common
{
    //首頁
    public function index()
    {
        //轮播图
        $flow_img =  \app\common\model\Ad::where(['type'=>0,'status'=>1])->order('sort asc')->select();
        //产品
        $product_cate = \app\common\model\Navigation::with(['linkChild'=>function($query){
            return $query->where(['status'=>1]);
        }])->where([['pid','=',0],['status','=',1],['url','=','product/index']])->find();
        //成功案例
        $case_cate = \app\common\model\Navigation::with(['linkCase'=>function($query){
            return $query->where(['status'=>1])->order('sort asc');
        }])->where([['pid','=',0],['status','=',1],['url','=','article/case']])->find();
        //解决方案
        $solution_cate = \app\common\model\Navigation::with(['linkChild'=>function($query){
            return $query->where(['status'=>1]);
        }])->where([['pid','=',0],['status','=',1],['url','=','article/solution']])->find();
        //新闻资讯
        $news_cate = \app\common\model\Navigation::with(['linkChild'=>function($query){
            return $query->with(['linkNews'=>function($q){
                return $q->where(['status'=>1])->order('show_time desc');
            }])->where(['status'=>1]);
        }])->where([['status','=',1],['url','=','article/news']])->find();
//        dump($news_cate);exit;
        return view('index',[
            'flow_img' =>$flow_img,
            'product_cate' =>$product_cate,
            'case_cate' =>$case_cate,
            'solution_cate' =>$solution_cate,
            'news_cate' =>$news_cate,
        ]);
    }

    //产品中心
    public function products()
    {
        return view('products/products');
    }

    //解决方案
    public function solution()
    {
        return view('solution/solution');
    }


    //资料下载
    public function download()
    {
        return view('download/download');
    }


    //精品案例
    public function cases()
    {
        return view('case/case');
    }

    //关于华新
    public function about()
    {
        return view('about/about');
    }

    //技术支持
    public function support()
    {
        return view('support/support');
    }

    //百度地图
    public function map()
    {
        return view('map');
    }
}
