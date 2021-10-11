<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Vendors extends Model
{
    use Notifiable;

    protected $table='vendors';
    protected $fillable=['name','category_id','active','password','mobile','logo','email','address'];
    protected $hidden=['category_id','password'];

    public function scopeSelection($quary){
        return $quary->select('id','name','category_id','email','mobile','logo','address','active');
     }

    public function getActive(){
        return $this->active ?'مفعل':'غير مفعل';
    }

    public function getLogoAttribute($val){
        return $val!=null ? asset('storage/app/public/'.$val):" ";
    }

    public function setPasswordAttribute($password){
        $this->attributes['password']=bcrypt($password);
    }

    public function category(){
        return $this->belongsTo('App\Models\MainCategories','category_id','id');
    }

    public function brands(){
        return $this->hasMany(Brands::class)->where("translation_lang",getdefultlang());
    }

    public function stores(){
        return $this->hasMany(Store::class);
    }

}
