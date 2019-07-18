<?php
namespace app\common\model;

//
class SysSetting extends BaseModel
{
    const CACHE_PREFIX = 'cache_setting_sql';
    //数据库表名
    protected $table = 'sys_setting';

    //获取内容字段
    public static function getContent($type)
    {
        $cache_name= self::getCacheName($type);
        $content = cache($cache_name);
        if(empty($content)){
            $content = self::where('type',$type)->value('content');
            //保存内容
            cache($cache_name,$content,3600);
        }
        return $content;
    }

    //获取内容字段
    public static function setContent($type,$content)
    {
        //删除缓存
        cache(self::getCacheName($type),null);
        return (new self)->save(['content'=>$content],['type'=>$type]);
    }

    //获取缓存名称
    public static function getCacheName($type)
    {
        return self::CACHE_PREFIX.$type;
    }
}