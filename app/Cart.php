<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    //指定的表名
    protected $table = 'cart';
    //指定的主键
    protected $primaryKey = 'cart_id';
    //不自动添加时间
    public $timestamps = false;
    // 黑名单
    protected $guarded = [];
}
