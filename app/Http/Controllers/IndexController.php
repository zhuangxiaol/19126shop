<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class IndexController extends Controller
{
    //
    public function index(){
        // echo "我是测试";
        return view("form");
    }
    public function add(){
        echo "提交成功";
    }

    // //cookie测试
    // //设置cookie
    // public function setcookie(){
    //     //第一种
    //     return response('欢迎来到 Laravel 学院')->cookie( 'user', '学院君', 1 );
    //     //第二种
    //     // Cookie::queue(Cookie::make('user', '庄啸龙', 1));
    //     //第三种
    //     // Cookie::queue('user', '万万', 1);
    // }

    // //取cookie
    // public function getcookie(Request $request){
    //     //第一种
    //     // dd($request->cookie('user'));
    //     //第二种
    //     dd(Cookie::get('user'));
    // }
}
