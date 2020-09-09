<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    public function user(){
	  	return $this->belongsTo(User::class,'user_id');
	}
    public function lowyer(){
	  	return $this->belongsTo(User::class,'lawyer_id');
	}
}
