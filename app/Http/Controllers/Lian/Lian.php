<?php

namespace App\Http\Controllers\Lian;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Lian as LModel;
use App\Type as TModel;
use Illuminate\Validation\Rule;
use App\Http\Requests\StoreBrandPost;
use Validator;

class Lian extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //搜索
        $lname=request()->lname;
        $tname=request()->tname;
        // dump($lname);
        $where=[];
        if($lname){
            $where[]=['lname','like',"%$lname%"];
        }
        if($tname){
            $where[]=['tname','like',"%$tname%"];
        }
        //分页
        $pageSize=config('app.pageSize');
        //展示
        $lian=LModel::select('lian.*','type.tname')
        ->leftjoin('type','lian.tid','=','type.tid')
        ->where($where)
        ->paginate($pageSize);
        $type=TModel::get();
        return view('Lian/lian/index',['lian'=>$lian,'type'=>$type,'lname'=>$lname,'tname'=>$tname]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //添加表单
        $type=TModel::get();
        return view('Lian/lian/create',['type'=>$type]);
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
        //表单验证
        $validatedData = $request->validate([
            // 'lname' => 'regex:/^[\x{4e00}-\x{9fa5}\w-]{2，15}$/u|unique:lian', 
            'lname' => 'required|unique:lian', 
            'tid' => 'required', 
            'is_up' => 'required', 
            'is_nev' => 'required', 
        ],[
            'lname.required'=>'文章标题需要由中文,字母，数字，下划线长度2-15位组成',
            'lname.unique'=>'文章标题已有',
            'tid.required'=>'文章分类不能为空',
            'is_up.required'=>'文章的重要性不能为空',
            'is_nev.required'=>'是否显示不能为空'
        ]);
        //判断有无文件上传
        if($request->hasFile('limg')){
            //文件上传
            $limg=upload('limg');
        }
         //实例化
         $lian=new LModel();
         //添加
         $lian->lname=$request->lname;
         $lian->tid=$request->tid;
         $lian->is_up=$request->is_up;
         $lian->is_nev=$request->is_nev;
         $lian->lwriter=$request->lwriter;
         $lian->lemail=$request->lemail;
         $lian->lkeyw=$request->lkeyw;
         $lian->ldesc=$request->ldesc;
         //判断图片
         if(isset($limg)){
            $lian->limg=$limg;
        }
        $lian['ltime']=time();
         $res=$lian->save();
        //  dd($res);
         if($res){
             return redirect('lian');
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
        $lian=LModel::find($id);
        $type=TModel::get();
        return view('lian/lian/edit',['lian'=>$lian,'type'=>$type]);
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
         //表单验证
         $validatedData = $request->validate([
           'lname' => [ 
                'required', 
                Rule::unique('lian')->ignore($id,'lid'),
            ], 
            'tid' => 'required', 
            'is_up' => 'required', 
            'is_nev' => 'required', 
        ],[
            'lname.required'=>'文章标题不能为空',
            'lname.unique'=>'文章标题已有',
            'tid.required'=>'文章分类不能为空',
            'is_up.required'=>'文章的重要性不能为空',
            'is_nev.required'=>'是否显示不能为空'
        ]);
        //判断有无文件上传
        if($request->hasFile('limg')){
            //文件上传
            $limg=upload('limg');
        }
         //实例化
         $lian=new LModel();
         $lian=LModel::find($id);
         //添加
         $lian->lname=$request->lname;
         $lian->tid=$request->tid;
         $lian->is_up=$request->is_up;
         $lian->is_nev=$request->is_nev;
         $lian->lwriter=$request->lwriter;
         $lian->lemail=$request->lemail;
         $lian->lkeyw=$request->lkeyw;
         $lian->ldesc=$request->ldesc;
         //判断图片
         if(isset($limg)){
            $lian->limg=$limg;
        }
        $lian['ltime']=time();
         $res=$lian->save();
        //  dd($res);
         if($res!=false){
             return redirect('lian');
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
        $res=LModel::destroy($id);
        if($res){
            echo json_encode(['code'=>'0','msg'=>'删除成功！']);exit;
        }
        // $lian=LModel::find($id);
        // // dd($lian);
        // $res=$lian->delete();
        // // dd($res);
        // if($res){
        //     return redirect('lian');
        // }
    }
    //检查名称唯一性
    public function checkname(){
        $lname=request()->lname;
        $count=LModel::where('lname',$lname)->count();
        return json_encode(['code'=>'0','count'=>$count]);
    }
}
