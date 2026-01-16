<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Country;

class Post extends Model
{

    use HasFactory;
    protected $fillable = ['title','description','image','country_id'];

    function getCountry(){
       return $this->hasOne(Country::class,'id','country_id');
    }
}
