<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Toathuoc extends Model
{
    protected $table = 'toathuoc';
    protected $fillable = [
        'phieukham_id', 'chuandoan', 'loidan', 'thoigiandt', 'taikham'
    ];
    public $timestamps = false;
}
