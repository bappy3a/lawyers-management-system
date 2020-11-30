<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Hare extends Model
{
    public function case(){
        return $this->belongsTo(Cas::class,'case_id');
    }

    public function lawyer(){
        return $this->belongsTo(User::class,'lowyer_id');
    }

    public function cleint(){
        return $this->belongsTo(User::class,'client_id');
    }
}
