<?php
namespace app\admin\controller;

class menu extends Common
{
    public function index()
    {
        $list = \app\common\model\Navigation::with('linkChild.linkChild')->where(['pid'=>0])->order('sort asc')->select();
        // 获取分页显示
        return view('index',[
            'list' => $list,
        ]);
    }


    public function add()
    {
        $id = $this->request->param('id');
        $model = new \app\common\model\Navigation();

        //表单提交
        if($this->request->isAjax()){
            $php_input = $this->request->param();
            //文章栏目
            $php_input['is_article'] = empty($php_input['is_article'])?0:1;
            //产品栏目
            $php_input['is_product'] = empty($php_input['is_product'])?0:1;

            if(empty($php_input['password']) && isset($php_input['password'])) unset($php_input['password']);

            $validate = new \app\common\validate\Navigation();
            return $model->actionAdd($php_input,$validate);
        }
        $model = $model->get($id);
        $nav = \app\common\model\Navigation::with('linkChild')->where(['pid'=>0,'status'=>1])->order('sort asc')->select();
        return view('add',[
            'model'=>$model,
            'nav'=>$nav,
        ]);
    }

    public function del()
    {
        $id = $this->request->param('id',0,'int');
        $model = new \app\common\model\Navigation();
        return $model->actionDel(['id'=>$id]);
    }

}
