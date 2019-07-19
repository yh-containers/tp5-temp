<?php
namespace app\index\controller;

class About extends Common
{
    //公司简介
    public function index(){

        return view('about',[

        ]);
    }

    //资质荣誉
    public function honor(){

        return view('honor',[

        ]);
    }

    //新闻资讯
    public function news(){

        return view('news',[

        ]);
    }

    //联系我们
    public function contact(){

        return view('contact',[

        ]);
    }


}