<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"> 
	<title>后台登陆</title>
	<link rel="stylesheet" href="/static/css/bootstrap.min.css">  
	<script src="/static/js/jquery/2.1.1/jquery.min.js"></script>
	<script src="/static/js/bootstrap.min.js"></script>
</head>
<body>

<center>
<h1>登陆</h1>
@if(session('msg'))
<div class="alert alert-danger">{{session('msg')}}</div>
@endif
</center>
<form class="form-horizontal" role="form" action="{{url('logindo')}}" method="post" enctype="multipart/form-data">
    @csrf
	<div class="form-group">
		<label for="firstname" class="col-sm-4 control-label">用户名</label>
		<div class="col-sm-5">
			<input type="text" name="admin_name" class="form-control"  placeholder="请输入用户名">

		</div>
	</div>
	
	<div class="form-group">
		<label for="lastname" class="col-sm-4 control-label">密码</label>
		<div class="col-sm-5">
			<input type="password" name="admin_pwd" class="form-control"  placeholder="请输入密码">
		</div>
	</div>
	<div class="form-group">
    <div class="col-sm-offset-4 col-sm-4">
      <div class="checkbox">
        <label>
          <input type="checkbox" name="rember">七天免登录
        </label>
      </div>
    </div>
  </div>
	<div class="form-group">
		<div class="col-sm-offset-4 col-sm-4">
			<button type="submit" class="btn btn-default">登录</button>
		</div>
	</div>
</form>
</body>
</html>