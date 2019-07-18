<?php
namespace app\admin\controller;

class Product extends Common
{

    //
    public function index()
    {
        $model = new \app\common\model\Product();
        $list = $model->order('sort asc')->paginate();
        // 获取分页显示
        $page = $list->render();
        return view('index',[
            'list' => $list,'page'=>$page
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
        $model = $model->get($id);

        return view('add',[
            'model' => $model
        ]);

    }

    // 删除数据
    public function del()
    {
        $id = $this->request->param('id',0,'int');
        $model = new \app\common\model\Product();
        return $model->actionDel(['id'=>$id]);
    }



}
