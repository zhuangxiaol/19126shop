<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Links as LModel;
use Illuminate\Validation\Rule;
use App\Http\Requests\StoreBrandPost;
use Validator;

class Links extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //搜索
        $l_name=request()->l_name;
        // dump($l_name);
        $where=[];
        if($l_name){
            $where[]=['l_name','like',"%$l_name%"];
        }
        //分页
        $pageSize=config('app.pageSize');
        //展示
        $links=LModel::where($where)->paginate($pageSize);
        return view('admin/links/index',['links'=>$links,'l_name'=>$l_name]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //添加的表单
        return view('admin/links/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //添加的方法
        //表单验证1
        $validatedData = $request->validate([
            'l_name' => 'required|unique:links', 
            'l_web' => 'required', 
        ],[
            'l_name.required'=>'网站名称不能为空',
            'l_name.unique'=>'网站名称已有',
            'l_web.required'=>'网站网址不能为空'
        ]);
        //判断有无文件上传
        if($request->hasFile('l_img')){
            //文件上传
            $l_img=upload('l_img');
        }
        //实例化
        $links=new LModel();
        //添加
        $links->l_name=$request->l_name;
        $links->l_web=$request->l_web;
        $links->is_up=$request->is_up;
        //判断图片
        if(isset($l_img)){
            $links->l_img=$l_img;
        }
        $links->l_site=$request->l_site;
        $links->l_desc=$request->l_desc;
        $links->is_nav=$request->is_nav;
        $res=$links->save();
        // dd($res);
        if($res){
            return redirect('links');
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
        //修改表单
        $links=LModel::find($id);
        return view('admin/links/edit',['links'=>$links]);
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
        //修改方法
         //表单验证1
        $validatedData = $request->validate([ 
            'l_name' => [ 
                'required', 
                Rule::unique('links')->ignore($id,'l_id'),
            ], 
            'l_web' => 'required', 
        ],[
            'l_name.required'=>'网站名称不能为空',
            'l_name.unique'=>'网站名称已有',
            'l_web.required'=>'网站网址不能为空'
        ]);
        //判断有无文件上传
        if($request->hasFile('l_img')){
            //文件上传
            $l_img=upload('l_img');
        }
        //实例化
        $links=new LModel();
        //修改
        $links=LModel::find($id);
        $links->l_name=$request->l_name;
        $links->l_web=$request->l_web;
        $links->is_up=$request->is_up;
        //判断图片
        if(isset($l_img)){
            $links->l_img=$l_img;
        }
        $links->l_site=$request->l_site;
        $links->l_desc=$request->l_desc;
        $links->is_nav=$request->is_nav;
        $res=$links->save();
        // dd($res);
        if($res!=false){
            return redirect('links');
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
        $links=LModel::find($id);
        // dd($links);
        $res=$links->delete();
        // dd($res);
        if($res){
            return redirect('links');
        }

    }
}
