<?php

namespace App\Model;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
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
        if(!file_exists('assets/backend/image/staff/pic/'.$this->picture)){
            return asset('assets/backend/image/no-img.png');
        }
        return asset('assets/backend/image/staff/pic/'.$this->picture);
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
    public function can_access($permission){
        $eccept_role = [0=>'admin',1=>'staff'];
        $role = $eccept_role[$this->role];
        if(is_array($permission)){
            if(in_array($role,$permission)){
                return true;
            }
        }else{
            if($role===$permission){
                return true;
            }
        }
        return false;
    }
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
}
