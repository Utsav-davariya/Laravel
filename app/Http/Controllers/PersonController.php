<?php

namespace App\Http\Controllers;

use App\Models\Person;
use App\Models\Contact;
use Illuminate\Http\Request;

class PersonController extends Controller
{

    public function index()
    {


        $persons = Person::with('contact')->get();
        // $persons = Person::with('contact')->find(2);
        // $persons = Person::with('contact')
        //         ->where('gender','Female')
        //         ->get();

        // $persons = Person::where('gender', 'Female')             // serch on own table not forign
        //     ->withWhereHas('contact', function ($query) {       //  search from second table use withWhereHas and return from both table
        //     // ->WhereHas('contact', function ($query) {       //  search both but show only first table use WhereHas
        //     //     $query->where('city', 'mumbai');
        //     })
        //     ->get();

//// one to many //////////
        // $persons = Person::find(4);
        // $contacts = $persons->contact;

        // $persons = Person::doesntHave("contact")->get();
        // $persons = Person::has("contact")
        //           ->withCount("contact")

        // $persons = Person::select(['name','age'])
        //     ->withCount("contact")
        //      ->get();



//// many to many //////////
        return $persons;

    }


    public function create()
    {
        // $person = Person::create([      //create first table data
        //     'name'=> 'bumrah',
        //     'age'=> '35',
        //     'gender'=> 'Male'
        // ]);

        // $person->contact()->create([    //create second table data
        //     'email'=>'bumrah@gmail.com',
        //     'phone'=> '5522448833',
        //     'address'=> 'sector-36',
        //     'city'=> 'gujrat',
        // ]);

 // one to many create method////////////////////
        $person = Person::find(4);
        $person->contact()->createMany([[
          'email'=>'rashid@gmail.com',
            'phone'=> '1256897463',
            'address'=> 'rp sigh garden',
            'city'=> 'UP',
        ],
        [
            'email'=>'riyan@gmail.com',
            'phone'=> '7853698214',
            'address'=> 'A-78 old town road',
            'city'=> 'kerla',
        ]]);

    }

       public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
