<?php

namespace App\Http\Controllers;

use App\Picture;
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
        $file = $_FILES['file'];
//        return $file;
//        return $file;
        $destinationPath = 'storage/uploads/'; //public 文件夹下面建 storage/uploads 文件夹
        $fileName = str_random(10).$file['name'];
        $filePath = $destinationPath.$fileName;
//        return asset($filePath);
        if (move_uploaded_file($file['tmp_name'], $filePath)) {
            $picture = new Picture;
            $picture->user_id = Auth::id();
            $picture->local = asset($filePath);
            if($picture->save()){
                $res['err_code'] = 0;
                $res['data'] = array();
                $res['data']['local'] = asset($filePath);
                $res['data']['id'] = $picture->id;
            }else{
                $res['err_code'] = 2;
                $res['msg'] = '图片数据插入失败！';
            }
        }else {
            $res['err_code'] = -1;
            $res['msg'] = '图片上传失败！';
        }
        return json_encode($res);
    }

    public function delPicById($id){
        if(Picture::destroy($id)){
            return true;
        }else{
            return false;
        }
    }
}
