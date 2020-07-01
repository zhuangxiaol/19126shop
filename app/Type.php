<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    // //指定的表名
    protected $table = 'type';
    //指定的主键
    protected $primaryKey = 'tid';
    //不自动添加时间
    public $timestamps = false;
    //黑名单
    protected $guarded=[];
}
