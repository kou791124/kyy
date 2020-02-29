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
    <center><h1>商品列表</h1></center>
    <hr />
    <form action="">
        <input type="text" name="goods_name" placeholder="请输入名称关键字" value="{{$goods_name}}">
        <select name="cate_id" id="" class="col-sm-2 control-label">
            <option value="">--请选择分类--</option>
            @foreach($cateInfo as $vvv)
                <option value="{{$vvv->cate_id}}">{{str_repeat('|--', $vvv->level)}}{{$vvv->cate_name}}</option>
            @endforeach
        </select>
        <select name="b_id" id="" class="col-sm-2 control-label">
            <option value="">--请选择品牌--</option>
            @foreach($brandInfo as $vvvv)
                <option value="{{$vvvv->b_id}}">{{$vvvv->b_name}}</option>
            @endforeach
        </select>
        <input type="submit" value="搜索">
    </form>
    <hr />
    <table class="table">
        <thead>
        <tr>
            <th>ID</th>
            <th>商品名称</th>
            <th>商品货号</th>
            <th>商品价格</th>
            <th>商品缩略图</th>
            <th>商品图册</th>
            <th>商品库存</th>
            <th>是否精品</th>
            <th>是否热卖</th>
            <th>所属品牌</th>
            <th>所属分类</th>
            <th>商品描述</th>
            <th>添加时间</th>
            <th>操作</th>
        </tr>
        </thead>
        <tbody>
        @foreach($data as $v)
        <tr>
            <th>{{$v->goods_id}}</th>
            <th>{{$v->goods_name}}</th>
            <th>{{$v->goods_no}}</th>
            <th>{{$v->goods_price}}</th>
            <th>@if($v->goods_img)<img src="{{env('UPLOAD_URL')}}{{$v->goods_img}}" alt="" height="25" width="25">@endif</th>
            <th>
                @if($v->goods_imgs)
                    @php $photos = explode('|', $v->goods_imgs); @endphp
                @foreach($photos as $vv)
                    <img src="{{env('UPLOAD_URL')}}{{$vv}}" height="25" width="25">
                @endforeach
                @endif
            </th>
            <th>{{$v->goods_inv}}</th>
            <th>{{$v->is_bist == 1 ? '是' : '否'}}</th>
            <th>{{$v->is_hot == 1 ? '是' : '否'}}</th>
            <th>{{$v->b_name}}</th>
            <th>{{$v->cate_name}}</th>
            <th>{{$v->goods_desc}}</th>
            <th>{{$v->add_time}}</th>
            <th><a href="{{url('/goods/edit/'.$v->goods_id)}}">编辑</a> |
                <a href="{{url('/goods/destroy/'.$v->goods_id)}}">删除</a></th>
        </tr>
        @endforeach
        <tr><td colspan="7">{{$data->appends(['data'=>$data])->links()}}</td></tr>
        </tbody>
    </table>
</body>
</html>

