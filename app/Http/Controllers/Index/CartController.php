<?php


namespace App\Http\Controllers\Index;


use App\Http\Controllers\Controller;
use App\Goods;
use App\Cart;

class CartController extends Controller
{
    //加入购物车
    public function addCart(){

        $goods_id = request()->goods_id;

        $buy_number = request()->buy_number;

        $goodsInfo = Goods::where('goods_id',$goods_id)->first();

        $goods_inv = $goodsInfo['goods_inv'];

        if( !empty(session('user')) ){
            $res = $this->addCartDb($goods_id, $buy_number, $goods_inv);
        }else{
           return json_encode(['status'=>2, 'msg'=>'请登录后再加入购物车']);
        }
        if($res){
            return json_encode(['status'=>200, 'msg'=>'加入购物车成功']);
        }else{
            return json_encode(['status'=>1, 'msg'=>'加入失败']);
        }

    }

    public function addCartDb($goods_id, $buy_number, $goods_inv){

        $user_id = session('user.user_id');

        $where = [
            ['goods_id', '=', $goods_id],
            ['user_id', '=', $user_id],
            ['cart_del', '=', 1]
        ];
        $cartInfo = Cart::where($where)->first();

        if( !empty($cartInfo) ) {

            if (($buy_number + $cartInfo['buy_number']) > $goods_inv) {
                $buy_number = $goods_inv;
            } else {
                $buy_number = $buy_number + $cartInfo['buy_number'];
            }

            $cartInfo = ['buy_number' => $buy_number, 'add_time' => time()];

            $res = Cart::where($where)->update($cartInfo);
        }else{
            if ($buy_number > $goods_inv) {

                $buy_number = $goods_inv;
            }

            $arr = ['goods_id' => $goods_id, 'buy_number' => $buy_number, 'add_time' => time(), 'user_id' => $user_id];

            $res = Cart::create($arr);
        }
        return $res;
    }

    public function addCartCookie($goods_id, $buy_number, $goods_inv){

        $cartInfo = cookie('cartInfo');

        if( empty($cartInfo) ){
            $cartInfo = [];
        }

        if( array_key_exists($goods_id, $cartInfo) ){

            if( ($cartInfo[$goods_id]['buy_number']+$buy_number) >$goods_inv){
                $buy_number = $goods_inv;
            }else{
                $buy_number = $buy_number+$cartInfo[$goods_id]['buy_number'];
            }

            //累加
            $cartInfo[$goods_id]['buy_number'] = $buy_number;

            $cartInfo[$goods_id]['add_time'] = time();

        }else{

            if($buy_number > $goods_inv){
                $buy_number = $goods_inv;
            }

            //添加
            $cartInfo[$goods_id] = ['goods_id'=>$goods_id, 'buy_number'=>$buy_number, 'add_time'=>time()];
        }

        cookie('cartInfo', $cartInfo);

        return true;
    }

    //购物车列表
    public function cartList(){

        $count = Cart::where('cart_del', '=', 1)->count();

        if( !empty(session('user')) ){
            $cartInfo = $this->getDb();
        }else{
            return redirect('/login');
        }
        return view('index/cart/car', ['cartInfo'=>$cartInfo, 'count'=>$count]);
    }

    public function getDb(){

        $user_id = $user_id = session('user.user_id');

        $where = [
            ['user_id', '=', $user_id],
            ['cart_del', '=', 1]
        ];

        $cartInfo = Cart::where($where)
                            ->leftjoin('goods', 'cart.goods_id','=','goods.goods_id')
                            ->get();

        return $cartInfo;
    }

}
