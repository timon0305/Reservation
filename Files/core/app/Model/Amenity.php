<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Amenity extends Model
{
   use SoftDeletes;
   public function roomType(){
       return $this->belongsToMany(RoomType::class,'room_type_pivot_amenity','amenity_id','room_type_id');
   }
}
