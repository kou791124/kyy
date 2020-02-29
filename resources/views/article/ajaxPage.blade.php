
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

