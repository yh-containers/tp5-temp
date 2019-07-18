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

    //技术支持
    public function technology()
    {
        $model = new \app\common\model\Technology();
        $list = $model->order('sort asc')->paginate();
        // 获取分页显示
        $page = $list->render();
        return view('technology',[
            'list' => $list,'page'=>$page
        ]);
    }

    //合伙人 新增/编辑
    public function technologyAdd()
    {
        $id = $this->request->param('id');
        $model = new \app\common\model\Technology();

        //表单提交
        if($this->request->isAjax()){
            $php_input = $this->request->param();
            $validate = new \app\common\validate\Technology();
            return $model->actionAdd($php_input,$validate);
        }
        $model = $model->get($id);

        return view('technologyAdd',[
            'model' => $model
        ]);

    }

    //合伙人删除数据
    public function technologyDel()
    {
        $id = $this->request->param('id',0,'int');
        $model = new \app\common\model\Technology();
        return $model->actionDel(['id'=>$id]);
    }

    //证书
    public function cert()
    {
        $model = new \app\common\model\Cert();
        $list = $model->order('sort asc')->paginate();
        // 获取分页显示
        $page = $list->render();
        return view('cert',[
            'list' => $list,'page'=>$page
        ]);
    }

    //证书 新增/编辑
    public function certAdd()
    {
        $id = $this->request->param('id');
        $model = new \app\common\model\Cert();

        //表单提交
        if($this->request->isAjax()){
            $php_input = $this->request->param();
            $validate = new \app\common\validate\Cert();
            return $model->actionAdd($php_input,$validate);
        }
        $model = $model->get($id);

        return view('certAdd',[
            'model' => $model
        ]);

    }

    //证书 删除数据
    public function certDel()
    {
        $id = $this->request->param('id',0,'int');
        $model = new \app\common\model\Cert();
        return $model->actionDel(['id'=>$id]);
    }

    //证书
    public function resource()
    {
        $model = new \app\common\model\Resource();
        $list = $model->order('sort asc')->paginate();
        // 获取分页显示
        $page = $list->render();
        return view('resource',[
            'list' => $list,'page'=>$page
        ]);
    }

    //证书 新增/编辑
    public function resourceAdd()
    {
        $id = $this->request->param('id');
        $model = new \app\common\model\Resource();

        //表单提交
        if($this->request->isAjax()){
            $php_input = $this->request->param();
            $validate = new \app\common\validate\Resource();
            return $model->actionAdd($php_input,$validate);
        }
        $model = $model->get($id);

        return view('resourceAdd',[
            'model' => $model
        ]);

    }

    //证书 删除数据
    public function resourceDel()
    {
        $id = $this->request->param('id',0,'int');
        $model = new \app\common\model\Resource();
        return $model->actionDel(['id'=>$id]);
    }

}
