<?php
namespace app\admin\controller;

use \app\common\model\SysManager;
use think\Request;

class Index extends Common
{
    protected $need_login = true;
    protected $ignore_action=['Index','login'];

    public function index()
    {
        //获取当前用户id写入session
        $id = Session('user_id');
        $data = SysManager::find($id);

        return view('index',[
            'data'=>$data
        ]);
    }

    //用户登录
    public function login(Request $request)
    {
        if ($request->isPost()){
            $data[] = input('post.');
            $account = input('account');
            $password = input('password');
            $verify = input('verify');

            if (!captcha_check($verify)) {
                return $this->error('验证码错误');
            };
            if ($account == '') {
                $this->error('用户名不能为空');
                exit;
            }
            if ($password == '') {
                $this->error('密码不能为空');
                exit;
            }
            $model = SysManager::where('account',$account)->find();
            if (!$model) $this->error('请检查账号是否正确');
            $status = $model['status'];
            if ($status!=1) $this->error('该账号已停用');
            //判断密码是否正确
//            $id = SysManager::where('account',$account)->value('id');
            if(SysManager::entryPwd($password,$model['salt'])===$model->password){
                session('user_id',$model['id']);
                session('user_name',$model['name']);
                //最后一次登陆时间
                $model->last_time = time();
                //登陆ip
                $model->last_login_ip = $this->request->ip();
                //登陆次数
                $model->login_times = $model->login_times+1;
                $model->save();
                $this->success('登录成功','product/index');
            }
            $this->error('请检查密码是否正确');
        }

        return view('login',[

        ]);

    }

    //退出登录
    public function logout()
    {
        session(null);
        $this->success("退出成功", "index/login");
    }

}
