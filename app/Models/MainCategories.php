<?php

namespace App\Models;

use App\Observers\MainCategoriesObserver;
use Illuminate\Database\Eloquent\Model;

class MainCategories extends Model
{
    protected $table="main_categories";
    protected $fillable=['id','translation_lang','name','translation_of','photo','active'];

    protected static function boot()
    {
        parent::boot();
        MainCategories::observe(MainCategoriesObserver::class);
    }

    public function scopeSelection($quary){//localscope
       return $quary->select('id','name','translation_lang','translation_of','photo','active');
    }

    public function getActive(){
        return $this->active ?'مفعل':'غير مفعل';
    }

    public function getPhotoAttribute($val){
        return $val!=null ? asset('storage/app/public/'.$val):" ";
    }

    public function categories(){
        return $this->hasMany(self::class,'translation_of');
    }

    public function vendors(){
        return $this->hasMany('App\Models\Vendors','category_id','id');
    }

    public function subCategoeies(){
        return $this->hasMany(SubCategories::class,'category_id','id')->where("translation_lang",getdefultlang());
    }
}
