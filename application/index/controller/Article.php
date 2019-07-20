<?php
namespace app\index\controller;


class Article extends Common
{
    //解决方案
    public function solution()
    {
        //分类
        $cid = $this->request->param('cid');
        //分类信息
        $cate = \app\common\model\Navigation::with(['linkChild'=>function($query){
            return $query->where(['status'=>1]);
        }])->where([['pid','=',0],['status','=',1],['url','=','article/solution']])->find();
        //当前分类
        $current_cate = null;
        foreach ($cate['linkChild'] as $vo){
            if($cid==$vo['id']){
                $current_cate = $vo;
                break;
            }
        }
        //
        $cid = !empty($cid)?$cid:(isset($cate['linkChild'][0])?$cate['linkChild'][0]['id']:0);
        $where[] =['status','=',1];
        $where[] =['cid','=',$cid];
        $list = \app\common\model\Solution::where($where)->order('sort asc')->select();

        return view('solution',[
            'cate' => $cate,
            'current_cate' => $current_cate,
            'cid' => $cid,
            'list' => $list,
        ]);
    }

    public function solutionDetail()
    {
        $id = $this->request->param('id');

        $model = \app\common\model\Solution::where(['status'=>1,'id'=>$id])->find();
        //分类信息
        $cate = \app\common\model\Navigation::with(['linkChild'=>function($query){
            return $query->where(['status'=>1]);
        }])->where([['pid','=',0],['status','=',1],['url','=','article/solution']])->find();
        //当前分类
        $current_cate = null;
        foreach ($cate['linkChild'] as $vo){
            if($model['cid']==$vo['id']){
                $current_cate = $vo;
                break;
            }
        }

        //浏览次数
        !empty($model) && $model->setInc('views');
        $list = \app\common\model\Solution::where([['status','=',1],['id','neq',$id]])->limit(4)->order('sort asc')->select();
        return view('solutionDetail',[
            'model'=> $model,
            'current_cate'=> $current_cate,
            'cate'=> $cate,
            'list'=> $list,
        ]);
    }

    //
    public function cases()
    {
        //分类
        $cid = $this->request->param('cid');
        $keyword = $this->request->param('keyword','','trim');

        //分类信息
        $cate = \app\common\model\Navigation::with(['linkChild'=>function($query){
            return $query->where(['status'=>1]);
        }])->where([['pid','=',0],['status','=',1],['url','=','article/cases']])->find();
        //当前分类
        $current_cate = null;
        foreach ($cate['linkChild'] as $vo){
            if($cid==$vo['id']){
                $current_cate = $vo;
                break;
            }
        }

        //商品信息
        $where[] = ['status','=',1];
        !empty($keyword) && $where[] = ['name','like','%'.$keyword.'%'];
        !empty($cid) && $where[] = ['cid','=',$cid];
        $list = \app\common\model\Cases::where($where)->order('sort asc')->paginate(6);
        return view('cases',[
            'list' => $list,
            'page'=>$list->render(),
            'cate' => $cate,
            'current_cate' => $current_cate,
            'cid' => $cid,
            'keyword' => $keyword,
        ]);
    }

    public function casesDetail()
    {
        $id = $this->request->param('id');

        $model = \app\common\model\Cases::where(['status'=>1,'id'=>$id])->find();
        //分类信息
        $cate = \app\common\model\Navigation::with(['linkChild'=>function($query){
            return $query->where(['status'=>1]);
        }])->where([['pid','=',0],['status','=',1],['url','=','article/cases']])->find();
        //当前分类
        $current_cate = null;
        foreach ($cate['linkChild'] as $vo){
            if($model['cid']==$vo['id']){
                $current_cate = $vo;
                break;
            }
        }

        //浏览次数
        !empty($model) && $model->setInc('views');

        //上一篇
        $model_up =  \app\common\model\Cases::where([['status','=',1],['id','gt',$id]])->order('id desc')->limit(1)->find();
        //下一篇
        $model_down =\app\common\model\Cases::where([['status','=',1],['id','lt',$id]])->order('id asc')->limit(1)->find();
        return view('casesDetail',[
            'model'=> $model,
            'model_up'=> $model_up,
            'model_down'=> $model_down,
            'current_cate'=> $current_cate,
            'cate'=> $cate,
        ]);
    }
    public function aboutUs()
    {
        return $this->about();
    }

    public function about()
    {
        //分类信息
        $cate = \app\common\model\Navigation::with(['linkChild'=>function($query){
            return $query->where(['status'=>1]);
        }])->where([['pid','=',0],['status','=',1],['url','=','article/about']])->find();
        //当前分类
        $current_cate = null;
        foreach ($cate['linkChild'] as $vo){
            if('article/aboutus'==$vo['url']){
                $current_cate = $vo;
                break;
            }
        }
        return view('about',[
            'cate'=> $cate,
            'current_cate'=> $current_cate,
        ]);
    }

    public function honor()
    {
        //分类信息
        $cate = \app\common\model\Navigation::with(['linkChild'=>function($query){
            return $query->where(['status'=>1]);
        }])->where([['pid','=',0],['status','=',1],['url','=','article/about']])->find();
        //当前分类
        $current_cate = null;
        foreach ($cate['linkChild'] as $vo){
            if('article/honor'==$vo['url']){
                $current_cate = $vo;
                break;
            }
        }

        //信息
        $where[] = ['status','=',1];
        $list = \app\common\model\Cert::where($where)->order('sort asc')->paginate(9);

        return view('honor',[
            'list' => $list,
            'page'=>$list->render(),
            'cate'=> $cate,
            'current_cate'=> $current_cate,
        ]);
    }

    public function concat()
    {
        //分类信息
        $cate = \app\common\model\Navigation::with(['linkChild'=>function($query){
            return $query->where(['status'=>1]);
        }])->where([['pid','=',0],['status','=',1],['url','=','article/about']])->find();
        //当前分类
        $current_cate = null;
        foreach ($cate['linkChild'] as $vo){
            if('article/concat'==$vo['url']){
                $current_cate = $vo;
                break;
            }
        }

        return view('concat',[
            'cate'=> $cate,
            'current_cate'=> $current_cate,
        ]);
    }

    //新闻
    public function news()
    {
        //分类
        $cid = $this->request->param('cid');
        //分类信息
        $cate = \app\common\model\Navigation::with(['linkChild'=>function($query){
            return $query->with(['linkChild'=>function($q){
                return $q->where(['status'=>1]);
            }])->where(['status'=>1]);
        }])->where([['pid','=',0],['status','=',1],['url','=','article/about']])->find();
        //当前分类
        $current_cate = null;
        foreach ($cate['linkChild'] as $vo){
            if('article/news'==$vo['url']){
                $current_cate = $vo;
                break;
            }
        }

        //信息
        $where[] = ['status','=',1];
        !empty($cid) && $where[] = ['cid','=',$cid];
        $list = \app\common\model\Article::where($where)->order('show_time desc')->paginate(4);

        return view('news',[
            'list' => $list,
            'page'=>$list->render(),
            'cate'=> $cate,
            'current_cate'=> $current_cate,
            'cid'=> $cid,
        ]);
    }


    public function newsDetail()
    {
        $id = $this->request->param('id');

        $model = \app\common\model\Article::where(['status'=>1,'id'=>$id])->find();
        //分类信息
        $cate = \app\common\model\Navigation::with(['linkChild'=>function($query){
            return $query->where(['status'=>1]);
        }])->where([['pid','=',0],['status','=',1],['url','=','article/about']])->find();
        //当前分类
        $current_cate = null;
        foreach ($cate['linkChild'] as $vo){
            if('article/news'==$vo['url']){
                $current_cate = $vo;
                break;
            }
        }
        //浏览次数
        !empty($model) && $model->setInc('views');
        //上一篇
        $model_up =  \app\common\model\Article::where([['status','=',1],['id','gt',$id]])->order('id desc')->limit(1)->find();
        //下一篇
        $model_down =\app\common\model\Article::where([['status','=',1],['id','lt',$id]])->order('id asc')->limit(1)->find();
        return view('newsDetail',[
            'model'=> $model,
            'model_up'=> $model_up,
            'model_down'=> $model_down,
            'current_cate'=> $current_cate,
            'cate'=> $cate,
        ]);
    }

    //技术支持
    public function technology()
    {
        //分类信息
        $cate = \app\common\model\Navigation::with(['linkChild'=>function($query){
            return $query->where(['status'=>1]);
        }])->where([['pid','=',0],['status','=',1],['url','=','article/technology']])->find();

        //常见问题
        $problem_list = \app\common\model\Technology::where('status',1)->order('sort asc')->select();
        return view('technology',[
            'cate'=> $cate,
            'problem_list'=> $problem_list,
        ]);
    }


}
