<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HelpPost extends Model
{
    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }

    public function comments(){
	    return $this->hasMany(PostComment::class,'help_post_id');
	}
}
