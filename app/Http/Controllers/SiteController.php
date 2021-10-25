<?php

namespace App\Http\Controllers;

use App\Models\Brands;

use App\Models\Product;
use App\Models\SubCategories;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class SiteController extends Controller
{
    public function cart(){
        return view('front.site.cart');
    }

    public function wishlist(){
        return view('front.site.wishlist');
    }

    public function sitepage(){
        $brands = Brands::with('products')->get();
        $slider=Product::where('is_slider',1)->get();
        // $wishlist= Wishlist::where('user_id',Auth::user()->id)->get();
        return view('front.site.home',compact('brands','slider'));
    }

    public function setlang($abbr){
        if (array_key_exists($abbr, Config::get('language'))) {
           Session::put('applocale', $abbr);
        }
        return Redirect::back();
         }

    public function categorypage(SubCategories $category){
       $brands=$category->brands;
    //    return $brands;
       return view('front.site.category',compact('brands'));
    }

    public function productpage(Product $product){
       $category=SubCategories::where('id',Brands::where('id',$product->brand_id)->first()->subcategory_id)->first();
    //    return $category->products;
        return view('front.site.product',compact('product','category'));
     }
}
