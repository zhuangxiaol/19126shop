<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Brand as Brands;
use App\Http\Requests\StoreBrandPost;
use Validator;
use Illuminate\Validation\Rule;
use DB;
//引入的Cache 门面
use Illuminate\Support\Facades\Cache;
class Brand extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $page=request()->page??1;
        echo $page;
        //展示
        //搜索
        $brand_name = request()->brand_name;
        // dump($brand_name);
        $where=[];
        if($brand_name){
            $where[]=['brand_name','like',"%$brand_name%"];
        }
        dump('brand_'.$page);
        $brand=Cache::get('brand_'.$page);
        // dump($brand);
        if(!$brand){
            // echo "Db==";
            $pageSize=config('app.pageSize');
            // DB::connection()->enableQueryLog();
            $brand=Brands::where($where)->orderBy('brand_id','desc')->paginate($pageSize);
            // $log=DB::getQueryLog();
            // dd($log);
            Cache::put('brand_'.$page,$brand,30);
        }

        
        return view("admin/brand/index",['brand'=>$brand,'brand_name'=>$brand_name]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //添加展示
        return view("admin/brand/create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    //表单验证2
    // public function store(StoreBrandPost $request)
    public function store(Request $request)
    {
        //添加方法
        // //表单验证1
        // $validatedData = $request->validate([
        //     'brand_name' => 'required|unique:brand', 
        //     'brand_url' => 'required', 
        // ],[
        //     'brand_name.required'=>'品牌名称不能为空',
        //     'brand_name.unique'=>'品牌名称已有',
        //     'brand_url.required'=>'品牌网址不能为空'
        // ]);
        //表单验证3
        $validator = Validator::make($request->all(),[ 
                'brand_name' => 'required|unique:brand', 
                'brand_url' => 'required',
            ],[
                'brand_name.required'=>'品牌名称不能为空',
                'brand_name.unique'=>'品牌名称已有',
                'brand_url.required'=>'品牌网址不能为空'
            ]);
        if ($validator->fails()){
            return redirect('brand/create') 
            ->withErrors($validator) 
            ->withInput(); 
        }

        //判断有无上传文件
        if($request->hasFile('brand_logo')){
            //文件上传
            $brand_logo= upload('brand_logo');
        }
        // $res=DB::table('brand')->insert($brand);
        $brand=new Brands();
        $brand->brand_name = $request->brand_name;
        $brand->brand_url = $request->brand_url;
        if(isset($brand_logo)){
            $brand->brand_logo=$brand_logo;
        }
        $brand->brand_desc = $request->brand_desc;
        $res=$brand->save();
        // dd($res);
        if($res){
            return redirect('brand');
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
        $brand = Brands::find($id);
        return view("admin/brand/edit",['brand'=>$brand]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
   
    public function update(Request $request, $id)
    // public function update(StoreBrandPost $request,$id)//第二种验证
    {
        //修改的方法
        // // 表单验证1
        // $validatedData = $request->validate([
        //     // 'brand_name' => 'required|unique:brand', 
        //     'brand_name' => [ 
        //         'required', 
        //         Rule::unique('brand')->ignore($id,'brand_id'),
        //     ], 
        //     'brand_url' => 'required', 
        // ],[
        //     'brand_name.required'=>'品牌名称不能为空',
        //     'brand_name.unique'=>'品牌名称已有',
        //     'brand_url.required'=>'品牌网址不能为空'
        // ]);
        //表单验证3
        $validator = Validator::make($request->all(),[ 
            'brand_name' => [ 
                'required', 
                 Rule::unique('brand')->ignore($id,'brand_id'),
            ], 
                'brand_url' => 'required',
            ],[
                'brand_name.required'=>'品牌名称不能为空',
                'brand_name.unique'=>'品牌名称已有',
                'brand_url.required'=>'品牌网址不能为空'
            ]);
        if ($validator->fails()){
            return redirect('brand/edit/'.$id) 
            ->withErrors($validator) 
            ->withInput(); 
        }

        //判断有无上传文件
        if($request->hasFile('brand_logo')){
            //文件上传
            $brand_logo=upload('brand_logo');
        }
        $brand = Brands::find($id);
        $brand->brand_name = $request->brand_name;
        $brand->brand_url = $request->brand_url;
        if(isset($brand_logo)){
            $brand->brand_logo=$brand_logo;
        }
        $brand->brand_desc = $request->brand_desc;
        
        $res=$brand->save();
        // dd($res);
        if($res!=false){
            return redirect("brand");
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
        //删除
        $res=Brands::destroy($id);
        if($res){
            echo json_encode(['code'=>'0','msg'=>'删除成功！']);exit;
        }
        // $brand = Brands::find($id); 
        // // dd($brand);
        // $res=$brand->delete();
        // // dd($res);
        // if($res){
        //     return redirect('brand');
        // }
    }
     //检查名称唯一性
     public function checkname(){
        $brand_name=request()->brand_name;
        $count=Brands::where('brand_name',$brand_name)->count();
        return json_encode(['code'=>'0','count'=>$count]);
    }
}
