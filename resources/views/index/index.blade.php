@extends('index.layouts.shop')
@section('title', '首页')
@section('content')
<div class="head-top">
      <img src="/static/index/images/head.jpg" />
      <dl>
       <dt><a href="user.html"><img src="/static/index/images/touxiang.jpg" /></a></dt>
       <dd>
        <h1 class="username">三级分销终身荣誉会员</h1>
        <ul>
         <li><a href="prolist.html"><strong>34</strong><p>全部商品</p></a></li>
         <li><a href="javascript:;"><span class="glyphicon glyphicon-star-empty"></span><p>收藏本店</p></a></li>
         <li style="background:none;"><a href="javascript:;"><span class="glyphicon glyphicon-picture"></span><p>二维码</p></a></li>
         <div class="clearfix"></div>
        </ul>
       </dd>
       <div class="clearfix"></div>
      </dl>
     </div><!--head-top/-->
     <form action="#" method="get" class="search">
      <input type="text" class="seaText fl" />
      <input type="submit" value="搜索" class="seaSub fr" />
     </form><!--search/-->
     <!-- <ul class="reg-login-click">
      <li><a href="{{url('login')}}">登录</a></li>
      <li><a href="{{url('reg')}}" class="rlbg">注册</a></li>
      <div class="clearfix"></div>
     </ul> -->
     <!--reg-login-click/-->
     <ul class="reg-login-click">
	 @if(session('member'))
	 <li><a href="/login" style="text-decoration:none">欢迎[<font color='blue'>{{session('member')->name}}</font>]登陆</a></li>
	  <li><a style="text-decoration:none" href="{{url('/logout')}}" class="rlbg">退出</a></li>
	 @else
	  <li><a style="text-decoration:none" href="{{url('/login')}}">登录</a></li>
      <li><a style="text-decoration:none" href="{{url('/register')}}" class="rlbg">注册</a></li>
	 @endif
      <div class="clearfix"></div>
     </ul><!--reg-login-click/-->
     <div id="sliderA" class="slider">
      @foreach($slice as $v)
      <a href="{{url('goods/'.$v->goods_id)}}">
            <img src="{{env('UPLOADS_URL')}}{{$v->goods_img}}">
      </a>
      @endforeach
     </div><!--sliderA/-->
     <ul class="pronav">
      @foreach($topcate as $v)
      <li><a href="{{url('list/'.$v->cate_id)}}">{{$v->cate_name}}</a></li>
      @endforeach
      <div class="clearfix"></div>
     </ul><!--pronav/-->
     <div class="index-pro1">
	@foreach($hot as $v)
      <div class="index-pro1-list">
       <dl>
            <dt>
                  <a href="{{url('/goods/'.$v->goods_id)}}">
                        <img src="{{env('UPLOADS_URL')}}{{$v->goods_img}}" />
                  </a>
            </dt>
            <dd class="ip-text">
                  <a href="{{url('/goods/'.$v->goods_id)}}">{{$v->goods_name}}</a>
                  <span>已售：{{$v->goods_price*$v->goods_num}}</span>
            </dd>
            <dd class="ip-price">
                  <strong>¥{{$v->goods_price*0.95}}</strong> 
                  <span>¥{{$v->goods_price}}</span>
            </dd>
      </dl>
      </div>
	@endforeach
      <div class="clearfix"></div>
     </div><!--index-pro1/-->
     <div class="prolist">
	   @foreach($hot as $v)
      <dl>
       <dt>
            <a href="{{url('/goods/'.$v->goods_id)}}">
                  <img src="{{env('UPLOADS_URL')}}{{$v->goods_img}}" width="100" height="100" />
            </a>
      </dt>
      <dd>
      <h3>
            <a href="{{url('/goods/'.$v->goods_id)}}">{{$v->goods_name}}</a>
      </h3>
      <div class="prolist-price">
            <strong>¥{{$v->goods_price*0.95}}</strong> 
            <span>¥{{$v->goods_price}}</span>
      </div>
      <div class="prolist-yishou">
            <span>0.95折</span> 
            <em>已售：{{$v->goods_price*$v->goods_num}}</em>
      </div>
      </dd>
      <div class="clearfix"></div>
      </dl>
	@endforeach
     </div><!--prolist/-->
     <div class="joins"><a href="fenxiao.html"><img src="/static/index/images/jrwm.jpg" /></a></div>
     <div class="copyright">Copyright &copy; <span class="blue">这是就是三级分销底部信息</span></div>
     

     @endsection