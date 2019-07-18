<?php
namespace app\admin\controller;

class Article extends Common
{
    public function index()
    {
        $model = new \app\common\model\Article();
        $list = $model->paginate()->each(function($item){
            $item['img'] = empty($item['img'])?[]:explode(',',$item['img']);
        });

        // 获取分页显示
        $page = $list->render();
        return view('index',[
            'list' => $list,
            'page'=>$page
        ]);
    }

    //添加文章
    public function add()
    {
        $id = $this->request->param('id');
        $model = new \app\common\model\Article();

        //表单提交
        if($this->request->isAjax()){
            $php_input = $this->request->param();//获取当前请求的参数
            $validate = new \app\common\validate\Article();
            return $model->actionAdd($php_input,$validate);//调用BaseModel中封装的添加/更新操作
        }
        $model = $model->get($id);
        return view('add',[
            'model'=>$model,
        ]);
    }

    //删除文章
    public function del()
    {
        $id = $this->request->param('id',0,'int');
        $model = new \app\common\model\Article();
        return $model->actionDel(['id'=>$id]);
    }
}
