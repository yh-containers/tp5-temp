<?php
namespace app\index\controller;


class Product extends Common
{
    //产品主页
    public function index()
    {
        //分类
        $cid = $this->request->param('cid');//分类id
        $pid = $this->request->param('pid');//品牌id
        $keyword = $this->request->param('keyword','','trim');

        //分类信息
        $cate = \app\common\model\Navigation::with(['linkChild'=>function($query){
            return $query->where(['status'=>1]);
        }])->where([['pid','=',0],['status','=',1],['url','=','product/index']])->find();

        //品牌查询条件
        $brand_where =[];
        //当查询的品牌状态为1，且cid不为空时
        $brand_where[] =['status','=',1];
        !empty($cid) && $brand_where[] =['cid','=',$cid];

        //产品品牌查询
        if(!$cid){
            $brand = \app\common\model\Brand::where($brand_where)->limit(10)->order('sort asc')->select();
        }else{
            $brand = \app\common\model\Brand::where($brand_where)->order('sort asc')->select();
        }
        //当前点击的品牌
        $current_brand = \app\common\model\Brand::where(['id'=>$pid])->find();
        //dump($current_brand);exit;
        //当前分类
        $current_cate = null;
        foreach ($cate['link_child'] as $vo){
            if($cid==$vo['id']){
                $current_cate = $vo;
                break;
            }
        }

        //商品信息
        $where[] = ['status','=',1];
        !empty($keyword) && $where[] = ['name','like','%'.$keyword.'%'];
        !empty($cid) && $where[] = ['cid','=',$cid];
        !empty($pid) && $where[] = ['pid','=',$pid];
        $list = \app\common\model\Product::where($where)->order('sort asc')->paginate(6);
        return view('index',[
            'list' => $list,
            'page'=>$list->render(),
            'cate' => $cate,
            'current_cate' => $current_cate,
            'brand' => $brand,
            'cid' => $cid,
            'pid' => $pid,
            'keyword' => $keyword,
            'current_brand' => $current_brand,
        ]);
    }

    //产品详情
    public function detail()
    {
        $id = $this->request->param('id',0,'intval');
        $model = \app\common\model\Product::where(['status'=>1,'id'=>$id])->find();
        //分类信息
        $cate = \app\common\model\Navigation::with(['linkChild'=>function($query){
            return $query->where(['status'=>1]);
        }])->where([['pid','=',0],['status','=',1],['url','=','product/index']])->find();
        //dump($cate);die;
        //当前分类
        $current_cate = null;
        foreach ($cate['link_child'] as $vo){
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
