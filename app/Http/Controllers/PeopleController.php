<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\People;

class PeopleController extends Controller
{
    /**
     * Display a listing of the resource.
     *列表展示
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = People::get();

        return view('people.index', ['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *添加视图
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('people.create');
    }

    /**
     * Store a newly created resource in storage.
     *添加执行
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->except('_token');

        //文件上传
        if( $request->hasFile('head') ){
            $data['head'] = $this->upload('head');
        }

        $data['add_time'] = time();

        $res = People::create($data);

        dd($res);

        if($res){
            return redirect('/index');
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
     *修改视图
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = People::find($id);

        return view('people/edit', ['data'=>$data]);
    }

    /**
     * Update the specified resource in storage.
     *修改执行
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->except('_token');

        if( $request->hasFile('head') ){
            $data['head'] = $this->upload('head');
        }

        $res = People::where('p_id', $id)->update($data);

        if( $res !== false ){
            return redirect('/index');
        }
    }

    /**
     * Remove the specified resource from storage.
     *删除
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $res = People::destroy($id);

        if($res){
            return redirect('/index');
        }
    }

    /**
     * 文件上传
     */
    public function upload($filename){
        //判断上传过程是否有误
        if(request()->file($filename)->isValid()){

            //接收值
            $photo = request()->file($filename);

            //上传
            $store_result = $photo->store('uploads');

            return $store_result;
        }
        exit('未上传文件');
    }
}
