<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Brands extends Model
{

    public function getPhotoAttribute($val){
        return $val!=null ? asset('storage/app/public/'.$val):" ";
    }
}
