<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
//商品的品牌
Route::domain('1912shop')->group(function(){
//品牌模块的增删查改
Route::prefix('brand')->middleware('checklogin')->group(function(){
    //添加的表单
    Route::get('create/','Admin\Brand@create');
    //添加的方法
    Route::post('store/','Admin\Brand@store');
    //列表展示
    Route::get('/','Admin\Brand@index');
    //删除
    // Route::get('destroy/{id}','Admin\Brand@destroy');
    Route::post('destroy/{id}','Admin\Brand@destroy');
    //修改的表单
    Route::get('edit/{id}','Admin\Brand@edit');
    //修改的方法
    Route::post('update/{id}','Admin\Brand@update');
    //验证
    Route::get('/checkname','Admin\Brand@checkname');
});

//商品的分类
Route::prefix('category')->middleware('checklogin')->group(function(){
    //添加的表单
    Route::get('create','Admin\category@create');
    //添加的方法
    Route::post('store/','Admin\category@store');
    //列表展示
    Route::get('/','Admin\category@index');
    //删除
    Route::get('destroy/{id}','Admin\category@destroy');
    //修改展示
    Route::get('edit/{id}','Admin\category@edit');
    //修改方法
    Route::post('update/{id}','Admin\category@update');
    //验证
    Route::get('/checkname','Admin\category@checkname');
});
//商品的添加
Route::prefix('goods')->middleware('checklogin')->group(function(){
    //添加的表单
    Route::get('create','Admin\goods@create');
    //添加的方法
    Route::post('store/','Admin\goods@store');
    //列表展示
    Route::get('/','Admin\goods@index');
    //删除
    // Route::get('destroy/{id}','Admin\goods@destroy');
    Route::post('destroy/{id}','Admin\goods@destroy');
    //修改展示
    Route::get('edit/{id}','Admin\goods@edit');
    //修改方法
    Route::post('update/{id}','Admin\goods@update');
     //验证
     Route::get('/checkname','Admin\goods@checkname');
});
//管理员的添加
Route::prefix('admin')->middleware('checklogin')->group(function(){
    //添加的表单
    Route::get('create','Admin\admin@create');
    //添加的方法
    Route::post('store/','Admin\admin@store');
    //列表展示
    Route::get('/','Admin\admin@index');
    //删除
    // Route::get('destroy/{id}','Admin\admin@destroy');
    Route::post('destroy/{id}','Admin\admin@destroy');
    //修改展示
    Route::get('edit/{id}','Admin\admin@edit');
    //修改方法
    Route::post('update/{id}','Admin\admin@update');
     //验证
     Route::get('/checkname','Admin\admin@checkname');
});
//登录
    //登录的表单
    Route::view('login','admin\login');
    //登录的方法
    Route::post('logindo/','Admin\Login@logindo');
});

//友情链接的添加
Route::prefix('links')->middleware('checklogin')->group(function(){
    //添加的表单
    Route::get('create','Admin\links@create');
    //添加的方法
    Route::post('store/','Admin\links@store');
    //列表展示
    Route::get('/','Admin\links@index');
    //删除
    Route::get('destroy/{id}','Admin\links@destroy');
    //修改展示
    Route::get('edit/{id}','Admin\links@edit');
    //修改方法
    Route::post('update/{id}','Admin\links@update');
});
//添加
Route::prefix('lian')->middleware('checklogin')->group(function(){
    //添加的表单
    Route::get('create','Lian\lian@create');
    //添加的方法
    Route::post('store/','Lian\lian@store');
    //列表展示
    Route::get('/','Lian\lian@index');
    //删除
    //第一种ajax删除
    // Route::get('destroy/{id}','Lian\lian@destroy');
    //第二种ajax删除
    Route::post('destroy/{id}','Lian\lian@destroy');
    //修改展示
    Route::get('edit/{id}','Lian\lian@edit');
    //修改方法
    Route::post('update/{id}','Lian\lian@update');
    //验证
    Route::get('/checkname','Lian\lian@checkname');
    
});


//前台模板布局
Route::domain('19126shop')->group(function(){
    //前台展示
// Route::prefix('index')->middleware('indexlogin')->group(function(){
    //登录
    Route::get('/','Index\Index@index');
    Route::get('/login/','Index\Login@login');
    Route::post('/dologin/','Index\Login@dologin');
    //退出
    Route::get('logout/','Index\Login@logout');

    //注册
    Route::get('/reg/','Index\Login@reg');
    Route::get('/send/','Index\Login@send');
    Route::post('/doreg/','Index\Login@doreg');
    //分类页
    Route::get('/list/{cate_id}/{type?}','Index\Category@index');
    //详情页
    Route::get('/goods/{goods_id}','Index\Goods@index');
    //加入购物车
    Route::get('/addcart','Index\Goods@addcart');
    //购物车列表
    Route::get('/cart','Index\Goods@cart');
// });

});





















































// //cookie练习
// Route::get('setcookie','IndexController@setcookie');
// Route::get('getcookie','IndexController@getcookie');

//闭包路由
// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('/index',function(){
//     return 'hello,庄啸龙,hello,php';
// });

// //练习
// Route::get('/index','IndexController@index');
// Route::post('/add','IndexController@add');

// //学生列表
// Route::get('list','Student@list');

//学生添加
//一种路由支持多种请求方式
// Route::match(['get','post'],'create','Student@create');
// Route::any('create','Student@create');

// //学生添加接值
// // Route::post('store','Student@store');
// Route::get('zbc','Student@zbc');
// Route::get('wq','Student@wq');
// Route::get('qwe','Student@qwe');

// //路由视图
// Route::view('add','create',['name'=>'庄啸龙']);
// Route::get('add',function(){
//     return view('create',['name'=>'庄啸龙no1']);
// // });
// Route::get('add','Student@create');

// //路由重定向
// Route::redirect('/index','/create',301);

// //路由参数
// Route::get('user', function() { 
//     return '没有参数'; 
// });
//必选参数
// Route::get('user/{id}', function ($id) { 
//     return '有参数: ' . $id; 
// });
// Route::get('user/{id}/{name}','Student@user');
//可选参数
// Route::get('category/{name?}', function ($cate_id =0) { 
//     return "分类id可选参数:".$cate_id; 
// });
// Route::get('goods/{id}/{name?}','Student@goods');
// 正则约束
// // Route::get('goods/{id}','Student@goods')->where('id','[0-9]+');
// Route::get('goods/{id}/{name}','Student@goods')->where(['id'=>'[0-9]+','name'=>'[A-Za-z]+']);