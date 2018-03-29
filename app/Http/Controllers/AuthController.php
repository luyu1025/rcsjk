<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Support\Facades\DB;
use Input;
use Gregwar\Captcha\CaptchaBuilder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;

class AuthController extends Controller
{
    //判断是否登陆请求
    public function isLogin(){
        $res = Auth::check();
        return json_encode($res);
    }
    //获取用户信息
    public function getUser(){
        if(Auth::check()){
            $res['err_code'] = 0;
            $res['data'] = Auth::user();
        }else{
            $res['err_code'] = -2;
            $res['msg'] = '未登录';
        }
        return json_encode($res);
    }
    //更新用户信息
    public function updateUser(Request $request){
        $req = $request->all();
        $user = User::find($req['id']);
        $user->name = $req['name'];
        $user->sex = $req['sex'];

    }

    //登出请求
    public function logout(){
        $res = Auth::logout();
        return json_encode($res);
    }

    //普通用户登陆
    public function login(Request $request){
        $phone = $request->input('phone');
        $password = $request->input('password');
        $result =array();
        $result['get']=$request->all();
        if(Auth::attempt(['phone' => $phone, 'password' => $password])){
            $result['err_code'] = 0;
            $result['msg'] = '登陆成功！';
        }else{
            $result['err_code'] = 1;
            $result['msg'] = '账号或密码不正确！';
        }
        return json_encode($result);
    }
    //用户注册
    public function register(Request $request){
        $info = $request->all();
        $res = array();
        $exit = count(User::where('phone',$info['phone'])->get());
        if($exit){
            $res['err_code'] = 1;
            $res['msg'] = '该手机号已被注册！';
        }else{
            $user = new User;
            foreach($info as $key=>$value){
                if($key =='password'){
                    $user[$key] = bcrypt($info[$key]);
                }else{
                    $user[$key] = $info[$key];
                }
            }
            if($user->save()){
                $res['err_code'] = 0;
                $res['msg'] = 'success';
            }else{
                $res['err_code'] = 2;
                $res['msg'] = '插入错误！';
            }

        }
        return json_encode($res);
    }
    // 生产验证码图片
    public function captcha() {
        //生成验证码图片的Builder对象，配置相应属性
        $builder = new CaptchaBuilder;
        //可以设置图片宽高及字体
        $builder->build($width = 250, $height = 70, $font = null);
        //获取验证码的内容
        $phrase = $builder->getPhrase();
        //把内容存入session
        Session::flash('milkcaptcha', $phrase);
        //生成图片
        header("Cache-Control: no-cache, must-revalidate");
        header('Content-Type: image/jpeg');
        $builder->output();
    }

    //验证注册码的正确与否
    public function verifyCaptcha() {
        $userInput = request('captcha');
        if (Session::get('milkcaptcha') == $userInput) {
            //用户输入验证码正确
            return $this->outPutJson('', 200, '验证码正确！');
        } else {
            //用户输入验证码错误
            return $this->outPutJson('', 301, '验证码输入错误！');
        }
    }

    // 管理员用户登陆
    public function admin_login(Request $request){
        //验证
        $this->validate(request(),[
            'phone' =>'required|min:11',
            'password' => 'required',
        ]);
        $result = array();
        $phone = $request->input('phone');
        $password = $request->input('password');
        if(Auth::attempt(['phone' =>$phone, 'password' => $password])){
            if((int)Auth::user()['auth']>1){
                $result['err_code'] = 0;
                $result['msg'] = '登陆成功！';
            }else{
                $result['err_code'] = -3;
                $result['msg'] = '权限不足！';
                Auth::logout();
            }
        }else{
            $result['err_code'] = -1;
            $result['msg'] = '账号或密码不正确！';
        }
        return json_encode($result);
    }

    public function admin_logout(){
        Auth::logout();
        return redirect('/admin/login');
    }
}
