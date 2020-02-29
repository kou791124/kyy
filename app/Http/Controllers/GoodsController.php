<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Goods;
use App\Brand;
use App\CateModel;
use Validator;
class GoodsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $goods_name = \request()->goods_name??'';

        $cate_id = \request()->cate_id??'';

        $b_id = \request()->b_id??'';

        $where = [];

        if($goods_name){
            $where[] = ['goods_name', 'like', "%$goods_name%"];
        }

        if($cate_id){
            $where[] = ['category.cate_id', $cate_id];
        }

        if($b_id){
            $where[] = ['brand.b_id', $b_id];
        }

        $pageSize = config('app.pageSize');

        $data = goods::where($where)
                        ->leftjoin('brand', 'goods.b_id', '=', 'brand.b_id')
                        ->leftjoin('category', 'goods.cate_id', '=', 'category.cate_id')
                        ->orderby('goods_id', 'desc')
                        ->paginate($pageSize);

        $cateInfo = CateModel::all();

        $brandInfo = Brand::all();

        return view('goods.index', ['data'=>$data,
                                         'cateInfo'=>$cateInfo,
                                         'brandInfo'=>$brandInfo,
                                         'goods_name'=>$goods_name
                                        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $brandInfo = Brand::all();

        $cateInfo = CateModel::all();

        $cateInfo = createTree($cateInfo);

        return view('/goods/create', ['brandInfo'=>$brandInfo, 'cateInfo'=>$cateInfo]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->except('_token');

        if( $request->hasFile('goods_img') ){
            $data['goods_img'] = upload('goods_img');
        }

        if($data['goods_imgs']){
            $photo = Moreuploads('goods_imgs');
            $data['goods_imgs'] = implode('|', $photo);
        }

        $data['add_time'] = time();

        $res = Goods::create($data);

        if($res){
            return redirect('/goods/index');
        }
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
        $res = Goods::destroy($id);

        if($res){
            return redirect('/goods/index');
        }
    }

    public function checkOnly(){

        $goods_name = \request()->goods_name??'';

        $count = Goods::where(['goods_name'=>$goods_name])->count();

        echo json_encode(['code'=>'00000', 'msg'=>'ok', 'count'=>$count]);
    }
}
