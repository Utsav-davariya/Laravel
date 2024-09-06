<?php

namespace App\Http\Controllers;

use Illuminate\Database\Query\JoinClause;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StudentController extends Controller
{
    public function showStudent()
    {
        // $students = DB::table('students')      //table 1
        //     ->join('cities', 'students.city', '=', 'cities.id') //tbale 2 and its column and also must data type same
        //     // ->join(' ', '', '=', '') // if we need three table join then use that and define table name and cluman name and foriegn column name
        //     // ->select('students.*', 'cities.city_name')
        //     // ->where('city','=','1')     //search on student table
        //     // ->having('cities.city_name', '=', 'mumbai') // having where same
        //     ->select(DB::raw('count(*) as count'),'city_name','age')     // raw
        //     ->groupBy('city_name','age')
        //     // ->where('cities.city_name','=','mumbai')    // serch on cities table

        //     // ->having('count','>',1)
        //     ->havingBetween('count',[2,3])

        //     ->orderBy('count')

        //     ->get();
        // // return view('student', compact('students'));


        // // ->count();
        // return $students;


        $students = DB::table('students')            //left join mean left data * and right only perticular data  but in rightjoin its oposite
            ->join('cities', 'students.city', '=', 'cities.id')
            ->select('students.*', 'cities.city_name')

            ->get();
        return view('student', compact('students'));


        // $students = DB::table('students')            //advance level join
        //     ->join('cities', function (JoinClause $join) {
        //             $join->on('students.city','=','cities.id')
        //               ->where('cities.city_name','like','m%');
        //     })
        //     ->select('students.*','cities.city_name')
        //     ->get();

        // return $students;

    }

    public function uniondata()
    {
        $lecturers = DB::table('lecturers')         //table name fetch all record
            ->select('name', 'email', 'address', 'city_name')      //select column
            ->join('cities', 'lecturers.city', '=', 'cities.id')     // join with other table
            ->where('city_name', '=', 'himachal');


        $students = Db::table('students')
            ->union($lecturers)  //column and data type must be match then union work otherwise it not work
            ->select('name', 'email', 'address', 'city_name')
            ->join('cities', 'students.city', '=', 'cities.id')
            ->where('city_name', '=', 'dubai')

            // ->toSql( );
            ->get();

        return $students;
    }

    public function whendata()
    {
        $is = true;

        $lecturers = DB::table('students')
            ->when($is, function ($query) {       //when is like true or false like if else
                $query->where('age', '>', '20');
            }, function ($query) {
                $query->where('age', '<', '20');
            })
            ->get();
        return $lecturers;
    }

    public function chunkdata()
    {
        $students = DB::table('students')->orderBy('id')
            ->chunkById(3, function ($students) {
                echo "<div style='border:1px solid red;margin-bottom:15px;'>";
                foreach ($students as $student) {
                    echo $student->name . "<br>";
                    //    DB::table('students')
                    //    ->where('id', $student->id)  //find the id
                    //    ->update(['status'=>true]); //if we want to change
                }
                echo "</div>";
            });
    }



    ////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////// Raw Sql Queries /////////////////////////////////////////

    public function rawshowStudent()
    {
        // $students = DB::select("select name,age from students
        // where age > ? and name like ?",[30,'m%']);
        // where id = :id",['id' => 5]); // named binding use :


        // $students = DB::insert("insert into students (name,age,email,address,city) values(?,?,?,?,?)",["ram charan",40,"charan@gmail.com","north delhi east delhi",2]);  // 1 = success
        // $students = DB::update("update students set email = 'ramcharan@gmail.com' where id = ?",[18]);  // 1 = success
        // $students = DB::delete("delete from students where id = ?",[18]);


        // $students = DB::statement("drop table students");  // this command will no return
        // $students = DB::unprepared("delete from students where id = 15 ");  //direct write value and unsecure //this use object oriented

        $students = DB::table('students')
            ->selectRaw('count(*) as student_count,age')     // do not use '','',''  || use ' , , ,'
            // ->select(DB::raw('count(*) as student_count'),'age')   // select second method
            // ->whereRaw('age > ? and name like ?',[30,'M%'])
            // ->orderByRaw('name,age')
            ->groupByRaw('age')
            ->havingRaw('age > ?',[50])
            ->get();
            // ->toSql();

        return $students;


    }

}
