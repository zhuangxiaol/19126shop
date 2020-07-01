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
    <h1>添加友情链接</h1>
	<a style="float:right" href="{{url('links')}}">
        <button type="button" class="btn btn-pink">展示</button>
    </a>
</center>
<form class="form-horizontal" role="form" action="{{url('links/store')}}" method="post" enctype="multipart/form-data">
@csrf
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">网站名称</label>
		<div class="col-sm-8">
			<input type="text" class="form-control" name="l_name" id="firstname" placeholder="网站名称">
            <span style="color:pink">{{$errors->first('l_name')}}</span>
        </div>
	</div>
    <div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">网站网址</label>
		<div class="col-sm-8">
			<input type="text" class="form-control" name="l_web" id="firstname" placeholder="网站网址">
            <span style="color:pink">{{$errors->first('l_web')}}</span>
        </div>
	</div>
    <div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">链接类型</label>
		<div class="col-sm-8">
			<input type="radio"  name="is_up" id="firstname" checked value="1">Logo链接
            <input type="radio"  name="is_up" id="firstname" value="2">文字链接
		</div>
	</div>
    <div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">图片Logo</label>
		<div class="col-sm-8">
			<input type="file" class="form-control" name="l_img" id="firstname">
		</div>
	</div>
    <div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">网站联系人</label>
		<div class="col-sm-8">
			<input type="text" class="form-control" name="l_site" id="firstname" placeholder="网站联系人">
		</div>
	</div>
    <div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">网站介绍</label>
		<div class="col-sm-8">
            <textarea name="l_desc" class="form-control" id="" cols="8" rows="5" placeholder="网站介绍"></textarea>
		</div>
	</div>
    <div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">是否显示</label>
		<div class="col-sm-8">
            <input type="radio"  name="is_nav" id="firstname" checked value="1">是
            <input type="radio"  name="is_nav" id="firstname" value="2">否
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