<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Floor extends Model
{
    use SoftDeletes;
    public function room(){
        return $this->hasMany(Room::class,'floor_id');
    }
}
