<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Chitietthuoc extends Model
{
    protected $table = 'chitietthuoc';
    protected $fillable = [
        'toathuoc_id', 'tenthuoc', 'soluong', 'dangthuoc', 'moingay', 'moilan', 'buoi'
    ];
    public $timestamps = false;
}
