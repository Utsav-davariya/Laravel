<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\Person;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function show()
    {
        $contacts = Contact::with('person')->get();

        // $contacts = Contact::withWhereHas('person', function ($query) {  //search from second table
        //     $query->where('age', '>', '40');
        // })
        //     ->get();

        // $persons = Person::where('name','virat')->get();     //second method to search from second
        // $contacts = Contact::whereBelongsTo($persons)->get();

        return $contacts;   

        // foreach ($contacts as $contact) {
        //     echo"<div>
        //     <h3>$contact->email</h3>
        //     <h3>$contact->phone</h3>
        //     <h3>$contact->address</h3>
        //     <h3>$contact->city</h3>
        //      <hr>
        //     </div>";
        // }



    }
}
