<?php

namespace App\Http\Controllers\Index;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Goods;
use Illuminate\Support\Facades\Redis;

class ProductController extends Controller
{
    //商品列表
    public function list(){

       $goodsInfo = Goods::all();

        return view('index.pro.prolist', ['goodsInfo'=>$goodsInfo]);
    }

    //商品详情
    public function proinfo($id){

        $count = Redis::setnx('num'.$id, 1);
        if( !$count ){
            $count = Redis::incr('num'.$id);
        }

        $goodsInfo = Goods::where('goods_id', $id)->first();

        return view('index.pro.proinfo', ['goodsInfo'=>$goodsInfo, 'count'=>$count]);
    }
}
