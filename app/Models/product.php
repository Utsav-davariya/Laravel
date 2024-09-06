<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    /**
     * Write code on Method
     *

     */
    public $table = "products";
    protected $fillable = [
        'name', 'detail'
    ];
    // public $timestapms = false;  //if wanna time stamps false


    public function setNameAttribute($value){       // data modify when data set first time
        $this->attributes["name"] = ucfirst($value);
    }

    // public function getNameAttribute()      //accessors     // data modify when data get
    // {
    //     return ucfirst($this->attributes['name']);      //update upercase first letter
    // }
}
