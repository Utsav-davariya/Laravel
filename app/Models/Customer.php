<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Customer extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = "customers";
    protected $primarykey = "id";


    public function getNameAttribute()      //accessors     // data modify when data get
    {
        return ucfirst($this->attributes['name']);      //update upercase first letter
    }

    public function setNameAttribute($value){       // data modify when data set first time
        $this->attributes["name"] = ucfirst($value);
    }
}
