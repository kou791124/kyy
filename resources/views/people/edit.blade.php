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
<center><h1>修改外来人员</h1></center>
<hr/>
<form class="form-horizontal" role="form" action="{{url('/update/'.$data->p_id)}}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="form-group">
        <label for="firstname" class="col-sm-2 control-label">姓名</label>
        <div class="col-sm-8">
            <input type="text" class="form-control" id="firstname" name="username" value="{{$data->username}}">
        </div>
    </div>
    <div class="form-group">
        <label for="firstname" class="col-sm-2 control-label">年龄</label>
        <div class="col-sm-8">
            <input type="text" class="form-control" id="firstname" name="age" value="{{$data->age}}">
        </div>
    </div>
    <div class="form-group">
        <label for="lastname" class="col-sm-2 control-label">身份证号</label>
        <div class="col-sm-8">
            <input type="text" class="form-control" id="lastname" name="card" value="{{$data->card}}">
        </div>
    </div>
    <div class="form-group">
        <label for="firstname" class="col-sm-2 control-label">是否来自湖北</label>
        <div class="col-sm-8">
            <input type="radio" name="is_hubei" value="1" @if($data->is_hubei == 1) checked @endif>是
            <input type="radio" name="is_hubei" value="2" @if($data->is_hubei == 2) checked @endif>否
        </div>
    </div>
    <div class="form-group">
        <label for="firstname" class="col-sm-2 control-label">照片</label>
        <div class="col-sm-8">
            <input type="file" class="form-control" id="firstname" name="head">
            @if($data->head)<img src="{{env('UPLOAD_URL')}}{{$data->head}}" alt="" width="200" height="200">@endif
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
