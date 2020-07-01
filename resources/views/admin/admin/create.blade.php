<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"> 
	<title>管理员管理</title>
	<link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/css/bootstrap.min.css">  
	<script src="https://cdn.staticfile.org/jquery/2.1.1/jquery.min.js"></script>
	<script src="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
<ul class="nav nav-pills">
    <li class="active"><a href="#">首页</a></li>
    <li class="dropdown">
      <a class="dropdown-toggle" data-toggle="dropdown" href="{{url('brand')}}">商品品牌<span class="caret"></span></a>
      <ul class="dropdown-menu">
        <li><a  href="{{url('brand/create')}}" >商品品牌添加</a></li>
        <li><a href="{{url('brand')}}">商品品牌展示</a></li>
      </ul>
	</li>
	<li class="dropdown">
      <a class="dropdown-toggle" data-toggle="dropdown" href="{{url('category')}}">商品分类<span class="caret"></span></a>
      <ul class="dropdown-menu">
        <li><a  href="{{url('category/create')}}" >商品分类添加</a></li>
        <li><a href="{{url('category')}}">商品分类展示</a></li>
      </ul>
	</li>
	<li class="dropdown">
      <a class="dropdown-toggle" data-toggle="dropdown" href="#">商品管理<span class="caret"></span></a>
      <ul class="dropdown-menu">
        <li><a  href="{{url('goods/create')}}">商品添加</a></li>
        <li><a href="{{url('goods')}}">商品展示</a></li>
      </ul>
	</li>
	<li class="dropdown">
      <a class="dropdown-toggle" data-toggle="dropdown" href="#">管理员管理<span class="caret"></span></a>
      <ul class="dropdown-menu">
        <li><a  href="{{url('admin/create')}}">管理员添加</a></li>
        <li><a href="{{url('admin')}}">管理员展示</a></li>
      </ul>
    </li>
</ul>
<center>
<h1>管理员添加
    <a style="float:right" href="{{url('admin')}}">
        <button type="button" class="btn btn-pink">展示</button>
    </a>
</h1>
<!-- @if ($errors->any()) 
<div class="alert alert-danger"> 
	<ul>
		@foreach ($errors->all() as $error) 
		<li>{{ $error }}</li> 
		@endforeach
	</ul> 
</div> 
@endif -->

</center>
<form class="form-horizontal" role="form" action="{{url('admin/store')}}" method="post" enctype="multipart/form-data">
    @csrf
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">管理员名称</label>
		<div class="col-sm-8">
			<input type="text" name="admin_name" class="form-control"  placeholder="管理员名称">
			<span style="color:pink">{{$errors->first('admin_name')}}</span>
		</div>
	</div>
	
	<div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">管理员密码</label>
		<div class="col-sm-8">
			<input type="password" name="admin_pwd" class="form-control"  placeholder="管理员密码">
            <span style="color:pink">{{$errors->first('admin_pwd')}}</span>
            
		</div>
	</div>
    <div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">管理员头像</label>
		<div class="col-sm-8">
			<input type="file" name="admin_img" class="form-control">
		</div>
	</div>
	<div class="form-group">
		<div class="col-sm-offset-2 col-sm-8">
			<button type="submit" class="btn btn-default">添加</button>
		</div>
	</div>
</form>

</body>
</html>
<script>
//管理员名称验证
$('input[name="admin_name"]').blur(function(){
	$(this).next().empty();
	var admin_name=$(this).val();
	var obj=$(this);
	var reg=/^[u4e00-\u9fa5\w]{2,15}$/;
	if(!reg.test(admin_name)){
		$(this).next().text('管理员名称可以由中文,字母，数字，下划线长度2-15位组成');
		return;
	}
	//验证唯一性
	$.get('/admin/checkname',{admin_name:admin_name},function(res){
		if(res.count){
			obj.next().text('管理员名称已有');
		}
	},'json')
})
//密码验证
$('input[name="admin_pwd"]').blur(function(){
	// alert(11);
	$(this).next().empty();
	var admin_pwd=$(this).val();
	// alert(admin_pwd);
	if(!admin_pwd){
		$(this).next().text('密码不能为空');
		return;
	}
})
//添加按钮验证
$('button').click(function(){
	var admin_name=$('input[name="admin_name"]').val();
	var obj=$('input[name="admin_name"]');
	var reg=/^[u4e00-\u9fa5\w]{2,15}$/;
	if(!reg.test(admin_name)){
		obj.next().text('管理员名称可以由中文,字母，数字，下划线长度2-15位组成');
		return;
	}
	var flag=false;
	$.ajax({
		type:'get',
		url:'/admin/checkname',
		data:{admin_name:admin_name},
		dataType:'json',
		async:false,
		success:function(res){
			if(res.count){
				obj.next().text('管理员已存在');
				flag=true;
			}
		}
	})
	if(flag){
		return;
	}
	//密码验证
	var admin_pwd=$('input[name="admin_pwd"]').val();
	if(!admin_pwd){
		$('input[name="admin_pwd"]').next().text('密码不能为空');
		return;
	}
	$('form').submit();
})
</script>