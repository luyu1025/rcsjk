<?php

namespace App\Http\Controllers;

use App\User;
use Gregwar\Captcha\CaptchaBuilder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Session;

class ApiController extends Controller
{
    public function getUserInfo(){
        $id = Auth::id();
        $user = User::find($id);
        dd($user);
    }
    //上传图片
    public function uploadImg(Request $request){
        $file = $_FILES;
//        return $file;
        $destinationPath = 'storage/uploads/'; //public 文件夹下面建 storage/uploads 文件夹
        $fileName = str_random(10).$file['file']['name'];
        $filePath = asset($destinationPath.$fileName);
        $info=DB::insert('insert into pictures (user_id,local) VALUES (?,?)',[Auth::id(),$filePath]);
        if($info){
            $res['err_code'] = 0;
            $res['data'] = $filePath;
        }else{
            $res['err_code'] = 2;
            $res['msg'] = '图片数据插入失败！';
        }
        return json_encode($res);
    }
}
