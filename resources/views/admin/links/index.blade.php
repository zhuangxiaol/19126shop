<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"> 
	<title>友情链接</title>
	<link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/css/bootstrap.min.css">  
	<script src="https://cdn.staticfile.org/jquery/2.1.1/jquery.min.js"></script>
	<script src="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
<center>
    <h1>展示友情链接</h1>
	<a style="float:right" href="{{url('links/create')}}">
        <button type="button" class="btn btn-pink">添加</button>
    </a>
	<a style="float:left" href="{{url('links/login')}}">
        <button type="button" class="btn btn-pink">登录</button>
    </a>
	<form action="">
		<input type="text" name="l_name" placeholder="请输入网站名称关键字">
		<button>搜索</button>
	</form>
</center>
<table class="table table-bordered">
	<thead>
		<tr>
			<th>网站ID</th>
			<th>网站名称</th>
			<th>网站网址</th>
            <th>链接类型</th>
			<th>图片Logo</th>
			<th>网站联系人</th>
            <th>网站介绍</th>
            <th>状态</th>
            <th>网站操作</th>
		</tr>
	</thead>
    @foreach($links as $v)
	<tbody>
		<tr>
			<td>{{$v->l_id}}</td>
			<td>{{$v->l_name}}</td>
			<td>{{$v->l_web}}</td>
            <td>{{$v->is_up==1?'Logo链接':'文字链接'}}</td>
			<td>
            @if($v->l_img)
            	<img src="{{env('UPLOADS_URL')}}{{$v->l_img}}" width="100px">
            @endif
            </td>
			<td>{{$v->l_site}}</td>
            <td>{{$v->l_desc}}</td>
			<td>{{$v->is_nav==1?'显示':'不显示'}}</td>
			<td>
            <a href="{{url('links/edit/'.$v->l_id)}}">
                <button type="button" class="btn btn-danger">修改</button>
            </a>
            <a href="{{url('links/destroy/'.$v->l_id)}}">
                <button type="button" class="btn btn-danger">删除</button>
            </a>
            </td>
		</tr>
	</tbody>
    @endforeach
</table>
{{$links->appends(['l_name'=>$l_name])->links()}}
</body>
</html>