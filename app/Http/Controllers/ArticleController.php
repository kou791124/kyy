<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Article;
use App\CateModel;
use Validator;
use Illuminate\Support\Facades\Redis;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $cateInfo = CateModel::all();

        $page = \request()->page??1;

        $a_name = \request()->a_name??'';

        $where = [];

        if($a_name){
            $where[] = ['a_name', 'like', "%$a_name%"];
        }

//        $data = cache('article_'.$page.'_'.$a_name);

        $data = Redis::get('article_'.$page.'_'.$a_name);

        if(!$data) {
            echo 111;
            $pageSize = config('app.pageSize');

            $data = Article::where($where)->leftjoin('category', 'article.cate_id', '=', 'category.cate_id')->paginate($pageSize);

//            cache(['article_'.$page.'_'.$a_name=>$data], 60*5);
            $data = serialize($data);
            Redis::setex('article_'.$page.'_'.$a_name, 60, $data);
        }
        $data = unserialize($data);

        if( \request()->ajax() ){

            return view('article.ajaxPage', ['data' => $data, 'a_name'=>$a_name, 'cateInfo'=>$cateInfo]);
        }
        return view('article.index', ['data' => $data, 'a_name'=>$a_name, 'cateInfo'=>$cateInfo]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cateInfo = CateModel::all();

        return view('article/create', ['cateInfo'=>$cateInfo]);
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
            'a_name'=>'unique:article|required|regex:/^[\x{4e00}-\x{9fa5}A-Za-z0-9_-]{2,12}$/u',
            'cate_id'=>'required',
        ], [
            'a_name.regex'=>'标题必须是由中文数字字母下划线组成',
            'a_name.unique'=>'标题已存在',
            'a_name.required'=>'标题不能为空',
            'cate_id.required'=>'分类不能为空',
        ]);

        if($validator->fails()){
            return redirect('article/create')
                ->withErrors($validator)
                ->withInput();
        }

        if( $request->hasFile('a_file') ){
            $data['a_file'] = $this->upload('a_file');
        }

        $data['add_time'] = time();

        $res = Article::create($data);

        if($res){
            return redirect('/article/index');
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
        $cateInfo = CateModel::get();

        $info = Article::where('a_id', $id)->first();

        return view('article.edit', ['cateInfo'=>$cateInfo, 'info'=>$info]);
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

        if( $request->hasFile('a_file') ){
            $data['a_file'] = $this->upload('a_file');
        }

        $res = Article::where('a_id', $id)->update($data);

        if( $res !== false ){
            return redirect('/article/index');
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
        $res = Article::destroy($id);

        if($res){
            echo json_encode(['code'=>'00000', 'msg'=>'ok']);
        }
    }

    public function upload($filename){

        if( \request()->file($filename)->isValid() ){
            //接收值
            $photo = request()->file($filename);

            //上传
            $store_result = $photo->store('uploads');

            return $store_result;
        }
        exit('文件未上传');

    }

    public function checkOnly(){

        $a_name = \request()->a_name??'';

        $count = Article::where(['a_name'=>$a_name])->count();

        echo json_encode(['code'=>'00000', 'msg'=>'ok', 'count'=>$count]);
    }

    public function uniqueness(){

        $a_name = \request()->a_name;

        $a_id = \request()->a_id;

        $where = [];

        if($a_name){
            $where[] = ['a_name', '=', $a_name];
        }

        if($a_id){
            $where[] = ['a_id', '!=', $a_id];
        }

        $count = Article::where($where)->count();

        echo json_encode(['code'=>'00000', 'msg'=>'ok', 'count'=>$count]);
    }

}
