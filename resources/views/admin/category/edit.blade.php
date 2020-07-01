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
<h1>商品分类修改
    <a style="float:right" href="{{url('category')}}">
        <button type="button" class="btn btn-pink">展示</button>
    </a>
</h1>
</center>

<form class="form-horizontal" role="form" action="{{url('category/update/'.$cateInfo->cate_id)}}" method="post">

    @csrf
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">分类名称</label>
		<div class="col-sm-10">
			<input type="text" name="cate_name" class="form-control"  value="{{$cateInfo->cate_name}}">
		</div>
	</div>
	<div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">顶级分类</label>
		<div class="col-sm-10">
			<select name="pid" id="">
                <option value="">顶级分类</option>
                @foreach($category as $v)
				<option value="{{$v->cate_id}}" {{$cateInfo->pid==$v->cate_id?'selected':''}}>
				{{str_repeat('|——',$v->level)}}{{$v->cate_name}}</option>
				@endforeach
            </select>
		</div>
	</div>
    <div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">是否显示</label>
		<div class="col-sm-10">
			<input type="radio" name="cate_nav_show"  value="1" {{$cateInfo->cate_nav_show==1?'checked':''}}>是
            <input type="radio" name="cate_nav_show"  value="2" {{$cateInfo->cate_nav_show==2?'checked':''}}>否
		</div>
	</div>
    <div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">是否在导航显示</label>
		<div class="col-sm-10">
            <input type="radio" id="" name="cate_show" value="1" {{$cateInfo->cate_show==1?'checked':''}}>是
            <input type="radio" id="" name="cate_show" value="2" {{$cateInfo->cate_show==2?'checked':''}}>否
		</div>
	</div>
	<div class="form-group">
		<div class="col-sm-offset-2 col-sm-10">
			<button type="submit" class="btn btn-default">修改</button>
		</div>
	</div>
</form>
</body>
</html>


