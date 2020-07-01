@extends('index.layouts.shop')
@section('title', '登录页面')
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
     <form action="{{url('dologin')}}" method="post" class="reg-login">
     @csrf
      <h3>还没有三级分销账号？点此<a class="orange" href="{{url('reg')}}">注册</a></h3>
      <div class="lrBox">

      <div class="lrList">
        <input type="text" name="name" placeholder="输入手机号码或者邮箱号" />
        <span style="color:pink">{{$errors->first('name')}}</span>
      </div>
       
      <div class="lrList">
        <input type="password" name="password" placeholder="输入密码" />
        <span style="color:pink">{{$errors->first('password')}}</span>
      </div>
      </div><!--lrBox/-->
      <div class="form-group">
        <div class="col-sm-4 col-sm-5">
          <div class="checkbox">
            <label>
            <input type="checkbox" name="rember">七天免登录
            </label>
          </div>
        </div>
      </div>
      <div class="lrSub">
       <input type="button" value="立即登录" />
      </div>
     </form><!--reg-login/-->
<script>
$('input[name="name"]').blur(function(){
  // alert(11);
  var _this = $(this);
  $(this).next().empty();
    var name = $(this).val();
    if(name == ''){
      $(this).next().text('请输入手机号码或者邮箱号');return; 
    }
});

$('input[name="password"]').blur(function(){
var _this = $(this);
  $(this).next().empty();
  var password = $(this).val();
  if(password == ''){
    $(this).next().text('请填写密码');return;  
  }
});

$('input[type="button"]').click(function(){

  var name = $('input[name="name"]').val();
   $('input[name="name"]').next().empty(); 
     if(name == ''){   
       $('input[name="name"]').next().text('请输入手机号码或者邮箱号'); 
}
  var password = $('input[name="password"]').val();
  $('input[name="password"]').next().empty(); 
    if(password == ''){    
      $('input[name="password"]').next().text('请填写密码');return;       
    }
  $('form').submit();
});
</script>
@endsection
     