<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Cookie;

class IndexLogin
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
        $member=$request->session()->get('member');
        if(!$member){
            //七天免登录
            $result=Cookie::get('member');
            if($result){
                request()->session()->put('member',unserialize($result));
            }else{
                return redirect('/login');
            }
        }
        return $next($request);
    }
}
