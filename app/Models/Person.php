<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    use HasFactory;
    protected $guarded = [];    // entry can in all filed
    public $timestamps = false;
    protected $table = 'persons'; // Change to the correct table name

    public function contact()
    { 
        // return $this->hasOne(Contact::class);       //one to one relationship
        return $this->hasMany(Contact::class);       //one to many relationship
    }


}
