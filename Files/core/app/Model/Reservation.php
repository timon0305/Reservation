<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    public function roomType(){
        return $this->belongsTo(RoomType::class,'room_type_id');
    }
    public function statusClass(){
        if($this->status === 'PENDING'){
            return 'warning';
        }elseif($this->status === 'CANCEL'){
            return 'danger';
        }elseif($this->status === 'SUCCESS'){
            return 'success';
        }elseif($this->status === 'ONLINE_PENDING'){
            return 'secondary';
        }
    }
    public function night(){
        return $this->hasMany(ReservationNight::class,'reservation_id');
    }
    public function tax(){
        return $this->hasMany(ReservationTax::class,'reservation_id');
    }
    public function paidService(){
        return $this->hasMany(ReservationPaidService::class,'reservation_id');
    }
    public function guest(){
        return $this->belongsTo(User::class,'user_id');
    }
    public function appliedCoupon(){
        return $this->hasOne(AppliedCouponCode::class,'reservation_id');
    }
    public function payment(){
        return $this->hasMany(Payment::class,'reservetion_id')->where('status',1);
    }
    public function paymentStatus(){
        $payment = $this->payment->sum('amount');
        if($payment >0){
            if($payment < $this->payable()){
                return [
                    'color'=>'warning',
                    'status'=>'Partials'
                ];
            }else{
                return [
                    'color'=>'success',
                    'status'=>'Paid'
                ];
            }
        }else{
            return [
                'color'=>'danger',
                'status'=>'Due'
            ];
        }
    }
    public function totalPaidService(){
      return  $this->paidService->sum('price');
    }
    public function totalNightPrice(){
      return  $this->night->sum('price');
    }
    public function totalTax(){
      return  $this->tax->sum('price');
    }
    public function discount(){
        $discount = 0;

        if($coupon = $this->appliedCoupon){
            if($coupon->coupon_type === 'PERCENTAGE'){
                $night_price = $this->night->sum('price');
                $discount =  ($night_price*$coupon->coupon_rate)/100;
            }else{
                $discount =  $coupon->coupon_rate;
            }
        }
        return $discount;
    }
    public function payable(){
        $night = $this->totalNightPrice();
        $tax =$this->totalTax();
        $paid_service = $this->totalPaidService();
        $discount = $this->discount();
        return $night+$tax+$paid_service-$discount;
    }
    public function codeableName(): string
    {
        return 'reservation';
    }
}
