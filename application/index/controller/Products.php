<?php
namespace app\index\controller;

use  app\common\model\ProductCate;
use  app\common\model\Category;
use  app\common\model\Product;
class Products extends Common
{
    //产品中心
    public function index()
    {
        return view('products',[

        ]);
    }


    //产品详情
    public function proDet()
    {
//        //获取id
//        $id = input('id',0,'intval');
//        //dump($id);die;
//        $list = ProductCate::where(['status'=>1])->order('sort asc')->select();
//        $model = Product::where('id',$id)->find();
        return view('products/products_det',[
//            'model'=>$model,
//            'list' => $list,
        ]);
    }
}