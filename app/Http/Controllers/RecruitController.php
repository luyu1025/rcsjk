<?php

namespace App\Http\Controllers;

use App\Recruit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RecruitController extends Controller
{
    public function getList(Request $request){
        if(Auth::user()['auth']>=2){
            $res = Recruit::where('type',$request->input('type'))->where('status','!=','0')->paginate($request->input('per_page'));
        }else{
            $res = Recruit::where('type',$request->input('type'))->where('status','2')->paginate($request->input('per_page'));
        }
        return $res;
    }
   public function add(){}
   public function edit(Request $request,$id){}
   public function del($id){}
   public function apply(){
       $user_id = Auth::id();
       $info = array();
       $info['uid'] = $user_id;
   }
   public function get(Request $request){

   }
   public function find(Request $request){

   }
}
