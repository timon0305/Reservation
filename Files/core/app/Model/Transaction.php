<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    public function gateway(){
        return $this->belongsTo(Gateway::class,'gateway_id');
    }
    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }
}
