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
<center><h1>修改商品品牌</h1></center>
<hr/>
<form class="form-horizontal" role="form" action="{{url('/brand/update/'.$data->b_id)}}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="form-group">
        <label for="firstname" class="col-sm-2 control-label">品牌名称</label>
        <div class="col-sm-8">
            <input type="text" class="form-control" id="firstname" placeholder="请输入名称" name="b_name" value="{{$data->b_name}}">
        </div>
    </div>
    <div class="form-group">
        <label for="firstname" class="col-sm-2 control-label">品牌logo</label>
        <div class="col-sm-8">
            <input type="file" class="form-control" id="firstname" name="b_logo" value="{{$data->b_logo}}">
            @if($data->b_logo)<img src="{{env('UPLOAD_URL')}}{{$data->b_logo}}" alt="" width="100" height="100">@endif
        </div>
    </div>
    <div class="form-group">
        <label for="lastname" class="col-sm-2 control-label">品牌网址</label>
        <div class="input-group input-group-lg col-sm-8">
            <span class="input-group-addon">@</span>
            <input type="text" class="form-control" placeholder="请输入网址" name="b_url" value="{{$data->b_url}}">
        </div>
    </div>
    <div class="form-group">
        <label for="firstname" class="col-sm-2 control-label">品牌详情</label>
        <div class="col-sm-8">
            <textarea name="b_desc" class="form-control" id="firstname" id="" cols="30" rows="10">{{$data->b_desc}}</textarea>
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
