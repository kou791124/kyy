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
<center><h1>添加商品</h1></center>
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
<form class="form-horizontal" role="form" action="{{url('/goods/store')}}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="form-group">
        <label for="firstname" class="col-sm-2 control-label">商品名称</label>
        <div class="col-sm-8">
            <input type="text" class="form-control" id="firstname" name="goods_name">
            <span style="color: red"></span>
        </div>
    </div>
    <div class="form-group">
        <label for="firstname" class="col-sm-2 control-label">货号</label>
        <div class="col-sm-8">
            <input type="text" class="form-control" id="firstname" name="goods_no">
            <span style="color: red"></span>
        </div>
    </div>
    <div class="form-group">
        <label for="firstname" class="col-sm-2 control-label">商品价格</label>
        <div class="col-sm-8">
            <input type="number" class="form-control" id="firstname" name="goods_price">
            <span style="color: red"></span>
        </div>
    </div>
    <div class="form-group">
        <label for="firstname" class="col-sm-2 control-label">商品缩略图</label>
        <div class="col-sm-8">
            <input type="file" class="form-control" id="firstname" name="goods_img">
        </div>
    </div>
    <div class="form-group">
        <label for="firstname" class="col-sm-2 control-label">商品相册</label>
        <div class="col-sm-8">
            <input type="file" class="form-control" id="firstname" name="goods_imgs[]" multiple>
        </div>
    </div>
    <div class="form-group">
        <label for="firstname" class="col-sm-2 control-label">商品库存</label>
        <div class="col-sm-8">
            <input type="number" class="form-control" id="firstname" name="goods_inv">
        </div>
    </div>
    <div class="form-group">
        <label for="firstname" class="col-sm-2 control-label">是否精品</label>
        <div class="col-sm-8">
            <input type="radio" name="is_bist" value="1" checked>是
            <input type="radio" name="is_bist" value="2">否
        </div>
    </div>
    <div class="form-group">
        <label for="firstname" class="col-sm-2 control-label">是否精品</label>
        <div class="col-sm-8">
            <input type="radio" name="is_hot" value="1" checked>是
            <input type="radio" name="is_hot" value="2">否
        </div>
    </div>
    <div class="form-group">
        <label for="firstname" class="col-sm-2 control-label">所属品牌</label>
        <div class="col-sm-8">
            <select name="b_id" id="" class="col-sm-2 control-label">
                <option value="">--请选择--</option>
                @foreach($brandInfo as $v)
                <option value="{{$v->b_id}}">{{$v->b_name}}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="form-group">
        <label for="firstname" class="col-sm-2 control-label">所属分类</label>
        <div class="col-sm-8">
            <select name="cate_id" id="" class="col-sm-2 control-label">
                <option value="">--请选择--</option>
                @foreach($cateInfo as $vv)
                <option value="{{$vv->cate_id}}">{{str_repeat('|--', $vv->level)}}{{$vv->cate_name}}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="form-group">
        <label for="firstname" class="col-sm-2 control-label">商品描述</label>
        <div class="col-sm-8">
            <textarea name="goods_desc" class="form-control" id="" cols="50" rows="5"></textarea>
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
    $(function () {
        $.ajaxSetup({headers:{'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')}});

        $(document).on('click', 'button[type="button"]', function () {

            var titlefalg = true;

            $('input[name="goods_name"]').next().html('');

            var goods_name = $('input[name="goods_name"]').val()

            var reg = /^[\u4e00-\u9fa50-9A-Za-z_]+$/;

            if(!reg.test(goods_name)) {
                $('input[name="goods_name"]').next().html('名称只支持2到8位中文数字字母下划线');
                return;
            }

            $.ajax({
                type:'post',
                url:"/goods/checkOnly",
                data:{goods_name:goods_name},
                async:false,
                dataType:'json',
                success:function (result) {
                    if(result.count > 0){
                        $('input[name="goods_name"]').next().html('名称已存在');
                        titlefalg = false;
                    }
                }
            })
            if(!titlefalg){
                return;
            }

            var goods_price = $('input[name="goods_price"]').val();

            var goods_no = $('input[name="goods_no"]').val();

            if(goods_price == ''){
                $('input[name="goods_price"]').next().html('价格不能为空');
                return
            }

            if(goods_no == ''){
                $('input[name="goods_no"]').next().html('货号不能为空');
                return
            }

            $('form').submit();
        })

        $(document).on('blur', 'input[name="goods_name"]', function () {

            $(this).next().html('')

            var goods_name = $(this).val()

            var reg = /^[\u4e00-\u9fa50-9A-Za-z_]+$/;

            if(!reg.test(goods_name)){
                $(this).next().html('名称只支持2到8位中文数字字母下划线');
                return;
            }

            $.ajax({
                type:'post',
                url:"/goods/checkOnly",
                data:{goods_name:goods_name},
                dataType:'json',
                success:function (result) {
                    if(result.count > 0){
                        $('input[name="goods_name"]').next().html('名称已存在');
                    }
                }
            })

        })

        $(document).on('blur', 'input[name="goods_no"]', function () {
            var goods_no = $(this).val();

            if(goods_no == ''){
                $(this).next().html('货号不能为空');
            }

        })

        $(document).on('blur', 'input[name="goods_price"]', function () {
            var goods_price = $(this).val();

            if(goods_price == ''){
                $(this).next().html('价格不能为空');
            }
        })

    })
</script>
