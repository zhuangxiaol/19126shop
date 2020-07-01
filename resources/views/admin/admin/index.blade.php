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
    <h1>管理员展示
        <a style="float:right" href="{{url('admin/create')}}">
            <button type="button" class="btn btn-pink">添加</button>
        </a>
    </h1>
</center>
<form action="">
    <input type="text"  name="admin_name" value="{{$admin_name}}" placeholder="请输入管理员关键字">
    <button>搜索</button>
</form>
<table class="table table-bordered">
	<thead>
		<tr>
			<th>管理员ID</th>
			<th>管理员名称</th>
			<th>管理员头像</th>
			<th>操作</th>
		</tr>
	</thead>
    @foreach ($admin as $v)
	<tbody>
		<tr>
			<td>{{$v->admin_id}}</td>
			<td>{{$v->admin_name}}</td>
            <td>
				@if($v->admin_img)
				<img src="{{env('UPLOADS_URL')}}{{$v->admin_img}}" width="100px">
				@endif
			</td>
			<td>
            <a href="{{url('admin/edit/'.$v->admin_id)}}">
                <button type="button" class="btn btn-primary">修改</button>
            </a>
            <a href="javascript:void(0);">
                <button type="button" class="btn btn-danger" id="{{$v->admin_id}}">删除</button>
            </a>
            </td>
		</tr>
    </tbody>
    @endforeach
</table>
{{$admin->appends(['admin_name'=>$admin_name])->links()}}
</body>
</html>

<script>
$.ajaxSetup({
    headers:{
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
$(function(){
    $(document).on('click','.btn-danger',function(){
        var id=$(this).attr('id');
        // alert(22);
        if(confirm('确认删除')){
            $.post('admin/destroy/'+id,function(res){
                if(res.code=='0'){
                    location.reload();
                }
            },'json')
        }
    })
})
</script>