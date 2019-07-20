<?php
namespace app\index\controller;


class Resource extends Common
{
    //
    public function index()
    {
        $keyword = $this->request->param('keyword','','trim');
        $cate = \app\common\model\Navigation::with(['linkChild'=>function($query){
            return $query->where(['status'=>1]);
        }])->where([['pid','=',0],['status','=',1],['url','=','article/solution']])->find();

        $where[] = ['status','=',1];
        !empty($keyword) && $where[] = ['name','like','%'.$keyword.'%'];
        $list = \app\common\model\Resource::where($where)->order('sort asc')->paginate(6);
        return view('index',[
            'keyword' => $keyword,
            'cate' => $cate,
            'list' => $list,
            'page'=>$list->render(),
        ]);
    }

    public function recordTimes()
    {
        $id = $this->request->param('id');
        \app\common\model\Resource::where(['id'=>$id])->setInc('num');
    }

}
