<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Phongkham extends Model
{
    protected $table = 'phongkham';
    protected $fillable = [
        'user_id', 'tencs', 'ngaycp', 'tenbs', 'nsbs', 'gioitinhbs', 'trinhdo_id', 'chuyenkhoa_id', 'noicongtac_id', 'diachi', 'iframe_map', 'sodtpk', 'khung1_id','khung2_id', 'khung3_id', 'timetb', 'layout', 'vido', 'kinhdo' 
    ];
    public $timestamps = false;
}
