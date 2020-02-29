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
    <center><h1>管理员列表</h1></center>
    <hr />
    <table class="table">
        <thead>
        <tr>
            <th>ID</th>
            <th>用户名</th>
            <th>手机号</th>
            <th>邮箱</th>
            <th>头像</th>
            <th>添加时间</th>
            <th>操作</th>
        </tr>
        </thead>
        <tbody>
        @foreach($adminInfo as $k=>$v)
        <tr>
            <td>{{$v->admin_id}}</td>
            <td>{{$v->admin_name}}</td>
            <td>{{$v->admin_tel}}</td>
            <td>{{$v->admin_email}}</td>
            <td>@if($v->header)<img src="{{env('UPLOAD_URL')}}{{$v->header}}" alt="" height="25" width="25">@endif</td>
            <td>{{date('Y-m-d H:i:s', $v->add_time)}}</td>
            <td><a href="{{url('/admin/edit/'.$v->admin_id)}}">编辑</a> |
                <a href="{{url('/admin/destroy/'.$v->admin_id)}}">删除</a></td>
        </tr>
        @endforeach
        </tbody>
        <tr><td colspan="8">{{$adminInfo->appends(['adminInfo'=>$adminInfo])->links()}}</td></tr>
    </table>
</body>
</html>

