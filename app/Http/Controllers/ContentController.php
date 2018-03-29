<?php

namespace App\Http\Controllers;

use App\Banner;
use App\Picture;
use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ContentController extends Controller
{
    //获取banner列表
    public function getBanners(Request $request){
        $req = $request->all();
        if(!isset($req['type'])){
            $res['err_code'] = -1;
            $res['msg'] = '未传入type';
            return json_encode($res);
        }
        $res['err_code'] = 0;
        if($req['type'] == 'all') {
            $res['data'] = Banner::orderBy('type')->get();
        }else{
            $res['data'] = Banner::where('type', $req['type'])->orderBy('level','desc')->get();
        }
        return json_encode($res);
    }
    //上传banner图片 只需上传图片文件
    public function uploadBanner(Request $request){
        $file = $_FILES['file'];
//        return $file;
//        return $file;
        $destinationPath = 'storage/banner/'; //public 文件夹下面建 storage/banner 文件夹
        $fileName = str_random(10).$file['name'];
        $filePath = $destinationPath.$fileName;
//        return asset($filePath);
        if (move_uploaded_file($file['tmp_name'], $filePath)) {
                $res['err_code'] = 0;
                $res['data'] = asset($filePath);
        }else {
            $res['err_code'] = -1;
            $res['msg'] = '图片上传失败！';
        }
        return json_encode($res);
    }
    //添加banner    传入 url,type, level
    public function addBanner(Request $request){
        $req = $request->all();
        if(Auth::user()['auth']>2){
            if(isset($req['url'])&&isset($req['type'])){
                if(isset($req['level'])){
                    $req['level'] = 0;
                }
                $banner = new Banner;
                $banner->url = $req['url'];
                $banner->type = $req['type'];
                $banner->level = $req['level'];
                if($banner->save()){
                    $res['err_code'] = -1;
                    $res['msg'] = '添加成功！';
                    $res['data'] = $banner;
                }else{
                    $res['err_code'] = -1;
                    $res['msg'] = '添加失败！';
                }
            }else{
                $res['err_code'] = -1;
                $res['msg'] = '参数不全！';
            }
        }else{
            $res['err_code'] = -3;
            $res['msg'] = '权限不足';
        }
        return json_encode($res);
    }
    //删除banner   传入id
    public function delBanner(Request $request){
        $id = $request->all()['id'];
        $banner = Banner::find($id);
        if (Auth::user()['auth']<3){
            $res['err_code'] = -3;
            $res['msg'] = '权限不足！';
            return json_encode($res);
        }
        if($this->delPng($banner['url'],'storage/banners/')){
            if($banner->delete()){
                $res['err_code'] = 0;
                $res['msg'] = '删除成功！';
            }else{
                $res['err_code'] = -1;
                $res['msg'] = '删除失败！';
            }
        }else{
            $res['err_code'] = -1;
            $res['msg'] = '删除图片失败！';
        }
        return json_encode($res);
    }
    //修改banner  传入id，type，url，level
    public function editBanner(Request $request){
        $req = $request->all();
        if(Auth::user()['auth']<3){
            if(isset($req['id'])&&isset($req['type'])&&isset($req['url'])){
                $banner = Banner::find($req['id']);
                $banner->type = $req['type'];
                if(isset($req['level'])){
                    $banner->type = $req['level'];
                }
                if($req['url']!=$banner['url']){
                    if($this->delPng($banner['url'],'storage/banners/')){
                        $banner['url'] = $req['url'];
                        if ($banner->save()){
                            $res['err_code'] = 0;
                            $res['msg'] = '成功！';
                        }else{
                            $res['err_code'] = -1;
                            $res['msg'] = '保存失败！';
                        }
                    }else{
                        $res['err_code'] = -1;
                        $res['msg'] = '删除图片失败！';
                    }
                }
            }else{
                $res['err_code'] = -1;
                $res['msg'] = '参数异常！';
            }
        }else{
            $res['err_code'] = -3;
            $res['msg'] = '权限不足';
        }
    }



    //根据type获取文章列表
    public function getPosts(Request $request){
        if(Auth::user()['auth']<3 || ($request->all()['isUser'])){
            $res = Post::where('type',$request->input('type'))->where('status','2')->paginate($request->input('per_page'));
        }else{
            $res = Post::where('type',$request->input('type'))->where('status','!=','0')->paginate($request->input('per_page'));
        }
        return $res;
    }
    // 初始化文章，判断是否有未完成编辑，传入参数为文章类型
    public function initPost(Request $request){
        $user = Auth::user();
        $req = $request->all();
        $result = Post::where(['user_id'=>$user['id'],'status'=>'0','type'=>$req['type']])->first();
        if($result!=null){
            $post = Post::find($result['id']);
            if($post['img']){
                $local = strstr($post['img'], 'storage/uploads/');
                Picture::where('local',$post['img'])->delete();
                if(unlink($local)){};
            }
            $pics = Picture::where('post_id',$result['id'])->get();
//            return json_encode($pics);
            foreach ($pics as $value){
                $tmp_local = strstr($value['local'],'storage/uploads/');
//                return json_encode($value['img']);
                if(unlink($tmp_local)){
                    Picture::destroy($value['id']);
                };
            }
            Post::destroy($result['id']);
        }
        $newPost = new Post;
        $newPost->user_id = $user['id'];
        $newPost->user = $user['name'];
        $newPost->content = '';
        $newPost->type = $req['type'];
        if($newPost->save()){
            $res['err_code'] = 0;
            $res['msg'] = '初始化成功';
            $res['data'] = $newPost;
            $res['user'] = Auth::user();
        }else{
            $res['err_code'] = -1;
            $res['msg'] = '初始化失败';
        }
        return json_encode($res);
    }


    //删除文章
    public function delPost($id){
        if(Auth::user()['auth']>=2||(Post::find($id)['user_id']==Auth::id())){
            $post = Post::find($id);
            $local = strstr($post['img'], 'storage/uploads/');
            Picture::where('local',$post['img'])->delete();
            if(unlink($local)){}
            $pics = Picture::where('post_id',$id)->get();
            foreach ($pics as $value){
                $tmp_local = strstr($value['local'],'storage/uploads/');
                if(unlink($tmp_local)){
                    Picture::destroy($value['id']);
                };
            }
            Post::destroy($id);
            if($post->delete()){
                $res['err_code'] = 0;
                $res['msg'] = '删除成功';
            }else{
                $res['err_code'] = -1;
                $res['msg'] = '删除失败';
            }
        } else{
            $res['err_code'] = -3;
            $res['msg'] = '权限不足';
        }
        return json_encode($res);
    }

    //提交修改
    public function edit(Request $request){
        $req = $request->all();
        $user = Auth::user();
        $res = array();
        $post = Post::find($req['id']);
        if($post->user_id == $user->id||$user->auth > 2 ){
            $status = 2;
            if($user->auth == 3){
                $status = 3;
            }
            $post->title = $req['title'];
            $post->content = $req['content'];
            $post->abs = $req['abs'];
            $post->status = $status;
            if($post->img != $req['img']){
                $pic = $post->img;
                $post->img = $req['img'];
            }
            if($post->save()){
                if(isset($pic)){
                    $local = strstr($pic, 'storage/uploads/');
                    Picture::where('local',$pic)->delete();
                    unlink($local);
                }
                $res['err_code'] = 0;
                $res['msg'] = '修改成功';
            }else{
                $res['err_code'] = -1;
                $res['msg'] = '修改失败';
            }
        }else{
            $res['err_code'] = -2;
            $res['msg'] = '权限不足';
        }
        return json_encode($res);
    }

    //根据id获取文章
    public function getPostById(Request $request){
        $req = $request->all();
        if($result = Post::find($req['id'])){
            $res['err_code'] = 0;
            $res['data'] = $result;
        }else{
            $res['err_code'] = -1;
            $res['msg'] ='未找到该文章';
        }
        return json_encode($res);
    }

    //上传图片(含文章id post_id)
    public function uploadImg(Request $request){
        $file = $_FILES['file'];
        $post_id = $request->all()['post_id'];
//        return $request->all()['post_id'];
//        return $file;
        $destinationPath = 'storage/uploads/'; //public 文件夹下面建 storage/uploads 文件夹
        $fileName = str_random(10).$file['name'];
        $filePath = $destinationPath.$fileName;
//        return asset($filePath);
        if (move_uploaded_file($file['tmp_name'], $filePath)) {
            $picture = new Picture;
            $picture->user_id = Auth::id();
            $picture->post_id = $post_id;
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
        } else {
            $res['err_code'] = -1;
            $res['msg'] = '图片上传失败！';
        }
        return json_encode($res);
    }

    //修改文章状态
    public function changeStatus(Request $request){
        $req = $request->all();
        $post = Post::find($req['post_id']);
        if(Auth::user()['Auth']>2){
            $res['err_code'] =-3;
            $res['msg'] = '权限不足';
        }
        else if($post->status==2){
            $post->status ='1';
        }else{
            $post->status = '2';
        }
        if($post->save()){
            $res['err_code'] =0;
        }else{
            $res['err_code'] =-1;
            $res['msg'] = '修改失败';
        }
        return json_encode($res);
    }

    //删除已上传图片
    public function delPng($url,$local){
        $tmp_local = strstr($url,$local);
        if(unlink($tmp_local)){
           return true;
        }else{
            return false;
        }
    }
}
