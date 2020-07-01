<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Student extends Controller
{
    //学生列表
    public function list(){
        echo "学生列表";
    }

    //学生添加
    public function create(Request $request){
        //判断请求方式
        $method = $request->method();
        // print_r($method);
        if($method=='POST'){
            $post=$request->all();
            // dump($post);exit;
            return redirect('/');
        }
        return view("create",['name'=>'庄啸龙']);
        // return view("create");
    }

    //学生添加接值
    public function store(){
        $post=request()->except('_token');
        print_r($post);
    }
    
    //必选参数
    public function user($id,$name){
        echo '控制器的方法:'.$id;
        
        echo '控制器的名字:'.$name;
    }

    //可选参数
    public function goods($id,$name=null){
        echo '控制器的方法:'.$id;
        echo '控制器的名字:'.$name;
        // print_r($name);exit;
    }
    //数组练习
    public function zbc(){
        //添加第一种
        $arr=array(1,2,3,4,5);
        // // print_r($arr);
        // $err=array('90');
        // array_splice($arr,2,0,$err);
        // // print_r($arr);

        //删除第一种
        unset($arr[3]);
        print_r($arr);

        //删除的第二种
    }
    public function wq(){
        $array=[1,2,3,4,5];
        $this->addarray($array);
        // $this->addarray1($array);
        
    }
    //添加的第二种
    public function addArray1($array){
        if(!count($array)){
            return;
        }
        foreach($array as $k=>$v){
            if($v==3){
                $len=$k;
            }
        }
        $array2=[90];
        array_splice($array,$len,0,$array2);
        print_r($array);
    }
    public function addarray($array){
        if(!count($array)){
            return;
        }
        foreach($array as $k=>$v){
            if($v==3){
                $len=$k;
            }
        }
        $n_array=array_chunk($array,$len);
        // print_r($n_array);exit;
        list($a1,$a2,$a3)=$n_array;
        if(in_array(3,$a1)){
            array_unshift($a1,90);
        }
        if(in_array(3,$a2)){
            array_unshift($a2,90);
        }
        if(in_array(3,$a3)){
            array_unshift($a3,90);
        }
        $array=array_merge($a1,$a2,$a3);
        print_r($array);
    }
    public function qwe(){
        $array=[1,2,3,4,5,7];
        foreach($array as $k=>$v){
            if($k%2==1){
                echo $v."<br>";
            }
        }
    }
}
