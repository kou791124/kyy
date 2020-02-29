<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Bootstrap 实例 - 水平表单</title>
    <link rel="stylesheet" href="/static/css/bootstrap.min.css">
    <script src="/static/js/jquery.min.js"></script>
    <script src="/static/js/bootstrap.min.js"></script>
</head>
<body>
    <center><h1>文章列表</h1></center>
    <hr />
    <form action="">
                <input type="text" name="a_name" value="{{$a_name}}" placeholder="请输入标题关键字">
                <input type="submit" value="搜索">
    </form>
    <hr />
    <table class="table">
        <thead>
        <tr>
            <th>ID</th>
            <th>文章标题</th>
            <th>文章分类</th>
            <th>文章重要性</th>
            <th>是否显示</th>
            <th>添加日期</th>
            <th>操作</th>
        </tr>
        </thead>
        <tbody>
        @foreach($data as $k=>$v)
        <tr a_id="{{$v->a_id}}">
            <td>{{$v->a_id}}</td>
            <td>{{$v->a_name}}</td>
            <td>{{$v->cate_name}}</td>
            <td>{{$v->a_sig == 1 ? '普通' : '置顶'}}</td>
            <td>{{$v->a_show == 1 ? '√' : '×'}}</td>
            <td>{{date('Y-m-d H:i:s', $v->add_time)}}</td>
            <td>@if($v->b_logo)<img src="{{env('UPLOAD_URL')}}{{$v->a_file}}" alt="" height="30" width="30">@endif</td>
            <td><a href="{{url('/article/edit/'.$v->a_id)}}">编辑</a> |
                <a href="javascript:void(0)" onclick="del({{$v->a_id}})">删除</a></td>
        </tr>
        @endforeach
        <tr><td colspan="7">{{$data->appends(['a_name'=>$a_name])->links()}}</td></tr>
        </tbody>
    </table>
</body>
</html>
<script>
    function del(a_id){
        if(!a_id){
            return;
        }
        if(confirm('是否删除')){
            $.get('/article/destroy/'+a_id, function (result) {
                if(result.code == '0000'){
                    location.reload();
                }
            }, 'json')
        }
    }

    $(document).on('click','.pagination a',function(){

        var url = $(this).attr('href');

        if(!url){
            return;
        }
        $.get(url, function(res){
            $('tbody').html(res);
        });

        return false;
    })
</script>


