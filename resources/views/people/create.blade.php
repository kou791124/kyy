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
<center><h1>添加外来人员</h1></center>
<hr/>
<form class="form-horizontal" role="form" action="{{url('/store')}}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="form-group">
        <label for="firstname" class="col-sm-2 control-label">姓名</label>
        <div class="col-sm-8">
            <input type="text" class="form-control" id="firstname"
                   placeholder="请输入姓名" name="username">
        </div>
    </div>
    <div class="form-group">
        <label for="firstname" class="col-sm-2 control-label">年龄</label>
        <div class="col-sm-8">
            <input type="text" class="form-control" id="firstname"
                   placeholder="请输入年龄" name="age">
        </div>
    </div>
    <div class="form-group">
        <label for="lastname" class="col-sm-2 control-label">身份证号</label>
        <div class="col-sm-8">
            <input type="text" class="form-control" id="lastname"
                   placeholder="请输入身份证号" name="card">
        </div>
    </div>
    <div class="form-group">
        <label for="firstname" class="col-sm-2 control-label">是否来自湖北</label>
        <div class="col-sm-8">
            <input type="radio" name="is_hubei" value="1">是
            <input type="radio" name="is_hubei" value="2" checked>否
        </div>
    </div>
    <div class="form-group">
        <label for="firstname" class="col-sm-2 control-label">照片</label>
        <div class="col-sm-8">
            <input type="file" class="form-control" id="firstname" name="head">
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <button type="submit" class="btn btn-default">添加</button>
        </div>
    </div>
</form>

</body>
</html>
