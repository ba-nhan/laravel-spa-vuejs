<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Benhnhan extends Model
{
    protected $table = 'benhnhan';
    protected $fillable = [
        'tenbn', 'gioitinhbn', 'namsinhbn', 'sodtbn', 'socmbn', 'diachibn','user_id'
    ];
    public $timestamps = false;
}
