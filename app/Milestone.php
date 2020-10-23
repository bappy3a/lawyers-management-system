<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Milestone extends Model
{
    public function hare(){
	    return $this->belongsTo(Hare::class,'hire_id');
	}
}
