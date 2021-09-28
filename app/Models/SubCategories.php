<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubCategories extends Model
{
    protected $table="sub_categories";
    protected $fillable=['id','category_id','translation_lang','name','translation_of','photo','active'];

    public function scopeSelection($quary){//localscope
        return $quary->select('id','category_id','name','translation_lang','translation_of','photo','active');
     }

     public function getActive(){
         return $this->active ?'مفعل':'غير مفعل';
     }

     public function getPhotoAttribute($val){
         return $val!=null ? asset('storage/app/public/'.$val):" ";
     }

     public function subCategories(){//translation
         return $this->hasMany(self::class,'translation_of');
     }

     public function maincategory(){
         return $this->belongsTo(MainCategories::class,'category_id','id');
     }

}
