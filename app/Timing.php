<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Timing extends Model
{
     protected $fillable = [
        'drop_point_id', 'day', 'start_time','end_time'
    ];
     protected $hidden = [
        'id','updated_at', 'created_at','status'
    ];
}
