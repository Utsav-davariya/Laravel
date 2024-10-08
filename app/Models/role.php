<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class role extends Model
{
    use HasFactory;

    public function employee(){
        return $this->belongsToMany(employee::class,'employee_roles'); 
    }
}
