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
}
