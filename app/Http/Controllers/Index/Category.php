<?php

namespace App\Http\Controllers\Index;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Category as Cate;
use App\Goods;

class Category extends Controller{
    //
    public function index($cate_id,$type=1){
        $orderfield='is_new';
        if($type==2){
            $orderfield='goods_num';
        }
        if($type==3){
            $orderfield='goods_price';
        }
        $category=Cate::all();
        $cate_ids=createTree($category,$cate_id);
        $cate_ids=json_decode(json_encode($cate_ids),true);
        $cate_ids=array_column($cate_ids,'cate_id');
        array_unshift($cate_ids,$cate_id);
        // dd($cate_ids);
        $goods=Goods::where(['is_up'=>1])
        ->whereIn('cate_id',$cate_ids)
        ->orderBy($orderfield,'desc')
        ->get();
        // dd($goods);
        return view('index/list',['goods'=>$goods,'cate_id'=>$cate_id,'type'=>$type]);
    }
}
