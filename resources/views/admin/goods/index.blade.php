<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"> 
	<title>商品品牌</title>
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
    <h1>商品展示
        <a style="float:right" href="{{url('brand/create')}}">
            <button type="button" class="btn btn-pink">添加</button>
        </a>
    </h1>
</center>
<table class="table table-bordered">
	<thead>
		<tr>
			<th>商品ID</th>
			<th>品牌名称</th>
			<th>商品价格</th>
            <th>商品详情</th>
            <th>商品库存</th>
            <th>商品数量</th>
            <th>商品图片</th>
            <th>商品相册</th>
            <th>是否新品</th>
            <th>是否热卖</th>
            <th>是否精品</th>
            <th>是否上架</th>
            <th>所属品牌</th>
            <th>所属分类</th>
			<th>操作</th>
		</tr>
	</thead>
    @foreach ($goods as $v)
	<tbody>
		<tr>
			<td>{{$v->goods_id}}</td>
            <td>{{$v->goods_name}}</td>
            <td>{{$v->goods_price}}</td>
            <td>{{$v->goods_desc}}</td>
            <td>{{$v->goods_num}}</td>
            <td>{{$v->goods_score}}</td>
            <td>
				@if($v->goods_img)
				<img src="{{env('UPLOADS_URL')}}{{$v->goods_img}}" width="100px">
				@endif
            </td>
            <td>
            @if($v->goods_imgs)
			    @php $imgarr = explode('|',$v->goods_imgs);@endphp
			    @foreach($imgarr as $goods_img)
			        <img src="{{env('UPLOADS_URL')}}{{$goods_img}}" width="100px">
			    @endforeach
			@endif
			</td>
            <td>{{$v->is_new==1?'是':'否'}}</td>
            <td>{{$v->is_hot==1?'是':'否'}}</td>
            <td>{{$v->is_best==1?'是':'否'}}</td>
            <td>{{$v->is_up==1?'是':'否'}}</td>
            <td>{{$v->brand_name}}</td>
            <td>{{$v->cate_name}}</td>
			<td>
            <a href="{{url('goods/edit/'.$v->goods_id)}}">
                <button type="button" class="btn btn-primary">修改</button>
            </a>
            <a href="javascript:void(0);">
                <button type="button" class="btn btn-danger" id="{{$v->goods_id}}">删除</button>
            </a>
            </td>
		</tr>
	</tbody>
    @endforeach
</table>
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
        if(confirm('确认删除')){
            $.post('/goods/destroy/'+id,function(res){
                if(res.code=='0'){
                    location.reload();
                }
            },'json')
        }
    })
})
    

</script>