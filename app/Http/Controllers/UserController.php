<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function showUsers()
    {
        $users = DB::table("users")
            // ->pluck('name','email') ;       //plunk is return data in array
            // ->pluck('name','email') ;   //key value pair               // fetch data in json formate
            // ->select('name', 'email')
            // ->distinct()                       //if any dulicate value so show only one time
            // ->where('name','admin')
            // ->where('email','admin@gmail.com')

            // ->where('name','like','n%') // start with use n%  | end with use %n
            // ->where([
            //     ['name','=','admin'],
            //     ['email','=','admin@gmail.com'],
            // ])

            // ->where('name','=','admin')
            // ->orWhere('email','like','n%')
            // ->orWhere('email','like','s%')
            //  ->orWhere('role','=','user')

            // ->whereBetween('id',[2,5])  // numeric | date  // in range
            // ->whereNotBetween('id',[2,4])   // not that only out of range
            // ->whereIn('id',[1,3,5])       // only specific
            // ->whereNotIn('id',[1,3,5])      // only out of range
            // ->whereNull('email')           // only null value get
            // ->whereNotNull('email')
            // ->whereDate('created_at','2024-08-07')      // only that date
            // ->whereMonth('created_at','8')
            // ->whereDay("created_at","07")
            // ->whereYear("created_at","2024")
            // ->whereTime('created_at','06:50:06')
            // ->orderBy('name')                //order by asc
            // ->orderBy("id",'desc')            // orcer by desc
            // ->limit(5)       ->take(10)   // only that
            // ->offset(2)      ->skip(2)    // skip above


            // ->paginate(4)//not use get
            // ->paginate(5,['name','email'],'p',2) // 5 record ,onlu name ,email ,url page name = p , 2 page defult on load
            // ->appends(['sort'=> 'votes']);  //apend data on url
            // ->fragment('users');    //#users in url after page=2

            // ->simplePaginate(4);     //use normal
            ->orderBy("id")
            ->cursorPaginate(4);

        // ->get();    //not use in pagination

        return view("showusers", ['data' => $users]);


        // ->first()
        // ->latest()
        // ->oldest()
        //  ->inRandomOrder()

        // ->count();
        // ->max("id");
        // ->min("id");
        // ->average("id");
        // ->sum("id");
        // return $users;






    }

    public function single(string $id)
    {
        $users = DB::table("users")->where('id', $id)->get();
        return view('singleuser', ['data' => $users]);
    }

    public function adduser()
    {
        $user = DB::table('users')
            // ->insert([           // dsata insert unique only
            //     [
            //         'name' => 'akshat',
            //         'email' => 'akshat@gmail.com',
            //         'role' => 'user',
            //         'password' =>bcrypt('akshat@gmail.com'),
            //         'created_at' => now(),
            //         'updated_at' => now()
            //     ],
            //     [
            //         'name' => 'bakshat',
            //         'email' => 'bakshat@gmail.com',
            //         'role' => 'user',
            //         'password' => bcrypt('bakshat@gmail.com'),
            //         'created_at' => now(),
            //         'updated_at' => now()
            //     ]
            //     ]);

            // ->insertOrIgnore([      // if exists show msg not add if data fisrt time so add
            //     [
            //         'name'=> 'rajat dalal',
            //         'email'=> 'rajatdalal@gmail.com',
            //         'role'=> 'user',
            //         'password'=> bcrypt('rajatdalal@gmail.com'),
            //     ]
            // ]);

            // ->upsert(       // 2 parameter   // update exists value in data ,  based on unique value like email
            //     [
            //         'name' => 'majat kalal',
            //         'email' => 'rajatdalal@gmail.com',  //if email unique then add data if exist then update
            //         'role' => 'admin',
            //         'password' => bcrypt('rajatdalal@gmail.com'),
            //     ],
            //     ['email'],
            //     ['name']        // if third parameter then only change that data not any other
            // );

            // ->insertGetId(       // insert and return only id of the data
            //     [
            //        'name'=> 'rajat dalal',
            //         'email'=> 'rajatdalal@gmail.com',
            //         'role'=> 'user',
            //         'password'=> bcrypt('rajatdalal@gmail.com'),
            //     ]
            //  return $users // online down
            // );


        ;
        if ($user) {
            echo "<h1>data success</h1>";
        } else {
            echo "<h1> data not add </h1>";
        }
    }


    public function updateuser()
    {
        $user = DB::table('users')
            // ->where('id', 24)
            // ->update([
            //     'name' => 'lalat fulal',
            //     'email' => 'lalatfulal@gmail.com',
            //     'password' => bcrypt('lalatfulal@gmail.com'),
            // ]);


            // ->updateOrInsert(       // if data exist as second parameter then update otherwise insert new
            //     [

            //         'email' => 'vajat@gmail.com',
            //         'password'=>bcrypt('vajat@gmail.com'),

            //     ],
            //     [
            //         'name'=> 'vajat',
            //     ]
            // );


            // ->where('id', 10);
            // ->increment('id',3); //('id') //only integer increment by default 1
            // ->decrement('id',4,['city' => 'delhi']); //decrement data by given value and in third parameter we can change any value of tha data
            // ->incrementEach([    // increment multi value and decrementEach is decrese value
            //     'age'=>5,
            //     'votes'=> 10,
            // ]);

        ;
        if ($user) {
            echo "<h1>data success</h1>";
        } else {
            echo "<h1> data not add </h1>";
        }
    }

    public function deleteuser(string $id)
    {
        $user = DB::table("users")
            ->where('id', $id)
            ->delete()


        ;
        if ($user) {
            return redirect()->route('show.user');
        } else {
            echo "<h1> data not add </h1>";
        }
    }

    // public function deleteAll(){     //delete all record with id
    //     $user = DB::table("users")
    //         ->truncate();
    // }

}
