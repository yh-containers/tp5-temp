<?php
namespace app\admin\controller;

class Article extends Common
{
    public function index()
    {
        return view('index',[

        ]);
    }


    public function add()
    {
        return view('add',[
            'model'=>null,
        ]);
    }

}
