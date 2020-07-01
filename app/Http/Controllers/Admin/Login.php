<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Admin;
use Illuminate\Support\Facades\Cookie;

class Login extends Controller{

    public function logindo(Request $request){
        $post=$request->all();
        // dd($post);
        //先根据有户名查询记录
        $admin=Admin::where('admin_name',$post['admin_name'])->first();
        // dd($admin);
        if(!$admin){
            return redirect('/login')->with('msg','用户名或密码不对');
        }
        //解密密码跟$post的对比是否一致
        if(decrypt($admin->admin_pwd)!=$post['admin_pwd']){
            return redirect('/login')->with('msg','用户名或密码不对');
        }
        request()->session()->put('admin',$admin);

        //七天免登录
        if(isset($post['rember'])){
            //七天免登录
            Cookie::queue('admin',serialize($admin),60*24*7);
        }
        return redirect('/admin');
    }
}
