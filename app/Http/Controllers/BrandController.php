<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Brand;
use App\Http\Requests\StoreBrandPost;
use Validator;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $b_name = \request()->b_name??'';

        $where = [];

        if($b_name){
            $where[] = ['b_name', 'like', "%$b_name%"];
        }

        $pageSize = config('app.pageSize');

        $data = Brand::where($where)->orderby('b_id', 'desc')->paginate($pageSize);

        return view('brand.index', ['data' => $data, 'b_name'=>$b_name]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('brand/create');
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

        $validator = Validator::make($data, [
            'b_name'=>'required|unique:brand|max:20',
            'b_url'=>'required'
        ], [
            'b_name.required'=>'名称不能为空',
            'b_name.max'=>'名称长度不能超过20位',
            'b_name.unique'=>'名称已存在',
            'b_url.required'=>'不能为空',
        ]);

        if($validator->fails()){
            return redirect('brand/create')
                ->withErrors($validator)
                ->withInput();
        }

        if( $request->hasFile('b_logo') ){
            $data['b_logo'] = upload('b_logo');
        }

        $data['add_time'] = time();

        $res = Brand::create($data);

        if($res){
            return redirect('/brand/index');
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
        $data = Brand::find($id);

        return view('brand/edit', ['data' => $data]);
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
        $data = $request->except('_token');

        if( $request->hasFile('b_logo') ){
            $data['b_logo'] = upload('b_logo');
        }

        $res = Brand::where('b_id', $id)->update($data);

        if($res){
            return redirect('/brand/index');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $res = Brand::destroy($id);

        if($res){
            return redirect('/brand/index');
        }
    }
}
