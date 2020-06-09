<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bangtin extends Model
{
    protected $table = 'bangtin';
    protected $fillable = [
        'phongkham_id', 'tieude', 'noidung', 'thoigian'
    ];
    public $timestamps = false;
}
