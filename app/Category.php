<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //指定的表名
    protected $table = 'category';
    //指定的主键
    protected $primaryKey = 'cate_id';
    //不自动添加时间
    public $timestamps = false;
}
