<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lian extends Model
{
      // //指定的表名
      protected $table = 'lian';
      //指定的主键
      protected $primaryKey = 'lid';
      //不自动添加时间
      public $timestamps = false;
      //黑名单
      protected $guarded=[];
}
