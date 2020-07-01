<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Goods as Goodss;
use App\Brand as Brands;
use App\Category as Cate;;
use Illuminate\Validation\Rule;
use App\Http\Requests\StoreBrandPost;
use Validator;
class Goods extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //列表展示
        $brand=Brands::get();
        $category=Cate::get();
        $goods=Goodss::select('goods.*','category.cate_name','brand.brand_name')
        ->leftjoin('brand','goods.brand_id','=','brand.brand_id')
        ->leftjoin('category','goods.cate_id','=','category.cate_id')
        ->get();
        // dd($goods);
        return view("admin/goods/index",['goods'=>$goods]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //添加表单
        $category=Cate::get();
        $brand=Brands::get();
        return view("admin/goods/create",['category'=>$category,'brand'=>$brand]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $post = $request->except('_token');
        //dd($post);
        //表单验证
        $validatedData = $request->validate([
            'goods_name' => 'required|unique:goods', 
            'goods_price' => 'required', 
            'goods_desc' => 'required', 
            'goods_num' => 'required',
            'goods_score' => 'required', 
        ],[
            'goods_name.required'=>'商品名称不能为空',
            'goods_name.unique'=>'商品名称已有',
            'goods_price.required'=>'商品价格不能为空',
            'goods_desc.required'=>'商品详情不能为空',
            'goods_num.required'=>'商品库存不能为空',
            'goods_score.required'=>'商品数量不能为空'
        ]);

		//文件上传
		if($request->hasFile('goods_img')){
            //echo '有文件上传';
            $post['goods_img'] = upload('goods_img');
		}
		//多文件上传
		if(isset($post['goods_imgs'])){
            $post['goods_imgs'] = Moreupload('goods_imgs');
            $post['goods_imgs'] = implode('|',$post['goods_imgs']);
		}
		$goods = new Goodss();
		$res = $goods::insert($post);
		if($res){
		    return redirect('/goods');
		
		}
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //修改展示
        $goods=Goodss::find($id);
        
        $goodsInfo=new Goodss();
        $category=Cate::get();
        $brand=Brands::get();
        $goodsInfo=$goods->get();
        return view('admin/goods/edit',['goods'=>$goods,'category'=>$category,'brand'=>$brand]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //修改的方法
        //表单验证
        $validatedData = $request->validate([
            'goods_name' => [ 
                'required', 
                Rule::unique('lian')->ignore($id,'goods_id'),
            ],
            'goods_price' => 'required', 
            'goods_desc' => 'required', 
            'goods_num' => 'required',
            'goods_score' => 'required', 
        ],[
            'goods_name.required'=>'商品名称不能为空',
            'goods_name.unique'=>'商品名称已有',
            'goods_price.required'=>'商品价格不能为空',
            'goods_desc.required'=>'商品详情不能为空',
            'goods_num.required'=>'商品库存不能为空',
            'goods_score.required'=>'商品数量不能为空'
        ]);
        //判断有无上传文件
        if($request->hasFile('goods_img')){
            //文件上传
            $goods_img = upload('goods_img');
        }
        //添加的方法
        $goods=Goodss::find($id);
         
        $goods->goods_name=$request->goods_name;
        $goods->goods_price=$request->goods_price;
        $goods->goods_desc=$request->goods_desc;
        $goods->goods_num=$request->goods_num;
        $goods->goods_score=$request->goods_score;
        if(isset($goods_img)){
            $goods->goods_img=$goods_img;
        }
        // $goods->goods_imgs=$goods_imgs;
        $goods->is_new=$request->is_new;
        $goods->is_hot=$request->is_hot;
        $goods->is_best=$request->is_best;
        $goods->is_up=$request->is_up;
        $goods->brand_id=$request->brand_id;
        $goods->cate_id=$request->cate_id;
       
        $res=$goods->save();
        // dd($res);
        if($res!=false){
            return redirect('goods');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //删除的方法
        //删除
        $res=Goodss::destroy($id);
        if($res){
            echo json_encode(['code'=>'0','msg'=>'删除成功！']);exit;
        }
        // $goods=Goodss::find($id);
        // $res=$goods->delete();
        // // dd($res);
        // if($res){
        //     return redirect("goods");
        // }
    }
    //检查名称唯一性
    public function checkname(){
        $goods_name=request()->goods_name;
        $count=Goodss::where('goods_name',$goods_name)->count();
        return json_encode(['code'=>'0','count'=>$count]);
    }
}
