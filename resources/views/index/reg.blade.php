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
     <form action="{{url('/regDo')}}" method="post" class="reg-login">
         @csrf
      <h3>已经有账号了？点此<a class="orange" href="{{url('/login')}}">登陆</a></h3>
      <div class="lrBox">
       <div class="lrList"><input type="text" placeholder="输入手机号码" name="user_tel" /></div>
       <div class="lrList2"><input type="text" placeholder="输入短信验证码" name="user_sms" /> <button>获取验证码</button></div>
       <div class="lrList"><input type="password" placeholder="设置新密码（6-18位数字或字母）" name="user_pwd" /></div>
       <div class="lrList"><input type="text" placeholder="再次输入密码" name="confirm_pwd" /></div>
      </div><!--lrBox/-->
      <div class="lrSub">
       <input type="submit" value="立即注册" />
      </div>
     </form><!--reg-login/-->
@endsection
