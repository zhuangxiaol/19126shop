<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Admin as Amodel;
use Validator;
use Illuminate\Validation\Rule;
class Admin extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    //管理员展示
    public function index()
    {
        //搜索
        $admin_name=request()->admin_name;
        // dump($admin_name);
        $where=[];
        if($admin_name){
            $where[]=['admin_name','like',"%$admin_name%"];
        }
        $pageSize=config('app.pageSize');
        //展示
        $admin=AModel::where($where)->paginate($pageSize);
        // dd($admin);
        return view('admin/admin/index',['admin'=>$admin,'admin_name'=>$admin_name]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //添加的表单
        return view("admin/admin/create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    //添加方法
    public function store(Request $request)
    {
        //表单验证
        $validator = Validator::make($request->all(),[ 
            'admin_name' => 'required|unique:admin', 
            'admin_pwd' => 'required',
        ],[
            'admin_name.required'=>'管理员名称不能为空',
            'admin_name.unique'=>'管理员名称已有',
            'admin_pwd.required'=>'管理员密码不能为空'
        ]);
        if ($validator->fails()){
            return redirect('admin/create') 
            ->withErrors($validator) 
            ->withInput(); 
        }
        //判断有无上传文件
        if($request->hasFile('admin_img')){
            //文件上传
            $admin_img= upload('admin_img');
        }
        $admin=new AModel();
        $admin->admin_name=$request->admin_name;
        $admin->admin_pwd=encrypt($request->admin_pwd);
        if(isset($admin_img)){
            $admin->admin_img=$admin_img;
        }
        $res=$admin->save();
        // dd($res);
        if($res){
            return redirect('admin');
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
    //修改展示
    public function edit($id)
    {
        $admin=AModel::find($id);
        return view("admin/admin/edit",['admin'=>$admin]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    //修改方法
    public function update(Request $request, $id)
    {
        //表单验证
        $validator = Validator::make($request->all(),[ 
            'admin_name' => [ 
                'required', 
                 Rule::unique('admin')->ignore($id,'admin_id'),
            ], 
            'admin_pwd' => 'required',
        ],[
            'admin_name.required'=>'管理员名称不能为空',
            'admin_name.unique'=>'管理员名称已有',
            'admin_pwd.required'=>'管理员密码不能为空'
        ]);
        if ($validator->fails()){
            return redirect('admin/edit/'.$id) 
            ->withErrors($validator) 
            ->withInput(); 
        }
        //判断有无上传文件
        if($request->hasFile('admin_img')){
            //文件上传
            $admin_img=upload('admin_img');
        }
        $admin = AModel::find($id);
        $admin->admin_name=$request->admin_name;
        $admin->admin_pwd=encrypt($request->admin_pwd);
        if(isset($admin_img)){
            $admin->admin_img=$admin_img;
        }
        $res=$admin->save();
        // dd($res);
        if($res!=false){
            return redirect('admin');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    //删除
    public function destroy($id)
    {
        //删除
        $res=AModel::destroy($id);
        if($res){
            echo json_encode(['code'=>'0','msg'=>'删除成功！']);exit;
        }
        // $admin=AModel::find($id);
        // // dd($admin);
        // $res=$admin->delete();
        // // dd($res);
        // if($res){
        //     return redirect("admin");
        // }
    }
    //检查名称唯一性
    public function checkname(){
        $admin_name=request()->admin_name;
        $count=AModel::where('admin_name',$admin_name)->count();
        return json_encode(['code'=>'0','count'=>$count]);
    }
}
