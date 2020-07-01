<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"> 
	<title>商品</title>
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
<h1>商品添加
    <a style="float:right" href="{{url('goods')}}">
        <button type="button" class="btn btn-pink">展示</button>
    </a>
</h1>
</center>

<form class="form-horizontal" role="form" action="{{url('goods/store')}}" method="post" enctype="multipart/form-data">
    @csrf
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">商品名称</label>
		<div class="col-sm-8">
			<input type="text" name="goods_name" class="form-control"  placeholder="商品名称">
      <span style="color:pink">{{$errors->first('goods_name')}}</span>
		</div>
	</div>
	<div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">商品价格</label>
		<div class="col-sm-8">
			<input type="text" name="goods_price" class="form-control"  placeholder="商品价格">
      <span style="color:pink">{{$errors->first('goods_price')}}</span>
		</div>
	</div>
    <div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">商品详情</label>
		<div class="col-sm-8">
            <textarea name="goods_desc" class="form-control"  placeholder="商品详情"></textarea>
            <span style="color:pink">{{$errors->first('goods_desc')}}</span>
        </div>
    </div>
    <div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">商品库存</label>
		<div class="col-sm-8">
			<input type="text" name="goods_num" class="form-control"  placeholder="商品库存">
      <span style="color:pink">{{$errors->first('goods_num')}}</span>
		</div>
    </div>
    <div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">商品数量</label>
		<div class="col-sm-8">
			<input type="text" name="goods_score" class="form-control"  placeholder="商品数量">
      <span style="color:pink">{{$errors->first('goods_score')}}</span>
		</div>
    </div>
    <div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">商品图片</label>
		<div class="col-sm-8">
			<input type="file" name="goods_img" class="form-control">
		</div>
    </div>
    <div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">商品相册</label>
		<div class="col-sm-8">
			<input type="file" name="goods_imgs[]"  multiple="multiple" class="form-control">
		</div>
    </div>
    <div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">是否新品</label>
		<div class="col-sm-8">
            <input type="radio" name="is_new" value="1" checked>是
            <input type="radio" name="is_new" value="2">否
		</div>
    </div>
    <div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">是否热卖</label>
		<div class="col-sm-8">
            <input type="radio"  name="is_hot" value="1" checked  />是
            <input type="radio"  name="is_hot" value="2"  />否
		</div>
    </div>
    <div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">是否精品</label>
		<div class="col-sm-8">
            <input type="radio"  name="is_best" value="1" checked  />是
            <input type="radio"  name="is_best" value="2"  />否
		</div>
    </div>
    <div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">是否上架</label>
		<div class="col-sm-8">
            <input type="radio"  name="is_up" value="1" checked  />是
            <input type="radio"  name="is_up" value="2"  />否
		</div>
    </div>
    <div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">所属品牌</label>
		<div class="col-sm-8">
            <select name="brand_id" id="">
                <option value="">请选择</option>
                @foreach($brand as $v)
                <option value="{{$v->brand_id}}">{{$v->brand_name}}</option>
                @endforeach
            </select>
		</div>
    </div>
    <div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">所属分类</label>
		<div class="col-sm-8">
            <select name="cate_id" id="">
                <option value="">请选择</option> 
                @foreach($category as $v)             
                <option value="{{$v->cate_id}}">{{$v->cate_name}}</option>   
                @endforeach                    
            </select>
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
//商品名称验证
$('input[name="goods_name"]').blur(function(){
	$(this).next().empty();
	var goods_name=$(this).val();
	var obj=$(this);
	var reg=/^[u4e00-\u9fa5\w]{2,15}$/;
	if(!reg.test(goods_name)){
		$(this).next().text('商品名称可以由中文,字母，数字');
		return;
	}
	//验证唯一性
	$.get('/goods/checkname',{goods_name:goods_name},function(res){
		if(res.count){
			obj.next().text('商品名称已有');
		}
	},'json')
})
//商品价格
$('input[name="goods_price"]').blur(function(){
	// alert(11);
	$(this).next().empty();
	var goods_price=$(this).val();
	// alert(goods_price);
	if(!goods_price){
		$(this).next().text('商品价格不能为空');
		return;
	}
})
//商品详情
$('textarea[name="goods_desc"]').blur(function(){
	// alert(11);
	$(this).next().empty();
	var goods_desc=$(this).val();
	// alert(goods_desc);
	if(!goods_desc){
		$(this).next().text('商品内容不能为空');
		return;
	}
})
//商品库存
$('input[name="goods_num"]').blur(function(){
	// alert(11);
	$(this).next().empty();
	var goods_num=$(this).val();
	// alert(goods_num);
	if(!goods_num){
		$(this).next().text('商品库存不能为空');
		return;
	}
})
//商品数量
$('input[name="goods_score"]').blur(function(){
	// alert(11);
	$(this).next().empty();
	var goods_score=$(this).val();
	// alert(goods_score);
	if(!goods_score){
		$(this).next().text('商品数量不能为空');
		return;
	}
})
//添加验证
$('button').click(function(){
	var goods_name=$('input[name="goods_name"]').val();
	var obj=$('input[name="goods_name"]');
	var reg=/^[u4e00-\u9fa5\w]{2,15}$/;
	if(!reg.test(goods_name)){
		obj.next().text('商品名称可以由中文,字母，数字');
		return;
	}
	var flag=false;
	$.ajax({
		type:'get',
		url:'/goods/checkname',
		data:{goods_name:goods_name},
		dataType:'json',
		async:false,
		success:function(res){
			if(res.count){
				obj.next().text('商品名称已有');
				flag=true;
			}
		}
	})
	if(flag){
		return;
	}
	//商品价格验证
	var goods_price=$('input[name="goods_price"]').val();
	if(!goods_price){
		$('input[name="goods_price"]').next().text('商品价格不能为空');
		return;
	}
	$('form').submit();
})
</script>