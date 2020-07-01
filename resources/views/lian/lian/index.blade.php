<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"> 
	<title>文章</title>
	<link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/css/bootstrap.min.css">  
	<script src="https://cdn.staticfile.org/jquery/2.1.1/jquery.min.js"></script>
	<script src="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
<center>
    <h1>展示文章</h1>
	<a style="float:right" href="{{url('lian/create')}}">
        <button type="button" class="btn btn-pink">添加</button>
    </a>
	<form action="">
		<input type="text" name="lname" placeholder="请输入文章标题关键字">
        <select name="tname" id="">
        <option value="">请选择</option>
        @foreach($type as $v)
            <option value="{{$v->tname}}">{{$v->tname}}</option>
        @endforeach
        </select>
		<button>搜索</button>
	</form>
</center>
<table class="table table-bordered">
	<thead>
		<tr>
			<th>文章ID</th>
			<th>文章标题</th>
			<th>文章分类</th>
            <th>文章的重要性</th>
			<th>是否显示</th>
            <th>上传文件</th>
            <th>添加时间</th>
            <th>网站操作</th>
		</tr>
	</thead>
    @foreach($lian as $v)
	<tbody>
		<tr>
			<td>{{$v->lid}}</td>
			<td>{{$v->lname}}</td>
			<td>{{$v->tname}}</td>
            <td>{{$v->is_up==1?'普通':'置顶'}}</td>
            <td>{{$v->is_nev==1?'√':'×'}}</td>
			<td>
            @if($v->limg)
            	<img src="{{env('UPLOADS_URL')}}{{$v->limg}}" width="100px">
            @endif
            </td>
            <td>{{date("Y-m-d H:i:s",$v->ltime)}}</td>
			<td>
            <a href="{{url('lian/edit/'.$v->lid)}}">
                <button type="button" class="btn btn-danger">修改</button>
            </a> 
            <a href="javascript:void(0);">
                <button type="button" class="btn btn-danger" id="{{$v->lid}}">删除</button>
            </a>
            </td>
		</tr>
	</tbody>
    @endforeach
</table>
{{$lian->appends(['lname'=>$lname,'tname'=>$tname])->links()}}
</body>
</html>
<script>
// $(function(){
//     $(document).on('click','.btn-danger',function(){
//         // alert(22);
//         var id=$(this).attr('id');
//         var obj=$(this);
//         // alert(id);
//         if(confirm('确定删除吗！！')){
//             $.get('/lian/destroy/'+id,function(res){
//                 if(res.code=='0'){
//                     location.href="/lian";
//                 }
//             },'json')
//         }
//     })
// })
$.ajaxSetup({
    headers:{
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
$(function(){
    $(document).on('click','.btn-danger',function(){
        var id=$(this).attr('id');
        if(confirm('确认删除')){
            $.post('lian/destroy/'+id,function(res){
                if(res.code=='0'){
                    location.reload();
                }
            },'json')
        }
    })
})
    

</script>