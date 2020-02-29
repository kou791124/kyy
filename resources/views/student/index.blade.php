<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Bootstrap 实例 - 水平表单</title>
    <link rel="stylesheet" href="/static/css/bootstrap.min.css">
    <script src="/static/js/jquery/2.1.1/jquery.min.js"></script>
    <script src="/static/js/bootstrap.min.js"></script>
</head>
<body>
    <center><h1>学生列表</h1></center>
    <hr />
    <form action="">
        <input type="text" name="s_name" placeholder="请输入学生姓名关键字" value="{{$s_name}}" class="form-control">
        <select name="c_id" class="form-control" id="lastname">
            <option value="">--请选择班级--</option>
            @foreach($data as $k=>$v)
                <option value="{{$v->c_id}}">{{$v->c_name}}</option>
            @endforeach
        </select>
        <input type="submit" value="搜索" class="form-control">
    </form>
    <hr />
    <table class="table">
        <thead>
        <tr>
            <th>ID</th>
            <th>姓名</th>
            <th>性别</th>
            <th>所在班级</th>
            <th>成绩</th>
            <th>头像</th>
            <th>添加时间</th>
            <th>操作</th>
        </tr>
        </thead>
        <tbody>
        @foreach($data as $k=>$v)
        <tr>
            <td>{{$v->s_id}}</td>
            <td>{{$v->s_name}}</td>
            <td>{{$v->sex == 1 ? '男' : '女'}}</td>
            <td>{{$v->c_name}}</td>
            <td>{{$v->grade}}</td>
            <td>@if($v->myfile)<img src="{{env('UPLOAD_URL')}}{{$v->myfile}}" alt="" height="25" width="25">@endif</td>
            <td>{{date('Y-m-d H:i:s', $v->add_time)}}</td>
            <td><a href="{{url('/student/edit/'.$v->s_id)}}">编辑</a> |
                <a href="{{url('/student/destroy/'.$v->s_id)}}">删除</a></td>
        </tr>
        @endforeach
        </tbody>
        <tr><td colspan="8">{{$data->appends(['s_name'=>$s_name])->links()}}</td></tr>
    </table>
</body>
</html>

