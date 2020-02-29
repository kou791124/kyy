<!DOCTYPE html>
<html>
<head>
		<meta charset="utf-8">
	<title></title>
    <link rel="stylesheet" href="/static/css/bootstrap.min.css">
    <script src="/static/js/jquery.min.js"></script>
    <script src="/static/js/bootstrap.min.js"></script>
</head>
<body>
	<center><h1>分类修改</h1></center>
<!-- @if ($errors->any())
  <div class="alert alert-danger">
    <ul>
       @foreach ($errors->all() as $error)
     <li>{{ $error }}</li>
       @endforeach
     </ul>
   </div>
    @endif  -->
	<form class="form-horizontal" role="form"action="{{url('/cate/update/'.$cateInfo->cate_id)}}" method="post" enctype="multipart/form-data">
  <div class="form-group" >
  	@csrf
    <label for="firstname" class="col-sm-2 control-label">分类名称</label>
    <div class="col-sm-10">
      <input type="text" class="form-control"  name="cate_name" value="{{$cateInfo->cate_name}}">
      <b style="color:red">{{$errors->first('cate_name')}}</b>
    </div>
  </div>
  <div class="form-group">
    <label for="lastname" class="col-sm-2 control-label">父极分类</label>

    <div class="col-sm-10">
        <select name="p_id" class="form-control">
            <option value="0">请选择父级分类</option>
            @foreach($data as $v)
            <option value="{{$v->cate_id}}">{{str_repeat('|-',$v->level)}}{{$v->cate_name}}</option>
            @endforeach
        </select>
    </div>
   <div class="form-group">
    <label for="lastname" class="col-sm-2 control-label">分类描述</label>
    <div class="col-sm-10">
        <textarea name="cate_desc" id="" cols="30" rows="10" class="form-control">{{$cateInfo->cate_desc}}</textarea>
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
