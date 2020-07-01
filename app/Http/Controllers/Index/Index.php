<?php

namespace App\Http\Controllers\Index;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Redis;
use App\Goods;
use App\Admin;
use App\Category;

class Index extends Controller
{
    //
    public function index(){
        $slice=Cache::get('slice');
        // $slice=Reids::get('slice');
        if(!$slice){
            // echo "DB==";
            //首页幻灯片数据读取
            $where=[
                'is_up'=>1,
                'is_index_postion'=>1
            ];
            $slice=Goods::select('goods_id','goods.goods_img')->where($where)->take(5)
            ->orderBy('goods_id','desc')
            ->get();
            // dd($slice);
            Cache::put('slice',$slice,60*60);
            // $slice=serialize($slize);
            // Reids::setex('slice',24*60*60,$slice);
        }
       
        $topcate=Cache::get('topcate');
        if(!$topcate){
            // echo "DB==top";
            //顶级分类
            $where=[
                'pid'=>0
            ];
            $topcate=Category::where($where)
            ->take(4)
            ->get();
            Cache::put('topcate',$topcate,7*24*60*60);
        }
        
        $hot=Cache::get('hot');
        if(!$hot){
            //  echo "DB==hot";
            //商品详情
            $where=[
                'is_up'=>1,
                'is_hot'=>1
            ];
            $hot = Goods::where($where)->take(8)->get();
            //dd($shop);
            Cache::put('hot',$hot,30*60);
        }
           
        return view("index/index",compact('slice','topcate','hot'));
    }
}
