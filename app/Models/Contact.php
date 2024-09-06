<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    protected $guarded = [];    // entry can in all filed
    public $timestamps = false;

    public function person(){       // inverse relation
        return $this->belongsTo(Person::class);
    }

}
