<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    protected $fillable=['name','address','quantity','product_id','vendor_id','brand_id'];

    public function vendor(){
        return $this->belongsTo(Vendors::class);
    }

    public function products()
    {
        return $this->belongsToMany(Product::class,'store_products');
    }
}
