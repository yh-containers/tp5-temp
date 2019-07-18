<?php
namespace app\admin\controller;

class menu extends Common
{
    public function index()
    {
        $list = \app\common\model\Navigation::with('linkChild')->where(['pid'=>0])->order('sort asc')->select();
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
            if(empty($php_input['password']) && isset($php_input['password'])) unset($php_input['password']);

            $validate = new \app\common\validate\Navigation();
            return $model->actionAdd($php_input,$validate);
        }

        $nav = \app\common\model\Navigation::where(['pid'=>0])->order('sort asc')->select();
        return view('add',[
            'model'=>null,
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
