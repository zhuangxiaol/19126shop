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
    <h1>商品分类展示
        <a style="float:right" href="{{url('category/create')}}">
            <button type="button" class="btn btn-pink">添加</button>
        </a>
    </h1>
</center>
<table class="table table-bordered">
	<thead>
		<tr>
			<th>分类ID</th>
			<th>分类名称</th>
            <th>是否显示</th>
			<th>是否在导航显示</th>
			<th>操作</th>
		</tr>
	</thead>
    @foreach ($category as $v)
	<tbody>
		<tr>
            <td>{{$v->cate_id}}</td>
			<td>{{str_repeat('|—',$v->level)}}{{$v->cate_name}}</td>
            <td>{{$v->cate_nav_show==1?'是':'否'}}</td>
			<td>{{$v->cate_show==1?'是':'否'}}</td>
			<td>
            <a href="{{url('category/edit/'.$v->cate_id)}}">
                <button type="button" class="btn btn-primary">修改</button>
            </a>
            <a href="{{url('category/destroy/'.$v->cate_id)}}">
                <button type="button" class="btn btn-danger">删除</button>
            </a>
            </td>
		</tr>
	</tbody>
    @endforeach
</table>
</body>
</html>