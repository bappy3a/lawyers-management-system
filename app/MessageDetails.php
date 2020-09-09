<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MessageDetails extends Model
{
    public function user(){
        return $this->belongsTo(User::class,'from');
    }
}
