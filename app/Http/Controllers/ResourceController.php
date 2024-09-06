<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\student;

class ResourceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $students = student::all();
        $students = student::simplePaginate(5);
        // $students = Student::where([['city',5],['age','>',50]])
        // $students = Student::whereAge(80)
        //             ->whereCity(5)
        //             ->select('name','email')
        // $students = Student::whereBetween('age',[20,50])->orderBy('age')->get();
        // $students = Student::whereNotIn('city',[2,3])->get();
        return view("resourceView.homeStudents", compact("students"));


        // $students = student::find([2,4],['name','email']); //return only array not json
        // $students = Student::count();
        // $students = Student::min('age');
        // $students = Student::max('age');
        // $students = Student::sum('age');
        // ->tosql();
        // ->dd();
        //  ->ddRawSql();
        // $students = Student::whereCity(5)
        //         ->first();
        // $students = Student::where('age','<>', 20 )
        // ->get();
        // return $students;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("resourceView.addStudent");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // $student = new student;  // with this method we need to write save

        // $student->name = $request->name;
        // $student->email = $request->email;
        // $student->age = $request->age;
        // $student->address = $request->address;

        // $student->save();
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
            'age' => 'required|numeric',
            'address' => 'required',

        ]);

        student::create([
            'name' => $request->name,
            'email' => $request->email,
            'age' => $request->age,
            'address' => $request->address,
        ]);

        return redirect()->route('resourceStudents.index')->with('status', 'new student add  ');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $students = student::findOrFail($id);

        return view("resourceView.viewStudent", compact('students'));

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $students = student::findOrFail($id);
        return view("resourceView.updateStudent", compact("students"));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // $student = student::find($id);   //find data based on id
        // $student->name = $request->name;
        // $student->email = $request->email;
        // $student->age = $request->age;
        // $student->address = $request->address;
        // $student->password = $request->password;
        // $student->save();
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
            'age' => 'required|numeric|max:100',
            'address' => 'required',

        ]);

        $student = student::where('id', $id) //mass update
            ->update([
                'name' => $request->name,
                'email' => $request->email,
                'age' => $request->age,
                'address' => $request->address,

            ]);
        return redirect()->route('resourceStudents.index')->with('status', 'student update  ');


    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // $student = student::where('id', $id)->delete();

        $student = student::findOrFail($id);
        $student->delete();

        // student::destroy( $id );
        // student::destroy( [2,3] ); // click any delete button remove this record
        // student::truncate();
        return redirect()->route('resourceStudents.index')->with('status', 'student delete  ');

    }
}
