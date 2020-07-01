<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"> 
	<title>管理员管理</title>
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
<h1>管理员修改
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
<form class="form-horizontal" role="form" action="{{url('admin/update/'.$admin->admin_id)}}" method="post" enctype="multipart/form-data">
    @csrf
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">管理员名称</label>
		<div class="col-sm-8">
			<input type="text" name="admin_name" class="form-control"  value="{{$admin->admin_name}}">
			<span style="color:pink">{{$errors->first('admin_name')}}</span>
		</div>
	</div>
	
	<div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">管理员密码</label>
		<div class="col-sm-8">
			<input type="password" name="admin_pwd" class="form-control"  value="{{$admin->admin_pwd}}">
            <span style="color:pink">{{$errors->first('admin_pwd')}}</span>
            
		</div>
	</div>
    <div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">管理员头像</label>
		<div class="col-sm-6">
			<input type="file" name="admin_img" class="form-control">
        </div>
        <img src="{{env('UPLOADS_URL')}}{{$admin->admin_img}}" width="100px">
	</div>
	<div class="form-group">
		<div class="col-sm-offset-2 col-sm-8">
			<button type="submit" class="btn btn-default">修改</button>
		</div>
	</div>
</form>

</body>
</html>