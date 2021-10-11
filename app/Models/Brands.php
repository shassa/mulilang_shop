<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Brands extends Model
{
    protected $fillable=['vendor_id','translation_lang','name','translation_of','photo'];

    public function getPhotoAttribute($val){
        return $val!=null ? asset('storage/app/public/'.$val):" ";
    }

    public function vendor(){
        return $this->belongsTo(Vendors::class);
    }

    public function products(){
        return $this->hasMany(Product::class)->where("translation_lang",getdefultlang());
    }

    public function brands(){
        return $this->hasMany(self::class,'translation_of');
    }
}
