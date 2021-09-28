<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
    protected $table="languages";
    protected $fillable=['abbr','name','native','local','direction','active'];

    public function scopeSelection($quary){
       return $quary->select('id','name','active','direction','abbr');
    }

    public function getActive(){
        return $this->active == 1 ? 'مفعل' :'غير مفعل' ;
    }
}
