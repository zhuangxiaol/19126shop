<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"> 
	<title>文章</title>
	<link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/css/bootstrap.min.css">  
	<script src="https://cdn.staticfile.org/jquery/2.1.1/jquery.min.js"></script>
	<script src="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
<center>
    <h1>修改文章</h1>
	<a style="float:right" href="{{url('lian')}}">
        <button type="button" class="btn btn-pink">展示</button>
    </a>
</center>
<form class="form-horizontal" role="form" action="{{url('lian/update/'.$lian->lid)}}" method="post" enctype="multipart/form-data">
@csrf
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">文章标题</label>
		<div class="col-sm-8">
			<input type="text" class="form-control" name="lname" id="firstname" value="{{$lian->lname}}">
            <span style="color:pink">{{$errors->first('lname')}}</span>
        </div>
	</div>
    <div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">文章分类</label>
		<div class="col-sm-8">
			<select name="tid" id="">
                <option value="">-请选择-</option>
                @foreach($type as $v)
                <option value="{{$v->tid}}" {{$lian->pid==$v->lid?'selected':''}}>{{$v->tname}}</option>
                @endforeach
            </select>
            <span style="color:pink">{{$errors->first('tid')}}</span>
        </div>
	</div>
    <div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">文章的重要性</label>
		<div class="col-sm-8">
			<input type="radio"  name="is_up" id="firstname"  value="1" {{$lian->is_up==1?'checked':''}}>普通
            <input type="radio"  name="is_up" id="firstname"  value="2" {{$lian->is_up==2?'checked':''}}>置顶
            <span style="color:pink">{{$errors->first('is_up')}}</span>
        </div>
	</div>
    <div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">是否显示</label>
		<div class="col-sm-8">
            <input type="radio"  name="is_nev" id="firstname"  value="1" {{$lian->is_nev==1?'checked':''}}>是
            <input type="radio"  name="is_nev" id="firstname"  value="2" {{$lian->is_nev==2?'checked':''}}>否
            <span style="color:pink">{{$errors->first('is_nev')}}</span>
        </div>
    </div>
    <div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">文章作者</label>
		<div class="col-sm-8">
			<input type="text" class="form-control" name="lwriter" id="firstname" value="{{$lian->lwriter}}">
		</div>
	</div>
    <div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">作者Email</label>
		<div class="col-sm-8">
			<input type="text" class="form-control" name="lemail" id="firstname" value="{{$lian->lemail}}">
		</div>
	</div>
    <div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">关键字</label>
		<div class="col-sm-8">
			<input type="text" class="form-control" name="lkeyw" id="firstname" value="{{$lian->lkeyw}}">
		</div>
	</div>

    <div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">网页描述</label>
		<div class="col-sm-8">
            <textarea name="ldesc" class="form-control" id="" cols="8" rows="5" >{{$lian->ldesc}}</textarea>
		</div>
	</div>

    <div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">上传文件</label>
		<div class="col-sm-6">
			<input type="file" class="form-control" name="limg" id="firstname">
		</div>
        <img src="{{env('UPLOADS_URL')}}{{$lian->limg}}" width="100px">
	</div>

	<div class="form-group">
		<div class="col-sm-offset-2 col-sm-8">
			<button type="submit" class="btn btn-default">修改</button>
		</div>
	</div>
</form>

</body>
</html>