<?php

namespace App\Http\Controllers;

use App\Menu;
use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
//        Auth::logout();
//        if(Auth::check()||Auth::user()['auth']!='0'){
        if(Auth::check()&&Auth::user()['auth']!='0'){
            return view('admin');
        }else{
            return redirect('/admin/login');
        }
    }
    public function login(){

        if(Auth::check()&&Auth::user()['auth']!='0'){
            return redirect('/admin');
        }else{
            return view('login');
        }
    }

    public function admin_login(Request $request){

    }
    public function reg(){
        
        $res = array();
        if(Auth::check()){
            if((int)Auth::user()['auth']==0){
                $res['err_code'] = -3;
                $res['msg'] = '权限不足，请联系管理员！';
            }else{
                $res['err_code'] = 0;
                $res['msg'] = '验证成功！';
            }
        }else{
            $res['err_code'] = -2;
            $res['msg'] = '账号未登录！';
        }
        return json_encode($res);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    //获取用户基本信息
    public function getMine(){
        $info = array();
        if(Auth::check()){
            $all = Auth::user();
            $info['err_code'] = 0;
            $info['data'] = $all;
        }else{
            $info['err_code'] = -2;
            $info['msg'] = '未登录';
        }
        return json_encode($info);

    }

    //获取侧栏菜单
    public function getMenu(){
        $menu = Menu::all();
        $res = array();
        $res['data'] = $menu;
        $res['err_code'] = 0;
        return json_encode($res);
    }
    //获取文章列表
    public function getPosts(Request $request){
        $res = Post::paginate($request->input('per_page'));
        return $res;
    }
    // 添加文章
    public function addPost(Request $request){
        $user = Auth::user();
        $req = $request->all();
        if(!$req['title']){
            $res['err_code'] = -1;
            $res['msg'] = '标题不能为空！';
        }elseif (!$req['abs']){
            $res['err_code'] = -1;
            $res['msg'] = '描述不能为空！';
        }elseif (!$img){
            $res['err_code'] = -1;
            $res['msg'] = '未上传图片！';
        }else{
            $post = new Post;
            $post->title = $req['title'];
            $post->content = $req['content'];
            $post->user_id = $user['id'];
            $post->abs = $req['abs'];
            $post->img = $req['img'];
            $post->user = $user['name'];
            if($post->save()){
                $res['err_code'] = 0;
                $res['msg'] = '添加成功';
            }else{
                $res['err_code'] = -1;
                $res['msg'] = '添加失败';
            }
        }
        return json_encode($res);

    }

    //删除文章
    public function delPost(Request $request){
        $id = $request->input('id');
        if(Auth::user()['auth']||(Post::find($id)['user_id']==Auth::id())){
            if(Post::destroy($id)){
                $res['err_code'] = 0;
            }else{
                $res['err_code'] = -1;
                $res['msg'] = '删除失败！';
            }
        } else{
            $res['err_code'] = -3;
            $res['msg'] = '权限不足';
        }
        return json_encode($res);
    }
    //测试用函数
    public function test(){
        Auth::logout();
        return dd(Auth::check());
    }
}
