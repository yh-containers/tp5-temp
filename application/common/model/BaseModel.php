<?php
namespace app\common\model;

use think\Model;
use think\Validate;

class BaseModel extends Model
{
    public static $fields_status = ['--','正常','关闭'];
    //状态
    public static function getPropInfo($propOrFunc,$key=null,$field=null)
    {
        $class = get_called_class();
        if(method_exists($class,$propOrFunc)){
            $data = $class::$propOrFunc();
        }elseif(property_exists($class,$propOrFunc)){
            $data = $class::$$propOrFunc;
        }else{
            return false;
        }

        if(is_null($key)){
            return is_null($field)?$data:'';
        }else{
            $info = isset($data[$key])?$data[$key]:[];
            return is_null($field)?$info:(isset($info[$field])?$info[$field]:'');
        }
    }
    /*
     * 数据保存/更新
     * */
    public function actionAdd($data,Validate $validate=null)
    {
        if ($validate && !$validate->check($data)) {
            return ['code'=>0,'msg'=>$validate->getError()];
        }
        $model = $this;
        $pk = $this->getPk();
        if(!empty($data[$pk])){  //编辑状态
            $model = $this->find($data[$pk]);
        }else{
            //清除主键影响
            unset($data[$pk]);
        }
        try{
            $model && $model->save($data);
            return ['code'=>1,'msg'=>'操作成功'];
        }catch (\Exception $e) {
            return ['code'=>0,'msg'=>'操作异常'.$e->getMessage()];
        }


    }

    /*
     * 数据删除
     * */
    public function actionDel(array $where=[])
    {
        try{
            !count($where) && exception('条件异常');
            $model = $this->where($where)->find();
            $model && $model->delete();
            return ['code'=>1,'msg'=>'删除成功'];
        }catch (\Exception $e) {
            return ['code'=>0,'msg'=>'删除异常:'.$e->getMessage()];
        }

    }

    //验证文件是否是图片
    public static function checkImg($file)
    {
        if(empty($file)){
            return null;
        }
        return preg_match('/.*(\.png|\.jpg|\.jpeg|\.gif)$/', $file);

    }
}