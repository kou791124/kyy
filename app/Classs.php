<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Classs extends Model
{
    protected $table = 'class';
    protected $primaryKey = 'c_id';
    public $timestamps = false;
    protected $guarded = [];
}
