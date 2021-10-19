<?php

namespace App\Http\Controllers;

use App\Models\Brands;
use App\Models\Language;
use App\Models\MainCategories;
use App\Models\Product;
use App\Models\SubCategories;
use Illuminate\Support\Facades\Config;

class SiteController extends Controller
{
    public function cart(){
        return view('front.site.cart');
    }

    public function sitepage(){
        $brands = Brands::with('products')->get();
        $slider=Product::where('is_slider',1)->get();
        // return $brands[0]->products[0]->id;
        return view('front.site.home',compact('brands','slider'));
    }

    public function setlang(Language $lang){
        Config::set('app.locale',$lang->abbr);
        $brands = Brands::with('products')->get();
        $slider=Product::where('is_slider',1)->get();
        return view('front.site.home',compact('brands','slider'));
    }

    public function categorypage(SubCategories $category){
       $brands=$category->brands;
    //    return $brands;
       return view('front.site.category',compact('brands'));
    }
}
