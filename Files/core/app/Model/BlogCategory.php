<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class BlogCategory extends Model
{
    protected  $table = 'categories';
    protected $guarded =['id'];
    protected $fillable=['name','status'];
    public function post(){
        return $this->hasMany(BlogPost::class,'cat_id');
    }
}
