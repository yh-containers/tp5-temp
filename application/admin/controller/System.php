<?php
namespace app\admin\controller;

class System extends Common
{
    public function manager()
    {
        $model = new \app\common\model\SysManager();
        $list = $model->paginate();
        // 获取分页显示
        $page = $list->render();
        return view('manager',[
            'list' => $list,'page'=>$page
        ]);
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


    //系统设置
    public function setting()
    {
        $normal_content = \app\common\model\SysSetting::getContent('normal');
        $normal_content = empty($normal_content)?[]:json_decode($normal_content,true);
        return view('setting',[
            'normal_content' => $normal_content
        ]);
    }

    //系统设置
    public function settingSave()
    {
        $type = $this->request->param('type');
        $content = $this->request->param('content');
        if(is_array($content)){
            if(key($content)===0){
                //数组
                $content = implode(',',$content);
            }else{
                //键值对
                $content = json_encode($content);
            }
        }
        $bool = \app\common\model\SysSetting::setContent($type, $content);
        return json(['code'=>(int)$bool,'msg'=>$bool?'操作成功':'操作失败']);
    }

    //轮播图设置
    public function flowImg()
    {
        $model = new \app\common\model\Ad();
        $list = $model->order('sort asc')->paginate();
        // 获取分页显示
        $page = $list->render();
        return view('flowImg',[
            'list' => $list,'page'=>$page
        ]);
    }

    //轮播图新增/编辑
    public function flowImgAdd()
    {
        $id = $this->request->param('id');
        $model = new \app\common\model\Ad();

        //表单提交
        if($this->request->isAjax()){
            $php_input = $this->request->param();
            $validate = new \app\common\validate\Ad();
            return $model->actionAdd($php_input,$validate);
        }
        $model = $model->get($id);

        return view('flowImgAdd',[
            'model' => $model
        ]);

    }

    //删除数据
    public function flowImgDel()
    {
        $id = $this->request->param('id',0,'int');
        $model = new \app\common\model\Ad();
        return $model->actionDel(['id'=>$id]);
    }

    //合伙人
    public function partner()
    {
        $model = new \app\common\model\Partner();
        $list = $model->order('sort asc')->paginate();
        // 获取分页显示
        $page = $list->render();
        return view('partner',[
            'list' => $list,'page'=>$page
        ]);
    }

    //合伙人 新增/编辑
    public function partnerAdd()
    {
        $id = $this->request->param('id');
        $model = new \app\common\model\Partner();

        //表单提交
        if($this->request->isAjax()){
            $php_input = $this->request->param();
            $validate = new \app\common\validate\Partner();
            return $model->actionAdd($php_input,$validate);
        }
        $model = $model->get($id);

        return view('partnerAdd',[
            'model' => $model
        ]);

    }

    //合伙人删除数据
    public function partnerDel()
    {
        $id = $this->request->param('id',0,'int');
        $model = new \app\common\model\Partner();
        return $model->actionDel(['id'=>$id]);
    }


}
