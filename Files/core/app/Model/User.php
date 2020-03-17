<?php

namespace App\Model;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    protected $appends =['full_name'];
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'email', 'password',
    ];
    public function getFullNameAttribute(){
        return $this->first_name.' '.$this->last_name;
    }
    public function picture_path(){
        if($this->picture === null){
            return asset('assets/backend/image/no-img.png');
        }
        return asset('assets/backend/image/guest/pic/'.$this->picture);
    }
    public function id_card_path(){
        if($this->picture === null){
            return asset('assets/backend/image/no-img.png');
        }
        return asset('assets/backend/image/guest/card_image/'.$this->id_card_image);
    }
    public function sex(){
        if($this->sex === 'M'){
            return 'Male';
        }
        if($this->sex === 'F'){
            return 'Female';
        }
        if($this->sex === 'O'){
            return 'Other';
        }
    }
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    public function reservations(){
        return $this->hasMany(Reservation::class,'user_id');
    }
    public function payment(){
        return $this->hasMany(Payment::class,'user_id')->where('status',1);
    }
}
