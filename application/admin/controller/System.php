<?php
namespace app\admin\controller;

class System extends Common
{
    public function manager()
    {
        $model = new \app\common\model\SysManager();
        return self::showNormalPage($model,'manager');
    }

    //用户登录
    public function managerAdd()
    {
        $id = $this->request->param('id');
        $model = new \app\common\model\SysManager();

        //表单提交
        if($this->request->isAjax()){
            $php_input = $this->request->param();
            if(empty($php_input['password']) && isset($php_input['password'])) unset($php_input['password']);

            $validate = new \app\common\validate\SysManager();
            return $model->actionAdd($php_input,$validate);
        }
        $model = $model->get($id);

        return view('managerAdd',[
            'model' => $model
        ]);

    }

    //删除数据
    public function managerDel()
    {
        $id = $this->request->param('id',0,'int');
        $model = new \app\common\model\SysManager();
        return $model->actionDel(['id'=>$id]);
    }

}
