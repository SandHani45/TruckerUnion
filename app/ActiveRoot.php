<?php

namespace App;
use App\User;
use Illuminate\Database\Eloquent\Model;

class ActiveRoot extends Model
{
    protected $table = 'active_roots';

    //Relationship with User
    public function user()
    {
        return $this->belongsToMany('User');
    }
    //Relationship with DropPoint
    public function dropPoints()
    {
        return $this->belongsToMany('App\DropPoint');
    }
  

}
