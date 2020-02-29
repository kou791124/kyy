@extends('layouts.shop')

@section('title', '登录')

@section('content')
     <header>
      <a href="javascript:history.back(-1)" class="back-off fl"><span class="glyphicon glyphicon-menu-left"></span></a>
      <div class="head-mid">
       <h1>会员注册</h1>
      </div>
     </header>
     <div class="head-top">
      <img src="/static/index/images/head.jpg" />
     </div><!--head-top/-->
     <form action="{{url('/loginDo')}}" method="post" class="reg-login">
         @csrf
      <h3>还没有三级分销账号？点此<a class="orange" href="{{url('/reg')}}">注册</a></h3>
      <div class="lrBox">
       <div class="lrList" id="user_tle"><input type="text" placeholder="输入手机号码" name="user_tel" /></div>
       <div class="lrList" id="user_pwd"><input type="password" placeholder="输入密码" name="user_pwd" /></div>
      </div><!--lrBox/-->
      <div class="lrSub">
       <input type="submit" value="立即登录" />
      </div>
     </form><!--reg-login/-->

@endsection
