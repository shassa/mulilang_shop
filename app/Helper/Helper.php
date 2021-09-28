<?php
  
  use Illuminate\Support\Facades\Config;

 function getdefultlang(){
    return  Config::get('app.locale');
 }

 function activelang(){
    return \App\Models\language::selection()->where('active',1)->get();
 }

 function uploadphoto($folder,$image){
   $image->store('/', $folder);
   $filename = $image->hashName();
   $path = 'images/' . $folder . '/' . $filename;
   return $path;
 }