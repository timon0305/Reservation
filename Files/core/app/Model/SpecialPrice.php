<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class SpecialPrice extends Model
{
    public function getDayByRegularPrice($day){
        $day_col ='day_'.$day;
        $amount_col =$day_col.'_amount';
        return [
            'amount_type'=>$this->$day_col,
            'amount'=>$this->$amount_col

        ];
    }
}
