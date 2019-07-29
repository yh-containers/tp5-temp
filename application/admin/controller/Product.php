<?php
namespace app\admin\controller;

class Product extends Common
{
    //产品列表
    public function index()
    {
        //获取产品分类
        $cate = \app\common\model\Navigation::with(['linkChild'=>function($query){
            return $query->where(['status'=>1]);
        }])->where([['pid','=',0],['status','=',1],['url','=','product/index']])->find();


        //获取到搜索框中的
        $keyword = $this->request->param('keyword','','trim');
        $cid = $this->request->param('cid','0','trim');

        //商品信息
        $where[] = ['status','=',1];
        !empty($keyword) && $where[] = ['name','like','%'.$keyword.'%'];
        if($cid){
            $where[] = ['cid','=',$cid];
        }

        $list = \app\common\model\Product::with(['linkCate','linkBrand'])->where($where)->order('sort asc')->paginate();
        //dump($list);die;
        // 获取分页显示
        $page = $list->render();
        return view('index',[
            'cate'=> $cate,
            'keyword'=>$keyword,
            'list' => $list,
            'page'=>$page,
            'cid' => $cid,
        ]);
    }

    // 新增/编辑
    public function add()
    {
        $id = $this->request->param('id');
        $model = new \app\common\model\Product();

        //表单提交
        if($this->request->isAjax()){
            $php_input = $this->request->param();
            //产品说明
            $intro = $this->request->param('intro');
            //标题
            $intro_name = isset($intro['name'])?$intro['name']:[];
            //内容
            $intro_content = isset($intro['content'])?$intro['content']:[];
            //类型
            $intro_ipt_type = isset($intro['ipt_type'])?$intro['ipt_type']:[];
            $intro_result = [];
            foreach ($intro_name as $key=>$vo){
                $intro_result[] = [
                    'name'=>$vo,
                    'content'=>isset($intro_content[$key])?$intro_content[$key]:'',
                    'ipt_type'=>isset($intro_ipt_type[$key])?$intro_ipt_type[$key]:'',
                ];
            }
            $php_input['intro'] = json_encode($intro_result); //产品说明数据
            $validate = new \app\common\validate\Product();
            return $model->actionAdd($php_input,$validate);
        }
        //获取数据
        $model = $model->get($id);
        //获取产品分类
        $nav = \app\common\model\Navigation::where(['label'=>2,'status'=>1])->order('sort asc')->select();
        //获取品牌分类
        $brand = \app\common\model\Brand::where('status',1)->order('sort asc')->select();
        return view('add',[
            'model' => $model,
            'nav' => $nav,
            'brand' => $brand,
        ]);
    }

    // 删除数据
    public function del()
    {
        $id = $this->request->param('id',0,'int');
        $model = new \app\common\model\Product();
        return $model->actionDel(['id'=>$id]);
    }

    //品牌列表
    public function brand()
    {
        $list = \app\common\model\Brand::with(['linkCate'])->order('sort asc')->paginate();
        // 获取分页显示
        $page = $list->render();
        return view('brand',[
            'list' => $list,'page'=>$page
        ]);
    }

    // 新增/编辑
    public function brandAdd()
    {
        $id = $this->request->param('id');
        $model = new \app\common\model\Brand();

        //表单提交
        if($this->request->isAjax()){
            //获取input框信息
            $php_input = $this->request->param();
            //获取验证信息
            $validate = new \app\common\validate\Brand();
            return $model->actionAdd($php_input,$validate);
        }
        //获取数据
        $model = $model->get($id);
        //获取产品分类
        $nav = \app\common\model\Navigation::where(['label'=>2,'status'=>1])->order('sort asc')->select();
        //dump($nav);die;
        return view('brandAdd',[
            'model' => $model,
            'nav' => $nav
        ]);
    }

    // 删除数据
    public function brandDel()
    {
        $id = $this->request->param('id',0,'int');
        $model = new \app\common\model\Brand();
        return $model->actionDel(['id'=>$id]);
    }
}
