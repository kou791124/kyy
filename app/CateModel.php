<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CateModel extends Model
{
    protected $table = 'category';
    protected $primaryKey = 'cate_id';
    public $timestamps = false;
    protected $guarded=[];
}
