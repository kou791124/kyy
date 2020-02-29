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
<center><h1>添加文章</h1></center>
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
<form class="form-horizontal" role="form" action="{{url('/article/update/'.$info->a_id)}}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="form-group">
        <label for="firstname" class="col-sm-2 control-label">文章标题</label>
        <div class="col-sm-8">
            <input type="text" class="form-control" placeholder="请输入标题" name="a_name" id="a_name" value="{{$info->a_name}}">
            <span style="color: red"></span>
        </div>
    </div>
    <div class="form-group">
        <label for="firstname" class="col-sm-2 control-label">文章分类</label>
        <div class="col-sm-8">
            <select name="c_id" id="">
                <option value="">--请选择--</option>
                @foreach ($cateInfo as $k=>$v)
                    <option value="@if($v->cate_id == 1) selected @endif">{{$v->cate_name}}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="form-group">
        <label for="firstname" class="col-sm-2 control-label">文章重要性</label>
        <div class="col-sm-8">
            <input type="radio" name="a_sig" value="1">普通
            <input type="radio" name="a_sig" value="2">置顶
        </div>
    </div>
    <div class="form-group">
        <label for="firstname" class="col-sm-2 control-label">是否显示</label>
        <div class="col-sm-8">
            <input type="radio" name="a_show" value="1" @if($info->a_show == 1) checked @endif>显示
            <input type="radio" name="a_show" value="2" @if($info->a_show == 2) checked @endif>不显示
        </div>
    </div>
    <div class="form-group">
        <label for="firstname" class="col-sm-2 control-label">文章作者</label>
        <div class="col-sm-8">
            <input type="text" class="form-control" name="a_people" id="a_people" value="{{$info->a_people}}">
            <span style="color: red"></span>
        </div>
    </div>
    <div class="form-group">
        <label for="firstname" class="col-sm-2 control-label">作者email</label>
        <div class="col-sm-8">
            <input type="text" class="form-control" id="firstname"
                   name="a_email" value="{{$info->a_email}}">
        </div>
    </div>
    <div class="form-group">
        <label for="firstname" class="col-sm-2 control-label">关键字</label>
        <div class="col-sm-8">
            <input type="text" class="form-control" id="firstname"
                   name="a_key" value="{{$info->a_key}}">
        </div>
    </div>
    <div class="form-group">
        <label for="firstname" class="col-sm-2 control-label">网页描述</label>
        <div class="col-sm-8">
            <textarea name="a_desc" id="" cols="30" rows="10">{{$info->a_desc}}</textarea>
        </div>
    </div>

    <div class="form-group">
        <label for="firstname" class="col-sm-2 control-label">上传文件</label>
        <div class="col-sm-8">
            <input type="file" class="form-control" id="firstname" name="a_file" value="{{$info->a_file}}">
            @if($info->a_file)<img src="{{env('UPLOAD_URL')}}{{$info->a_file}}" alt="" width="200" height="200">@endif
        </div>
    </div>

    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <button type="button" class="btn btn-default">修改</button>
        </div>
    </div>
</form>

</body>
</html>

<script>
    $(function () {
        var a_id = {{$info->a_id}}

        $.ajaxSetup({headers:{'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')}});

        $(document).on('click', 'button[type="button"]', function () {

            var titlefalg = true;

            $('input[name="a_name"]').next().html('');

            var a_name = $('input[name="a_name"]').val()

            var reg = /^[\u4e00-\u9fa50-9A-Za-z_]+$/;

            if(!reg.test(a_name)) {
                $('input[name="a_name"]').next().html('文章只支持2到8位中文数字字母下划线');
                return;
            }

            $.ajax({
                type:'post',
                url:"/article/uniqueness",
                data:{a_name:a_name,a_id:a_id},
                async:false,
                dataType:'json',
                success:function (result) {
                    if(result.count > 0){
                        $('input[name="a_name"]').next().html('标题已存在');
                        titlefalg = false;
                    }
                }
            })
            if(!titlefalg){
                return;
            }
            var a_people = $('input[name="a_people"]').val()

            var reg = /^[\u4e00-\u9fa50-9A-Za-z_]{2,8}$/;

            if(!reg.test(a_people)) {
                $('input[name="a_people"]').next().html('文章作者只支持2到8位中文数字字母下划线');
                return;
            }
            $('form').submit();
        })

        $(document).on('blur', 'input[name="a_people"]', function () {

            $(this).next().html('');

            var a_people = $(this).val()

            var reg = /^[\u4e00-\u9fa50-9A-Za-z_]{2,8}$/;

            if(!reg.test(a_people)) {
                $(this).next().html('文章作者只支持2到8位中文数字字母下划线');
                return;
            }
        })


        $(document).on('blur', 'input[name="a_name"]', function () {

            $(this).next().html('')

            var a_name = $(this).val()

            var reg = /^[\u4e00-\u9fa50-9A-Za-z_]+$/;

            if(!reg.test(a_name)){
                $(this).next().html('文章只支持2到8位中文数字字母下划线');
                return;
            }

            $.ajax({
                type:'post',
                url:"/article/uniqueness",
                data:{a_name:a_name,a_id:a_id},
                dataType:'json',
                success:function (result) {
                    if(result.count > 0){
                        $('input[name="a_name"]').next().html('标题已存在');
                    }
                }
            })

        })
    })
</script>
