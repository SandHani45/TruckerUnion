<?php

namespace App;
use App\User;
use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{
     
    protected $table = 'favorites';

    protected $fillable = [
        'status'
     ];

    //Relationship with User
    public function user()
    {
        return $this->belongsToMany('App\User');
    }
    //Relationship with DropPoint
    public function dropPoints()
    {
        return $this->belongsToMany('App\DropPoint','id');
    }

}
