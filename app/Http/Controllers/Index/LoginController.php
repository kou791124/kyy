<?php

namespace App\Http\Controllers\Index;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\UserModel;
class LoginController extends Controller
{
    //前台登录
    public function login(){

        return view('index.login');
    }

    public function loginDo(Request $request){

        $data = \request()->except('_token');

        $userInfo = UserModel::where($data)->first();

        if($userInfo){
            session(['user'=>$userInfo]);

            $request->session()->save();

            return redirect('/');
        }
        return redirect('/login');
    }
}
