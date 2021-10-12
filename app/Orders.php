<?php

namespace App;

use App\Models\Product;
use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    //

    protected $fillable=['is_paid','hashcode','total','payment_method','user_id'];


    public function user(){
        return $this->belongsTo(User::class);
    }

    public function products()
    {
        return $this->belongsToMany(Product::class,'order_products','order_id','product_id')->withPivot('quantity');
    }

}
