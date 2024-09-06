<?php

namespace App\Http\Controllers;

use App\Models\employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $employee = employee::get();
        // return $employee->roles;

        foreach ($employee as $emp) {
            echo $emp->name . "<br>";
            echo $emp->email . "<br>";
             foreach ($emp->roles as $role) {
            echo  $role->role_name . "/ ";

        }
        echo "<hr>";
        }



    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // $employee = employee::find(5);
        // $roles=[1,3];
        // $employee->roles()->attach($roles);      // add employee role

        // $employee = employee::find(5);
        // $roles=[3];
        // $employee->roles()->detach($roles);     //delete role


        $employee = employee::find(5);
        $roles=[3];
        $employee->roles()->sync($roles);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // $employees= employee::with('lastrole')->find(2); //it is diffrent
        // return $employees;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
