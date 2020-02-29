<?php

namespace App\Http\Controllers\Index;

use App\Goods;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\CateModel;

class IndexController extends Controller
{
    //前台首页
    public function index(){

        $where = [
            ['p_id', 0]
        ];

        $cateInfo = CateModel::where($where)->get();

        $goodsInfo = Goods::all();

        return view('index.index', ['cateInfo'=>$cateInfo,'goodsInfo'=>$goodsInfo]);
    }
}
