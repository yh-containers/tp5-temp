<?php
namespace app\index\controller;

class Cases extends Common
{
    //案例主页
    public function index()
    {

        return view('case',[

        ]);
    }


    //案例详情
    public function newsDet()
    {

        return view('case/case_det',[

        ]);
    }

}
