@extends('layouts.shop')

@section('title', '全部商品')

@section('content')
     <header>
      <a href="javascript:history.back(-1)" class="back-off fl"><span class="glyphicon glyphicon-menu-left"></span></a>
      <div class="head-mid">
       <form action="#" method="get" class="prosearch"><input type="text" /></form>
      </div>
     </header>
     <ul class="pro-select">
      <li class="pro-selCur"><a href="javascript:;">新品</a></li>
      <li><a href="javascript:;">销量</a></li>
      <li><a href="javascript:;">价格</a></li>
     </ul><!--pro-select/-->
     <div class="prolist">
         @foreach($goodsInfo as $v)
      <dl>
       <dt><a href="{{url('/proinfo/'.$v->goods_id)}}">
               @if($v->goods_img)<img src="{{env('UPLOAD_URL')}}{{$v->goods_img}}" alt="" height="100" width="100">@endif
           </a></dt>
       <dd>
        <h3><a href="{{url('/proinfo/'.$v->goods_id)}}">{{$v->goods_name}}</a></h3>
        <div class="prolist-price"><strong>¥{{$v->goods_price}}</strong></div>
       </dd>
       <div class="clearfix"></div>
      </dl>
         @endforeach
     </div><!--prolist/-->
@endsection
