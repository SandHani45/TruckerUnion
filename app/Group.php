<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
	protected $table = 'groups';

    protected $fillable = [
        'name',  'password','user_id','image'
    ];

     public function GroupMember()
    {
        return $this->hasMany('App/GroupMember');
    }
}
