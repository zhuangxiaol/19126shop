<?php

namespace App\Http\Controllers\Index;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Goods as Goodss;
use Illuminate\Support\Facades\Redis;
use App\Cart;
class Goods extends Controller
{
    public function index($goods_id){
        //浏览量
        $count=Redis::setnx('count_'.$goods_id,1)?:Redis::incr('count_'.$goods_id);
        // dd($count);
        $goods=Goodss::find($goods_id);
        return view('index/goods',['goods'=>$goods,'count'=>$count]);
    }
    //购物车列表
    public function addcart(Request $request){
        $goods_id=$request->goods_id;
        $buy_number=$request->buy_number;
        // echo $goods_id.'-'.$buy_number;
        
        // //判断  有没有登陆
    	$user = session('member');
    	// echo $user;
        if(!$user){
            echo json_encode(['code'=>00002,'msg'=>"请先登录"]);die;
        }
        // 根据商品的id查询商品表
    	$goodsInfo = Goodss::select('goods_id','goods_name','goods_price','goods_img','goods_num')
        ->where('goods_id',$goods_id)
        ->first();
        // dd($goodsInfo);
        // 根据获取到的商品信息 跟buy_number作比较
    	if($goodsInfo->goods_num<$buy_number){
    		echo json_encode(['code'=>00001,'msg'=>'商品库存不足']);die;
        }
        // 根据商品id用户id拼接where条件
        $where = [
            'user_id' => $user['m_id'],
            'goods_id' => $goods_id
        ];
        // 根据where条件查询分类表一条数据
        $cartInfo = Cart::where($where)->first();
        // dd($cartInfo);
        if($cartInfo){
            // 有值更新购买数量
            $buy_number = $cartInfo->buy_number+$buy_number;
            // dd($buy_number);
            // 判断购买数量大于商品库存 购买数量=商品库存
            if($goodsInfo->goods_num<$buy_number){
                $buy_number=$goodsInfo->goods_num;
            }
            $res = Cart::where('car_id',$cartInfo['car_id'])->update(['buy_number'=>$buy_number]);

        }else{
            // 数据库中没有此用户的购买记录 
            // 添加购物车数据
            $data = [
                'user_id' => $user['m_id'],
                'buy_number'=>$buy_number,
                'addtime'=>time()
            ];
            $data = array_merge($data,$goodsInfo->toArray());
            // dd($data);
            unset($data['goods_num']);
            // dd($data);
            $res = Cart::create($data);
        }

        if($res!=false){
            echo json_encode(['code'=>00000,'msg'=>'加入购物车成功']);die;
        }
    }
    // 购物车列表
    public function carcar(Request $request){
        return view("index/cart");
    }
}
