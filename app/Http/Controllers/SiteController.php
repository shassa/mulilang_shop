<?php

namespace App\Http\Controllers;

use App\Models\Language;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;

class SiteController extends Controller
{
    public function sitepage(){
        return view('front.site.home');
    }

    public function defultLang($lang){
        Config::set('app.locale',$lang);
        return view('front.site.home');
    }
}
