<?php

namespace App;

use App\Models\Product;
use Illuminate\Database\Eloquent\Model;

class Wishlist extends Model
{

    protected $fillable=['name','user_id'];


    public function user(){
        return $this->belongsTo(User::class);
    }

    public function products()
    {
        return $this->belongsToMany(Product::class,'products_wishlists','wishlist_id','products_id');
    }
}
