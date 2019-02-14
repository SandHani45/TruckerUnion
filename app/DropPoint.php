<?php

namespace App;
use App\User;
use Illuminate\Database\Eloquent\Model;

class DropPoint extends Model
{
    protected $table = 'drop_points';
    
	protected $fillable = [
		'name','phone_number','address','city'
	];
    protected $hidden = [
        'created_at', 'updated_at',
    ];
    public function user()
    {
    	return $this->belongsTo(User::class); 
    }

    public function timings()
    {
      return $this->hasMany('App\Timing');
    }
    
    public function favorite()
    {
      return $this->hasMany('App\Favorite');
    }

    public function activeRoots()
    {
        return $this->hasMany('App\ActiveRoot');
    }

}
