<?php

namespace App\Http\Controllers\Index;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RegController extends Controller
{
    //前台注册
    public function reg(){

        return view('index.reg');
    }

    public function regDo(){

    }
}
