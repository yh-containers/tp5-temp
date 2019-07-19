<?php
namespace app\index\controller;

class Solution extends Common
{
    //解决方案
    public function index()
    {
        return view('solution',[

        ]);
    }

    //方案详情
    public function soDet()
    {
        return view('solution_det',[

        ]);
    }
}