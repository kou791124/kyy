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
    <center><h1>外来人员列表</h1></center>
    <hr/>
    <table class="table">
        <thead>
        <tr>
            <th>ID</th>
            <th>姓名</th>
            <th>年龄</th>
            <th>身份证号</th>
            <th>头像</th>
            <th>是否是湖北人</th>
            <th>添加时间</th>
            <th>操作</th>
        </tr>
        </thead>
        <tbody>
        @foreach($data as $k=>$v)
        <tr p_id="{{$v->p_id}}">
            <td>{{$v->p_id}}</td>
            <td>{{$v->username}}</td>
            <td>{{$v->age}}</td>
            <td>{{$v->card}}</td>
            <td>@if($v->head)<img src="{{env('UPLOAD_URL')}}{{$v->head}}" alt="" height="30" width="30">@endif</td>
            <td>{{$v->is_hubei == 1 ? '√' : '×'}}</td>
            <td>{{date('Y-m-d H:i:s', $v->add_time)}}</td>
            <td><a href="{{url('/edit/'.$v->p_id)}}">编辑</a> |
                <a href="{{url('/destroy/'.$v->p_id)}}">删除</a></td>
        </tr>
        @endforeach
        </tbody>
    </table>
</body>
</html>

