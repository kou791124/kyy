<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Student;
use Validator;
use App\Classs;
use Illuminate\Validation\Rule;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *列表展示
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $s_name = \request()->s_name??'';

        $c_id = \request()->c_id??'';

        $where = [];

        if($s_name){
            $where[] = ['s_name', 'like', "%$s_name%"];
        }

        if($c_id){
            $where[] = ['class.c_id', '=', $c_id];
        }

        $pageSize = config('app.pageSize');

        $data = Student::where($where)->leftjoin('class', 'student.c_id', '=', 'class.c_id')->paginate($pageSize);

        $classInfo = Classs::all();

        return view('student.index', ['data'=>$data, 's_name'=>$s_name, 'classInfo'=>$classInfo]);
    }

    /**
     * Show the form for creating a new resource.
     *添加视图
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = Classs::all();

        return view('student.create', ['data' => $data]);
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

        $validator = Validator::make($data, [
            's_name'=>'unique:student|regex:/^[\x{4e00}-\x{9fa5}A-Za-z0-9_-]{2,12}$/u',
            'grade'=>'required|numeric|between:0,100',
            'sex'=>'required|numeric',
        ], [
            's_name.regex'=>'名称必须是中文由数字字母下划线组成且在2到12位',
            's_name.unique'=>'姓名已存在',
            's_grade.between'=>'成绩不能超过100分',
            'grade.required'=>'成绩必填',
            'sex.required'=>'请选择性别'
        ]);

        if($validator->fails()){
            return redirect('student/create')
                ->withErrors($validator)
                ->withInput();
        }

        if( $request->hasFile('myfile') ){
            $data['myfile'] = $this->upload('myfile');
        }

        $data['add_time'] = time();

        $res = Student::create($data);

        if($res){
            return redirect('/student/index');
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
        $class = Classs::get();

        $data = Student::where('s_id', $id)->first();

        return view('student.edit', ['data'=>$data, 'class'=>$class]);
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

        $validator = Validator::make($data, [
            's_name'=>[
                'regex:/^[\x{4e00}-\x{9fa5}A-Za-z0-9_-]{2,12}$/u',
                Rule::unique('student')->ignore($id, 's_id'),
                ],
            'grade'=>'required|numeric|between:0,100',
            'sex'=>'required|numeric',
        ], [
            's_name.regex'=>'名称必须是中文由数字字母下划线组成且在2到12位',
            's_name.required'=>'名称不能为空',
            's_name.unique'=>'姓名已存在',
            's_grade.between'=>'成绩不能超过100分',
            'grade.required'=>'成绩必填',
            'sex.required'=>'请选择性别'
        ]);

        if($validator->fails()){
            return redirect('student/edit/'.$id)
                ->withErrors($validator)
                ->withInput();
        }

        if( $request->hasFile('myfile') ){
            $data['myfile'] = $this->upload('myfile');
        }

        $res = Student::where('s_id', $id)->update($data);

        if( $res !== false ){
            return redirect('/student/index');
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
        $res = Student::where('s_id', $id)->delete();

        if($res){
            return redirect('/student/index');
        }
    }

    /**
     * 文件上传
     */
    public function upload($filename){

        if( request()->file($filename)->isValid() ){

            //接收值
            $photo = \request()->file($filename);

            //上传
            $store_result = $photo->store('uploads');

            return $store_result;
        }
        exit('未获取上传的文件');

    }
}
