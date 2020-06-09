<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Thuoc extends Model
{
    
    protected $table = 'thuoc';
    protected $fillable = [
        'name'
    ];
    public $timestamps = false;
}
