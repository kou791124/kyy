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
<center><h1>修改管理员</h1></center>
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
<form class="form-horizontal" role="form" action="{{url('/admin/update/'.$info->admin_id)}}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="form-group">
        <label for="firstname" class="col-sm-2 control-label">用户名</label>
        <div class="col-sm-8">
            <input type="text" class="form-control" name="admin_name" value="{{$info->admin_name}}">
        </div>
    </div>
    <div class="form-group">
        <label for="firstname" class="col-sm-2 control-label">密码</label>
        <div class="col-sm-8">
            <input type="password" class="form-control" name="admin_pwd">
        </div>
    </div>
    <div class="form-group">
        <label for="firstname" class="col-sm-2 control-label">确认密码</label>
        <div class="col-sm-8">
            <input type="password" class="form-control" name="confirm_pwd">
        </div>
    </div>
    <div class="form-group">
        <label for="firstname" class="col-sm-2 control-label">手机号</label>
        <div class="col-sm-8">
            <input type="tel" class="form-control" name="admin_tel" value="{{$info->admin_tel}}">
        </div>
    </div>

    <div class="form-group">
        <label for="firstname" class="col-sm-2 control-label">邮箱</label>
        <div class="col-sm-8">
            <input type="email" class="form-control" name="admin_email" value="{{$info->admin_email}}">
        </div>
    </div>

    <div class="form-group">
        <label for="firstname" class="col-sm-2 control-label">头像</label>
        <div class="col-sm-8">
            <input type="file" class="form-control" id="" name="header" value="{{$info->admin_header}}">
            @if($info->header)<img src="{{env('UPLOAD_URL')}}{{$info->header}}" alt="" height="25" width="25">@endif
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
<script>
    jquery = $;
    alert(111)
    $(function () {
        $(document).on('blur', '#s_name', function () {

        })
    })
</script>
