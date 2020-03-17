<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Room extends Model
{
    use SoftDeletes;
    public function type(){
        return $this->belongsTo(RoomType::class,'room_type_id');
    }
    public function floor(){
        return $this->belongsTo(Floor::class,'floor_id');
    }
    public function reservedRoom(){
        return $this->hasMany(ReservationNight::class,'room_id');
    }
    public function available($date){
        return  ReservationNight::where('room_id',$this->id)->whereHas('reservation',function ($q){
           $q->whereNotIn('status',['CANCEL','ONLINE_PENDING']);
       })->where('date',$date)->first();
    }
}
