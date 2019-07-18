<?php
namespace app\admin\controller;

class Index extends Common
{
    public function index()
    {
        return view('index',[

        ]);
    }

    //用户登录
    public function login()
    {

        return view('login',[

        ]);

    }


}
