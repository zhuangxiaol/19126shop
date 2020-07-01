<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Category as Cate;
use Validator;
use Illuminate\Validation\Rule;
class Category extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // //session的使用
        // //存
        // session(['name'=>'zxl']);
        // request()->session()->put('number',100);
        // //取
        // echo session('name');
        // dump(request()->session()->get('number'));
        // //如果没有  设置默认值
        // dump(session('city','beij'));
        // dump(request()->session()->get('county','庄啸龙'));

        // session(['city'=>null]);
        // //检查有没有值
        // dump(request()->session()->has('city'));
        // //检查有没无此键
        // dump(request()->session()->exists('city'));

        // //删除单个
        // dump(request()->session()->forget('numder'));
        // //删除所有
        // dump(request()->session()->flush());
        // //获取所有session
        // dump(request()->session()->all());
        // exit;

        //列表展示
        $category=Cate::all();
        //无限极分类
        $category= createTree($category);
        return view("admin/category/index",['category'=>$category]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //表单展示
        $category=new Cate();
        $category=Cate::all();
        // dd($category);
        //无限极分类
        $category= createTree($category);
        return view("admin/category/create",['category'=>$category]);
    }

    

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         //表单验证
         $validator = Validator::make($request->all(),[ 
            'cate_name' => 'required|unique:category', 
            'pid' => 'required',
        ],[
            'cate_name.required'=>'分类名称不能为空',
            'cate_name.unique'=>'分类名称已有',
            'pid.required'=>'顶级分类不能为空'
        ]);
        if ($validator->fails()){
            return redirect('category/create') 
            ->withErrors($validator) 
            ->withInput(); 
        }
        //添加的方法
        $category=new Cate();
        $category->cate_name=$request->cate_name;
        $category->pid=$request->pid;
        $category->cate_nav_show=$request->cate_nav_show;
        $category->cate_show=$request->cate_show;
        $res=$category->save();
        // dd($res);
        if($res){
            return redirect('category');
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
        $cateInfo=Cate::find($id);
        $category=Cate::all();
        // //无限极分类
        $category= createTree($category);
        return view("admin/category/edit",['cateInfo'=>$cateInfo,'category'=>$category]);
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
        //表单验证
        $validator = Validator::make($request->all(),[ 
            'cate_name' => [ 
                'required', 
                 Rule::unique('category')->ignore($id,'cate_id'),
            ], 
            'pid' => 'required',
        ],[
            'cate_name.required'=>'分类名称不能为空',
            'cate_name.unique'=>'分类名称已有',
            'pid.required'=>'顶级分类不能为空'
        ]);
        if ($validator->fails()){
            return redirect('category/create') 
            ->withErrors($validator) 
            ->withInput(); 
        }
        //修改方法
        $category=Cate::find($id);
        $category->cate_name=$request->cate_name;
        $category->pid=$request->pid;
        $category->cate_nav_show=$request->cate_nav_show;
        $category->cate_show=$request->cate_show;
        $res=$category->save();
        // dd($res);
        if($res!=false){
            return redirect("category");
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
        //删除方法
        //检查有没有子分类
        $count=Cate::where('pid',$id)->count();
        if($count>0){
            echo "<script>alert('该分类下有子分类,不能删除此分类');history.go(-1);</script>";exit;
        }else{
            $res=Cate::destroy($id);
            if($res){
                return redirect('category');
            }
        }
        
    }
     //检查名称唯一性
     public function checkname(){
        $cate_name=request()->cate_name;
        $count=Cate::where('cate_name',$cate_name)->count();
        return json_encode(['code'=>'0','count'=>$count]);
    }
}
