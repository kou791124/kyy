<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Bootstrap 实例 - 水平表单</title>
    <link rel="stylesheet" href="/static/css/bootstrap.min.css">
    <script src="/static/js/jquery.min.js"></script>
    <script src="/static/js/bootstrap.min.js"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
<center><h1>添加管理员</h1></center>
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
<form class="form-horizontal" role="form" action="{{url('/admin/store')}}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="form-group">
        <label for="firstname" class="col-sm-2 control-label">用户名</label>
        <div class="col-sm-8">
            <input type="text" class="form-control" name="admin_name">
            <span style="color: red"></span>
        </div>
    </div>
    <div class="form-group">
        <label for="firstname" class="col-sm-2 control-label">密码</label>
        <div class="col-sm-8">
            <input type="password" class="form-control" name="admin_pwd">
            <span style="color: red"></span>
        </div>
    </div>
    <div class="form-group">
        <label for="firstname" class="col-sm-2 control-label">确认密码</label>
        <div class="col-sm-8">
            <input type="password" class="form-control" name="confirm_pwd">
            <span style="color: red"></span>
        </div>
    </div>
    <div class="form-group">
        <label for="firstname" class="col-sm-2 control-label">手机号</label>
        <div class="col-sm-8">
            <input type="tel" class="form-control" name="admin_tel">
            <span style="color: red"></span>
        </div>
    </div>

    <div class="form-group">
        <label for="firstname" class="col-sm-2 control-label">邮箱</label>
        <div class="col-sm-8">
            <input type="email" class="form-control" name="admin_email">
        </div>
    </div>

    <div class="form-group">
        <label for="firstname" class="col-sm-2 control-label">头像</label>
        <div class="col-sm-8">
            <input type="file" class="form-control" id="" name="header">
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
    $(function(){
        $.ajaxSetup({headers:{ 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});

        $('input[name="admin_name"]').blur(function(){

            var titlefalg = true;

            $('input[name="admin_name"]').next().html('');

            var admin_name = $('input[name="admin_name"]').val();

            if(!admin_name){
                $('input[name="admin_name"]').next().html('用户名必填');
            }

            $.ajax({
                type:'post',
                url:"/admin/checkOnly",
                data: {admin_name:admin_name},
                dataType: 'json',
                success: function (result) {
                    if(result.count > 0){
                        $('input[name="admin_name"]').next().html('用户名已存在' );
                        titlefalg = false;
                    }
                }

            })
            if(!titlefalg){
                return;
            }
        });

        $('input[name="admin_pwd"]').blur(function(){

            $('input[name="admin_pwd"]').next().html('');

            var admin_pwd = $('input[name="admin_pwd"]').val();

            if(!admin_pwd){
                $('input[name="admin_pwd"]').next().html('密码必填');
            }
        });
        $('input[name="admin_tel"]').blur(function(){

            $('input[name="admin_tel"]').next().html('');

            var tel = $('input[name="admin_tel"]').val();

            if(!tel){
                $('input[name="admin_tel"]').next().html('手机号必填');
            }
        });

        $('input[name="confirm_pwd"]').blur(function(){

            var admin_pwd = $('input[name="admin_pwd"]').val();

            var confirm_pwd = $('input[name="confirm_pwd"]').val();

            if(confirm_pwd == admin_pwd){
                $('input[name="confirm_pwd"]').next().html('√');
            }else{
                $('input[name="confirm_pwd"]').next().html('两次密码不一致');
            }
        });
    })
</script>

