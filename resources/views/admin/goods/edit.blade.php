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
<h1>商品修改
    <a style="float:right" href="{{url('goods')}}">
        <button type="button" class="btn btn-pink">展示</button>
    </a>
</h1>
</center>

<form class="form-horizontal" role="form" action="{{url('goods/update/'.$goods->goods_id)}}" method="post" enctype="multipart/form-data">
    @csrf
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">商品名称</label>
		<div class="col-sm-8">
			<input type="text" name="goods_name" class="form-control" value="{{$goods->goods_name}}">
		</div>
	</div>
	<div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">商品价格</label>
		<div class="col-sm-8">
			<input type="text" name="goods_price" class="form-control" value="{{$goods->goods_price}}">
		</div>
	</div>
    <div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">商品详情</label>
		<div class="col-sm-8">
            <textarea name="goods_desc" class="form-control"  placeholder="商品详情">{{$goods->goods_desc}}</textarea>
        </div>
    </div>
    <div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">商品库存</label>
		<div class="col-sm-8">
			<input type="text" name="goods_num" class="form-control" value="{{$goods->goods_num}}">
		</div>
    </div>
    <div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">商品数量</label>
		<div class="col-sm-8">
			<input type="text" name="goods_score" class="form-control" value="{{$goods->goods_score}}">
		</div>
    </div>
    <div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">商品图片</label>
		<div class="col-sm-6">
			<input type="file" name="goods_img" class="form-control">
        </div>
        <img src="{{env('UPLOADS_URL')}}{{$goods->goods_img}}" width="100px">
    </div>
    <div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">商品相册</label>
		<div class="col-sm-8">
			<input type="file" name="goods_imgs[]" class="form-control">
		</div>
    </div>
    <div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">是否新品</label>
		<div class="col-sm-8">
            <input type="radio" name="is_new" value="1" {{$goods->is_new==1?'checked':''}}>是
            <input type="radio" name="is_new" value="2" {{$goods->is_new==2?'checked':''}}>否
		</div>
    </div>
    <div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">是否热卖</label>
		<div class="col-sm-8">
            <input type="radio"  name="is_hot" value="1" {{$goods->is_hot==1?'checked':''}}>是
            <input type="radio"  name="is_hot" value="2" {{$goods->is_hot==2?'checked':''}}>否
		</div>
    </div>
    <div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">是否精品</label>
		<div class="col-sm-8">
            <input type="radio"  name="is_best" value="1" {{$goods->is_best==1?'checked':''}}>是
            <input type="radio"  name="is_best" value="2" {{$goods->is_best==2?'checked':''}}>否
		</div>
    </div>
    <div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">是否上架</label>
		<div class="col-sm-8">
            <input type="radio"  name="is_up" value="1" {{$goods->is_up==1?'checked':''}}>是
            <input type="radio"  name="is_up" value="2" {{$goods->is_up==2?'checked':''}}>否
		</div>
    </div>
    <div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">所属品牌</label>
		<div class="col-sm-8">
            <select name="brand_id" id="">
                <option value="">请选择</option>
                @foreach($brand as $v)
                <option value="{{$v->brand_id}}" {{$goods->brand_id==$v->brand_id?'selected':''}}>{{$v->brand_name}}</option>
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
                <option value="{{$v->cate_id}}" {{$goods->cate_id==$v->cate_id?'selected':''}}>{{$v->cate_name}}</option>   
                @endforeach                    
            </select>
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