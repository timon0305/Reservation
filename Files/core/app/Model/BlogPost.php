<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class BlogPost extends Model
{
    protected $guarded =['id'];
    protected  $table = 'posts';
    protected $fillable=['cat_id','title','image','thumb','details','status','hit'];
    public function category(){
        return $this->belongsTo(BlogCategory::class,'cat_id');
    }
}
