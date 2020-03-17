<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class ReservationPaidService extends Model
{
    public function service(){
        return $this->belongsTo(PaidService::class,'pad_service_id');
    }
}
