<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Goods extends Model
{
    //指定的表名
    protected $table = 'goods';
    //指定的主键
    protected $primaryKey = 'goods_id';
    //不自动添加时间
    public $timestamps = false;
}
