<!DOCTYPE html>
<html>
<head>
		<meta charset="utf-8">
	<title></title>
    <link rel="stylesheet" href="/static/css/bootstrap.min.css">
    <script src="/static/js/jquery.min.js"></script>
    <script src="/static/js/bootstrap.min.js"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
<center><h1>分类添加</h1></center>
<!-- @if ($errors->any())
  <div class="alert alert-danger">
    <ul>
       @foreach ($errors->all() as $error)
     <li>{{ $error }}</li>
       @endforeach
     </ul>
   </div>
    @endif  -->
	<form class="form-horizontal" role="form"action="{{url('/cate/store')}}" method="post" enctype="multipart/form-data">
  <div class="form-group" >
  	@csrf
    <label for="firstname" class="col-sm-2 control-label">分类名称</label>
    <div class="col-sm-10">
      <input type="text" class="form-control"  name="cate_name" placeholder="请输入名字">
      <b style="color:red">{{$errors->first('cate_name')}}</b>
    </div>
  </div>
  <div class="form-group">
    <label for="lastname" class="col-sm-2 control-label">父极分类</label>

    <div class="col-sm-10">
        <select name="p_id" class="form-control">
            <option value="0">请选择父级分类</option>
            @foreach($data as $v)
            <option value="{{$v->cate_id}}">{{str_repeat('|--',$v->level)}}{{$v->cate_name}}</option>
            @endforeach
        </select>
    </div>
   <div class="form-group">
    <label for="lastname" class="col-sm-2 control-label">分类描述</label>
    <div class="col-sm-10">
        <textarea name="cate_desc" id="" cols="30" rows="10" class="form-control"></textarea>
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <button type="button" class="btn btn-default">添加</button>
    </div>
  </div>
</form>
</body>
</html>
<script>
    $(function () {
        $.ajaxSetup({headers:{'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')}});

        $(document).on('click', 'button[type="button"]', function () {

            var titlefalg = true;

            $('input[name="cate_name"]').next().html('');

            var cate_name = $('input[name="cate_name"]').val()

            var reg = /^[\u4e00-\u9fa50-9A-Za-z_]+$/;

            if(!reg.test(cate_name)) {
                $('input[name="cate_name"]').next().html('分类名称只中文数字字母下划线');
                return;
            }

            $.ajax({
                type:'post',
                url:"/article/checkOnly",
                data:{cate_name:cate_name},
                async:false,
                dataType:'json',
                success:function (result) {
                    if(result.count > 0){
                        $('input[name="cate_name"]').next().html('分类名称已存在');
                        titlefalg = false;
                    }
                }
            })
            if(!titlefalg){
                return;
            }
            $('form').submit();
        })

        $(document).on('blur', 'input[name="cate_name"]', function () {

            $(this).next().html('')

            var cate_name = $(this).val()

            var reg = /^[\u4e00-\u9fa50-9A-Za-z_]+$/;

            if(!reg.test(cate_name)){
                $(this).next().html('分类名称只中文数字字母下划线');
                return;
            }

            $.ajax({
                type:'post',
                url:"/article/checkOnly",
                data:{cate_name:cate_name},
                dataType:'json',
                success:function (result) {
                    if(result.count > 0){
                        $('input[name="cate_name"]').next().html('分类名称已存在');
                    }
                }
            })

        })
    })
</script>
