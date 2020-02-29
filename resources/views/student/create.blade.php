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
<center><h1>添加学生信息</h1></center>
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
<form class="form-horizontal" role="form" action="{{url('/student/store')}}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="form-group">
        <label for="firstname" class="col-sm-2 control-label">学生姓名</label>
        <div class="col-sm-8">
            <input type="text" class="form-control" id="s_name"
                   placeholder="请输入姓名" name="s_name">
        </div>
    </div>
    <div class="form-group">
        <label for="firstname" class="col-sm-2 control-label">学生性别</label>
        <div class="col-sm-8">
            <input type="radio" name="sex" value="1" checked>男
            <input type="radio" name="sex" value="2">女
        </div>
    </div>
    <div class="form-group">
        <label for="lastname" class="col-sm-2 control-label">班级</label>
        <div class="col-sm-8">
            <select name="c_id" class="form-control" id="">
                <option value="">--请选择班级--</option>
                @foreach($data as $k=>$v)
                <option value="{{$v->c_id}}">{{$v->c_name}}</option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="form-group">
        <label for="firstname" class="col-sm-2 control-label">成绩</label>
        <div class="col-sm-8">
            <input type="number" class="form-control" id="grade" name="grade">
        </div>
    </div>

    <div class="form-group">
        <label for="firstname" class="col-sm-2 control-label">头像</label>
        <div class="col-sm-8">
            <input type="file" class="form-control" id="" name="myfile">
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
<script>
    jquery = $;
    alert(111)
    $(function () {
        $(document).on('blur', '#s_name', function () {

        })
    })
</script>
