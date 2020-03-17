<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class ReservationNight extends Model
{
    protected $dates = ['check_in','check_out'];
   public function reservation(){
       return $this->belongsTo(Reservation::class,'reservation_id');
   }
   public function room(){
       return $this->belongsTo(Room::class,'room_id');
   }
}
