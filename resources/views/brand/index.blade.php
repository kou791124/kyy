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
    <center><h1>商品品牌列表</h1></center>
    <hr />
    <form action="">
        <input type="text" name="b_name" value="{{$b_name}}" placeholder="请输入名称关键字">
        <input type="submit" value="搜索">
    </form>
    <hr />
    <table class="table">
        <thead>
        <tr>
            <th>ID</th>
            <th>品牌名称</th>
            <th>品牌logo</th>
            <th>品牌网址</th>
            <th>品牌描述</th>
            <th>添加时间</th>
            <th>操作</th>
        </tr>
        </thead>
        <tbody>
        @foreach($data as $k=>$v)
        <tr>
            <td>{{$v->b_id}}</td>
            <td>{{$v->b_name}}</td>
            <td>@if($v->b_logo)<img src="{{env('UPLOAD_URL')}}{{$v->b_logo}}" alt="" height="30" width="30">@endif</td>
            <td>{{$v->b_url}}</td>
            <td>{{$v->b_desc}}</td>
            <td>{{date('Y-m-d H:i:s', $v->add_time)}}</td>
            <td><a href="{{url('/brand/edit/'.$v->b_id)}}">编辑</a> |
                <a href="{{url('/brand/destroy/'.$v->b_id)}}">删除</a></td>
        </tr>
        @endforeach
        <tr><td colspan="7">{{$data->appends(['b_name'=>$b_name])->links()}}</td></tr>
        </tbody>
    </table>
</body>
</html>

