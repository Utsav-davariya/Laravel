<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    // use HasUuids;   //generate 36 character long id
    // use HasUlids;   //generate 26 character long id
  

    //  protected $table = "users_data";  // change datatable name
    //  protected $primaryKey = "user_id";  // change id name in table
    //   public $incrementing = false; //store string value also
    //   protected $keyType = "string";   // must define for string
    // public $timestamps = false;     //if we doesn't need  timestaps column in migration

    // protected $dateFormate = "U";    // change date formate
    // const CREATED_AT = "creation_date";  // change name of field
    // const UPDATED_AT = "updated_date";

    // protected $attributes = [   // can set default value
    //     'name'=>'default',
    //     'email'=> 'default@gmail.com',
    // ] ;

    // protected $connection = 'sqlite';   // we can use sqlite for this model


    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     *
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
