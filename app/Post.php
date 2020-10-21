<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    public function case(){
	  	return $this->belongsTo(Cas::class,'case_id');
	}
	
    public function user(){
	  	return $this->belongsTo(User::class,'user_id');
	}
	public function bit(){
	    return $this->hasMany(PostBit::class,'post_id');
	}
}
