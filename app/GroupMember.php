<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GroupMember extends Model
{
	protected $table = 'group_members';

  	protected $fillable = [
        'user_id',  'group_id','status'
    ];
    
    //Relationship with Group
  
    public function group()
	{
	    return $this->belongsTo('App\Group');
	}
}
