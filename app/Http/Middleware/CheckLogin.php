<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Cookie;

class CheckLogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $admin=$request->session()->get('admin');
        if(!$admin){
            //七天免登录
            $result=Cookie::get('admin');
            if($result){
                request()->session()->put('admin',unserialize($result));
            }else{
                return redirect('/login');
            }
        }
        return $next($request);
    }
}
