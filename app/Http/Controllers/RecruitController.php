<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RecruitController extends Controller
{
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
