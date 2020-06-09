<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Phieukham extends Model
{
    protected $table = 'phieukham';
    protected $fillable = [
        'thoigian', 'phongkham_id', 'benhnhan_id', 'khungtime_id', 'sokb'
    ];
    public $timestamps = false;
}
