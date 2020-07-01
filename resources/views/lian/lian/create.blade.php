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
    <h1>添加文章</h1>
	<a style="float:right" href="{{url('lian')}}">
        <button type="button" class="btn btn-pink">展示</button>
    </a>
</center>
<form class="form-horizontal" role="form" action="{{url('lian/store')}}" method="post" enctype="multipart/form-data">
@csrf
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">文章标题</label>
		<div class="col-sm-8">
			<input type="text" class="form-control" name="lname" id="firstname" placeholder="文章标题">
            <span style="color:pink">{{$errors->first('lname')}}</span>
        </div>
	</div>
    <div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">文章分类</label>
		<div class="col-sm-8">
			<select name="tid" id="">
                <option value="">-请选择-</option>
                @foreach($type as $v)
                <option value="{{$v->tid}}">{{$v->tname}}</option>
                @endforeach
            </select>
            <span style="color:pink">{{$errors->first('tid')}}</span>
        </div>
	</div>
    <div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">文章的重要性</label>
		<div class="col-sm-8">
			<input type="radio"  name="is_up" id="firstname" checked value="1">普通
            <input type="radio"  name="is_up" id="firstname" value="2">置顶
            <span style="color:pink">{{$errors->first('is_up')}}</span>
        </div>
	</div>
    <div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">是否显示</label>
		<div class="col-sm-8">
            <input type="radio"  name="is_nev" id="firstname" checked value="1">是
            <input type="radio"  name="is_nev" id="firstname" value="2">否
            <span style="color:pink">{{$errors->first('is_nev')}}</span>
        </div>
    </div>
    <div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">文章作者</label>
		<div class="col-sm-8">
			<input type="text" class="form-control" name="lwriter" id="firstname" placeholder="文章作者">
			<span style="color:pink">{{$errors->first('lwriter')}}</span>
		</div>
	</div>
    <div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">作者Email</label>
		<div class="col-sm-8">
			<input type="text" class="form-control" name="lemail" id="firstname" placeholder="作者Email">
		</div>
	</div>
    <div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">关键字</label>
		<div class="col-sm-8">
			<input type="text" class="form-control" name="lkeyw" id="firstname" placeholder="关键字">
		</div>
	</div>

    <div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">网页描述</label>
		<div class="col-sm-8">
            <textarea name="ldesc" class="form-control" id="" cols="8" rows="5" placeholder="网页描述"></textarea>
		</div>
	</div>

    <div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">上传文件</label>
		<div class="col-sm-8">
			<input type="file" class="form-control" name="limg" id="firstname">
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
//文章名称验证
$('input[name="lname"]').blur(function(){
	$(this).next().empty();
	var lname=$(this).val();
	var obj=$(this);
	var reg=/^[u4e00-\u9fa5\w]{2,15}$/;
	if(!reg.test(lname)){
		$(this).next().text('名称名称需要由中文,字母，数字，下划线长度2-15位组成');
		return;
	}
	//验证唯一性
	$.get('/lian/checkname',{lname:lname},function(res){
		if(res.count){
			obj.next().text('文章名称已有');
		}
	},'json')
})
//文章作者
$('input[name="lwriter"]').blur(function(){
	// alert(11);
	$(this).next().empty();
	var lwriter=$(this).val();
	// alert(lwriter);
	if(!lwriter){
		$(this).next().text('文章作者不能为空');
		return;
	}
})
//添加验证
$('button').click(function(){
	var lname=$('input[name="lname"]').val();
	var obj=$('input[name="lname"]');
	var reg=/^[u4e00-\u9fa5\w]{2,15}$/;
	if(!reg.test(lname)){
		obj.next().text('名称名称需要由中文,字母，数字，下划线长度2-15位组成');
		return;
	}
	var flag=false;
	$.ajax({
		type:'get',
		url:'/lian/checkname',
		data:{lname:lname},
		dataType:'json',
		async:false,
		success:function(res){
			if(res.count){
				obj.next().text('文章标题已存在');
				flag=true;
			}
		}
	})
	if(flag){
		return;
	}
	//文章作者验证
	var lwriter=$('input[name="lwriter"]').val();
	if(!lwriter){
		$('input[name="lwriter"]').next().text('文章作者不能为空');
		return;
	}
	$('form').submit();
})
</script>