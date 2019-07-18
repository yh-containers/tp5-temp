<?php
namespace app\admin\controller;

use think\Controller;
use think\Model;

class Common extends Controller
{

    /*
     * 显示简单数据
     * */
    protected static function showNormalPage(Model $model,$view='',array $assign_data=[])
    {
        $list = $model->paginate();
        // 获取分页显示
        $page = $list->render();

        $assign_data = array_merge($assign_data,[ 'list' => $list,'page'=>$page ]);
        return view($view,$assign_data);
    }
}
