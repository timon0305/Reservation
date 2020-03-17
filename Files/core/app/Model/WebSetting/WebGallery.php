<?php

namespace App\Model\WebSetting;

use Illuminate\Database\Eloquent\Model;

class WebGallery extends Model
{
    public function category(){
        return $this->belongsTo(WebGalleryCategory::class,'category_id');
    }
}
