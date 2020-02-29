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
<center><h1>修改学生信息</h1></center>
<hr/>
@if($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach($errors->all() as $error)
                <li>{{$error}}</li>
            @endforeach
        </ul>
    </div>
@endif
<form class="form-horizontal" role="form" action="{{url('/student/update/'.$data->s_id)}}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="form-group">
        <label for="firstname" class="col-sm-2 control-label">姓名</label>
        <div class="col-sm-8">
            <input type="text" class="form-control" id="firstname" name="s_name" value="{{$data->s_name}}">
        </div>
    </div>
    <div class="form-group">
        <label for="firstname" class="col-sm-2 control-label">性别</label>
        <div class="col-sm-8">
            <input type="radio" name="sex" value="1" @if($data->sex == 1) checked @endif>男
            <input type="radio" name="sex" value="2" @if($data->sex == 2) checked @endif>女
        </div>
    </div>
    <div class="form-group">
        <label for="lastname" class="col-sm-2 control-label">所在班级</label>
        <div class="col-sm-8">
            <select name="" class="form-control" id="lastname">
                <option value="">--请选择班级--</option>
                @foreach($class as $k=>$v)
                <option value="@if($v->c_id == 1) selected @endif">{{$v->c_name}}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="form-group">
        <label for="firstname" class="col-sm-2 control-label">成绩</label>
        <div class="col-sm-8">
            <input type="text" class="form-control" id="firstname" name="grade" value="{{$data->grade}}">
        </div>
    </div>
    <div class="form-group">
        <label for="firstname" class="col-sm-2 control-label">头像</label>
        <div class="col-sm-8">
            <input type="file" class="form-control" id="firstname" name="myfile" value="{{$data->myfile}}">
            @if($data->myfile)<img src="{{env('UPLOAD_URL')}}{{$data->myfile}}" alt="" width="200" height="200">@endif
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <button type="submit" class="btn btn-default">修改</button>
        </div>
    </div>
</form>

</body>
</html>
