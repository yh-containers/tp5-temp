<?php
namespace app\index\controller;


class Index extends Common
{
    //首頁
    public function index()
    {

        return view('index',[

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
}
