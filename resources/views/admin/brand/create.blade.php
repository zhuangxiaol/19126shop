<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"> 
	<title>商品品牌</title>
	<link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/css/bootstrap.min.css">  
	<script src="https://cdn.staticfile.org/jquery/2.1.1/jquery.min.js"></script>
	<script src="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
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
<h1>商品品牌添加
    <a style="float:right" href="{{url('brand')}}">
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
<form class="form-horizontal" role="form" action="{{url('brand/store')}}" method="post" enctype="multipart/form-data">
    @csrf
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">商品名称</label>
		<div class="col-sm-10">
			<input type="text" name="brand_name" class="form-control"  placeholder="商品名称">
			<span style="color:pink">{{$errors->first('brand_name')}}</span>
		</div>
	</div>
	
	<div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">商品网址</label>
		<div class="col-sm-10">
			<input type="text" name="brand_url" class="form-control"  placeholder="商品网址">
			<span style="color:pink">{{$errors->first('brand_url')}}</span>
		</div>
	</div>
    <div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">商品logo</label>
		<div class="col-sm-10">
			<input type="file" name="brand_logo" class="form-control">
		</div>
	</div>
    <div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">商品详情</label>
		<div class="col-sm-10">
            <textarea name="brand_desc" class="form-control"  placeholder="商品详情"></textarea>
		</div>
	</div>
	<div class="form-group">
		<div class="col-sm-offset-2 col-sm-10">
			<button type="submit" class="btn btn-default">添加</button>
		</div>
	</div>
</form>

</body>
</html>
<script>
//品牌验证
$('input[name="brand_name"]').blur(function(){
	$(this).next().empty();
	var brand_name=$(this).val();
	var obj=$(this);
	var reg=/^[u4e00-\u9fa5\w]{1,15}$/;
	if(!reg.test(brand_name)){
		$(this).next().text('品牌可以由中文,字母，数字，下划线长度1-15位组成');
		return;
	}
	//验证唯一性
	$.get('/brand/checkname',{brand_name:brand_name},function(res){
		if(res.count){
			obj.next().text('品牌已有');
		}
	},'json')
})
//品牌网址验证
$('input[name="brand_url"]').blur(function(){
	// alert(11);
	$(this).next().empty();
	var brand_url=$(this).val();
	// alert(brand_url);
	if(!brand_url){
		$(this).next().text('品牌网址不能为空2');
		return;
	}
})
//添加按钮验证
$('button').click(function(){
	var brand_name=$('input[name="brand_name"]').val();
	var obj=$('input[name="brand_name"]');
	var reg=/^[u4e00-\u9fa5\w]{1,15}$/;
	if(!reg.test(brand_name)){
		obj.next().text('品牌可以由中文,字母，数字，下划线长度1-15位组成');
		return;
	}
	var flag=false;
	$.ajax({
		type:'get',
		url:'/brand/checkname',
		data:{brand_name:brand_name},
		dataType:'json',
		async:false,
		success:function(res){
			if(res.count){
				obj.next().text('品牌已有');
				flag=true;
			}
		}
	})
	if(flag){
		return;
	}
	//密码验证
	var brand_url=$('input[name="brand_url"]').val();
	if(!brand_url){
		$('input[name="brand_url"]').next().text('品牌网址不能为空2');
		return;
	}
	$('form').submit();
})
</script>