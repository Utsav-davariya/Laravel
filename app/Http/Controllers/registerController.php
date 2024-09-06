<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    public function showRegistrationForm()
    { 
        return view('register');
    }

    public function register(RegisterRequest $request)
    {
        // $validator = Validator::make($request->all(), [            // validation using request method and rule also be using request method
        //     'name' => 'required|string|max:20|min:2',
        //     'email' => 'required|string|email|max:255|unique:users',
        //     'password' => 'required|string|min:8|confirmed',
        // ],[
        //     'name' => 'Name Is Empty Please Fill It !',
        //     'email' => 'Email Is Empty Please Fill It !',
        //     'password' => 'Password Must Required !'
        // ]);

        // if ($validator->fails()) {
        //     return redirect()->back()->withErrors($validator->errors())->withInput();
        // }

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        return redirect('/login');
        // return $request->only('name','email');   // only this field
        // return $request->except('password');   //skip this field
    }
}
