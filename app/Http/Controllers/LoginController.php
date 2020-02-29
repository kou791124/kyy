<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Admin;

class LoginController extends Controller
{
    public function logindo(Request $request){

        $data = $request->except('_token');

        $data['admin_pwd'] = md5($data['admin_pwd']);

        $info = Admin::where($data)->first();

        if($info){

            session(['user'=>$info]);

            $request->session()->save();

            return redirect('/article/create');
        }
        return redirect('/login')->with('msg', '用户名或密码不正确');
    }
}
