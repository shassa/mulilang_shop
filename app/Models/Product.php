<?php

namespace App\Models;

use App\Orders;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{

    protected $fillable=['price','name','photo','brand_id','translation_lang'];
    public function getPhotoAttribute($val){
        return $val!=null ? asset('storage/app/public/'.$val):" ";
    }

    public function products(){
        return $this->hasMany(self::class,'translation_of');
    }

    public function brand(){
        return $this->belongsTo(Brands::class);
    }

    public function stores()
    {
        return $this->belongsToMany(Store::class,'store_products')->withPivot('quantity');
    }

    public function orders()
    {
        return $this->belongsToMany(Orders::class,'order_products','order_id','product_id')->withPivot('quantity');
    }

}
