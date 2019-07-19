<?php
namespace app\index\controller;


class Product extends Common
{
    //
    public function index()
    {
        //分类
        $cid = $this->request->param('cid');
        $keyword = $this->request->param('keyword','','trim');

        //分类信息
        $cate = \app\common\model\Navigation::with(['linkChild'=>function($query){
            return $query->where(['status'=>1]);
        }])->where([['pid','=',0],['status','=',1],['url','=','product/index']])->find();
        //合作伙伴
        $partner = \app\common\model\Partner::where(['status'=>1])->limit(10)->order('sort asc')->select();
        //当前分类
        $current_cate = null;
        foreach ($cate['linkChild'] as $vo){
            if($cid==$vo['id']){
                $current_cate = $vo;
                break;
            }
        }

        //商品信息
        $where[] = ['status','=',1];
        !empty($keyword) && $where[] = ['name','like','%'.$keyword.'%'];
        !empty($cid) && $where[] = ['cid','=',$cid];
        $list = \app\common\model\Product::where($where)->order('sort asc')->paginate(6);
        return view('index',[
            'list' => $list,
            'page'=>$list->render(),
            'cate' => $cate,
            'current_cate' => $current_cate,
            'partner' => $partner,
            'cid' => $cid,
            'keyword' => $keyword,
        ]);
    }

    public function detail()
    {
        $id = $this->request->param('id');
        $model = \app\common\model\Product::where(['status'=>1,'id'=>$id])->find();
        //分类信息
        $cate = \app\common\model\Navigation::with(['linkChild'=>function($query){
            return $query->where(['status'=>1]);
        }])->where([['pid','=',0],['status','=',1],['url','=','product/index']])->find();
        //当前分类
        $current_cate = null;
        foreach ($cate['linkChild'] as $vo){
            if($model['cid']==$vo['id']){
                $current_cate = $vo;
                break;
            }
        }
        //推荐商品
        $up_list = \app\common\model\Product::where([['status','=',1],['id','<>',$id]])->limit(4)->select();

        return view('detail',[
            'model'=> $model,
            'up_list'=> $up_list,
            'current_cate'=> $current_cate,
            'cate'=> $cate,
        ]);
    }
}
