<?php

namespace App\Http\Controllers;

use App\User;
use Gregwar\Captcha\CaptchaBuilder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Session;

class PostController extends Controller
{
    public function list(){
        $id = Auth::id();
        $list = DB::table('cvs')
            ->select('id')
            ->where('user_id',$id);
        echo json_encode($list);
    }

    public function edit(){
        return view('cv/edit');
    }

    public function vue(){
        return view('cv/vue');
    }

    public function createCv($info){
        $user = User::find(Auth::id());
        dd($user);
    }
    public function getRegister(){

    }
    // 短信验证码
    public function msgReg(){
        $num = '';
        for($i=0; $i<6; $i++){
            $num = $num.rand(0,9);
        }
        $res = $this->sendMessage(Input::all()['phone'],$num);
        Session::flash('msgReg',$num);
        if($res['stat']==100){

        }
        return $res;
    }
    // 验证码图片生成模块
    public function captcha(){
        //生成验证码图片的Builder对象，配置相应属性
        $builder = new CaptchaBuilder;
        //可以设置图片宽高及字体
        $builder->build($width = 250, $height = 70, $font = null);
        //获取验证码的内容
        $phrase = $builder->getPhrase();
        //把内容存入session
        Session::flash('captcha', $phrase);
        //生成图片
        header("Cache-Control: no-cache, must-revalidate");
        header('Content-Type: image/jpeg');
        $builder->output();
    }

    //发送验证短信；
    public function sendMessage($phone,$num){
//        $res = $this -> curlPost('http://api.sms.cn/sms/?ac=send&uid=luyu&pwd=3fe780bbdcab3d530a2154f93a7b2d3f&template=419209&mobile='.(int)$phone.'&content={"code":"'.$num.'"}','','GET');
        $res['stat'] = '100';
        $res['message'] = $num;
        return $res ;
    }

    public function curlPost($url,$data,$method){
        $ch = curl_init();//1.初始化
        curl_setopt($ch,CURLOPT_URL, $url);//2.请求地址
        curl_setopt($ch,CURLOPT_CUSTOMREQUEST, $method);//3.请求方式
//4.参数如下
        curl_setopt($ch,CURLOPT_SSL_VERIFYPEER, FALSE);//https
        curl_setopt($ch,CURLOPT_SSL_VERIFYHOST, FALSE);
        curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (compatible; MSIE 5.01; Windows NT 5.0)');//模拟浏览器
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_AUTOREFERER, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER,array('Accept-Encoding:gzip, deflate'));//gzip解压内容
        curl_setopt($ch, CURLOPT_ENCODING,"");
        if($method=="POST"){//5.post方式的时候添加数据
            curl_setopt($ch,CURLOPT_POSTFIELDS, $data);
        }
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $tmpInfo = curl_exec($ch);//6.执行
        if (curl_errno($ch))
        {//7.如果出错
            return curl_error($ch);
        }
        curl_close($ch);//8.关闭
        return $tmpInfo;
    }
}

