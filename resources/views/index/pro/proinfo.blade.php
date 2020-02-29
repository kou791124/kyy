@extends('layouts.shop')

@section('title', '全部商品')

@section('content')
    <meta name="csrf-token" content="{{ csrf_token() }}">
     <header>
      <a href="javascript:history.back(-1)" class="back-off fl"><span class="glyphicon glyphicon-menu-left"></span></a>
      <div class="head-mid">
       <h1>产品详情</h1>
      </div>
     </header>
     <div id="sliderA" class="slider">
      @if($goodsInfo->goods_img)<img src="{{env('UPLOAD_URL')}}{{$goodsInfo->goods_img}}" />@endif
      @if($goodsInfo->goods_img)<img src="{{env('UPLOAD_URL')}}{{$goodsInfo->goods_img}}" />@endif
      @if($goodsInfo->goods_img)<img src="{{env('UPLOAD_URL')}}{{$goodsInfo->goods_img}}" />@endif
     </div><!--sliderA/-->
     <table class="jia-len">
      <tr>
       <th><strong class="orange">￥{{$goodsInfo->goods_price}}</strong></th>
       <td>
        <input type="text" class="spinnerExample" />
       </td>
      </tr>
      <tr>
       <td>
        <strong>{{$goodsInfo->goods_name}}</strong>
        <p class="hui">{{$goodsInfo->goods_desc}}</p>
       </td>
       <td align="right">
        <a href="javascript:;" class="shoucang"><span class="glyphicon glyphicon-star-empty"></span></a>
       </td>
      </tr>
     </table>
     <div class="height2"></div>
     <div class="zhaieq">
      <a href="javascript:;" class="zhaiCur">商品简介</a>
      <a href="javascript:;">商品参数</a>
      <a href="javascript:;" style="background:none;">订购列表</a>
      <div class="clearfix"></div>
     </div><!--zhaieq/-->
     <div class="proinfoList">
      @if($goodsInfo->goods_img)<img src="{{env('UPLOAD_URL')}}{{$goodsInfo->goods_img}}" width="636" height="822" />@endif
     </div><!--proinfoList/-->
     <div class="proinfoList">
      暂无信息....
     </div><!--proinfoList/-->
     <div class="proinfoList">
      暂无信息......
     </div><!--proinfoList/-->
     <table class="jrgwc">
         <tr><td>
                 浏览量{{$count}}
             </td></tr>
      <tr>
       <th>
        <a href="{{url('/')}}"><span class="glyphicon glyphicon-home"></span></a>
       </th>

       <td><a href="javascript:;" id="cart">加入购物车</a></td>
      </tr>
     </table>
    </div><!--maincont-->

     <!--jq加减-->
    <script src="/static/index/js/jquery.spinner.js"></script>
   <script>
	$('.spinnerExample').spinner({});
	</script>
     <script>
         $.ajaxSetup({headers:{'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')}});

         $(document).on('click', '#cart', function(){

             if($('input[class="spinnerExample value passive"]').val() == 0){
                 alert('请选择购买数量');
                 return;
             }

             var buy_number = $('input[class="spinnerExample value"]').val();

             var goods_id = "{{$goodsInfo->goods_id}}";

             $.post(
                 "/cart",
                 {buy_number:buy_number,goods_id:goods_id},
                 'json',
                 function (res) {
                     alert(res.msg);

                 }
             )
         })
     </script>

@endsection
