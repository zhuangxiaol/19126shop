<?php
 //单文件上传
function upload($filename){
    $file=request()->file($filename);
    if($file->isValid()){
        $path=$file->store('uploads');
        return $path;
    }
    exit('文件上传过程出错');
}
//无限极分类
function createTree($data,$pid=0,$level=0){
    if(!$data) return;

    static $newArray=[];
    foreach($data as $v){
        if($v->pid==$pid){
            $v->level=$level;
            $newArray[]=$v;
            createTree($data,$v->cate_id,$level+1);
        }
    }
    return $newArray;
}
function Moreupload($filename){
		
    $files = request()->$filename;

    //dd($files);

    if(!count($files)){
    
        return;
    
    }
    
    foreach($files as $k=>$v){
    
        $path[] = $v->store('uploads');
    
    }
    
       return $path;
    
    }