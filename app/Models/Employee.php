<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class employee extends Model
{
    use HasFactory;
    public function roles(){
        return $this->belongsToMany(role::class,'employee_roles');
    }

    //hasonthroght method see video////////////


    // public function lastrole(){  //it is difrent
    //     return $this->hasone(employee_role::class)->latestOfMany();  //show latest record //oldest//largest//smallest
    // }
}

