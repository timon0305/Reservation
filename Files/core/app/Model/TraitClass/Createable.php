<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 12/9/2018
 * Time: 6:56 PM
 */

namespace App\Model\TraitClass;


trait Createable
{
    public static function bootCreateable()
    {
        static::saved(function ($model) {
            if(!$model->createdBy()){
                $user = auth_user();
                $codeable = new \App\Model\Createable();
                $codeable->createable_id = $model->id;
                $codeable->createable_type =get_class($model);
                $codeable->user_class =get_class($user);
                $codeable->user_id =$user->id;
                $codeable->save();
            }
        });
    }
    public function createable()
    {
        return $this->morphOne(\App\Model\Createable::class, 'createable');
    }

    public function createdBy(){
        if($this->createable){
            return  app($this->createable->user_class)->where('id',$this->createable->user_id)->latest()->first();
        }
        return null;
    }
}