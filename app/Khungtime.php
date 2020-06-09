<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Khungtime extends Model
{
    protected $table = 'khungthoigian';
    protected $fillable = [
        'timestart', 'timeend'
    ];
    public $timestamps = false;
}
