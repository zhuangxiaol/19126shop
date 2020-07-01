<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    //指定的表名
    protected $table = 'brand';
    //指定的主键
    protected $primaryKey = 'brand_id';
    //不自动添加时间
    public $timestamps = false;
}
