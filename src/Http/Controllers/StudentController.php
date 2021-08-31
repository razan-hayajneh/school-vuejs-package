<?php

namespace VueSystem\School\Http\Controllers;

use App\Http\Controllers\Controller;

use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\StudentStoreRequest;
use App\Http\Requests\StudentUpdateRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Inertia\Inertia;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $queries = ['search'];

        return Inertia::render('Admin/Student/Index', [
            'students' => Student::filter($request->only($queries))->paginate()->withQueryString(),
            'filters' => $request->all($queries),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render('Admin/Student/Create');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StudentStoreRequest $request)
    {
             DB::beginTransaction();
             try {
                User::create([
                    'name' => $request['full_name'],
                    'email' => $request['email'],
                    'password' => Hash::make('12345678'),
                    'role'=> 'student',
                ]);

             Student::create([
            'full_name' => $request['full_name'],
            'phone' => $request['phone'],
            'email' => $request['email'],
            'student_level' => $request['student_level']]);

                DB::commit();

            } catch (\Exception $e) {
                DB::rollback();
                dd("fail");
            }



        return redirect()->route('students.index')->with('success', 'Created a new Student');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function show(Student $student)
    {
        return Inertia::render('Admin/Student/Show', compact('student'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function edit(Student $student)
    {
        return Inertia::render('Admin/Student/Edit', compact('student'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function update(StudentUpdateRequest $request, Student $student)
    {
        DB::beginTransaction();
        try {
            User::where('email',$student->email)
             ->update([
               'name' => $request['full_name'],
           ]);

           $student->update([
       'full_name' => $request['full_name'],
       'phone' => $request['phone'],
       'student_level' => $request['student_level'],

    ]);


           DB::commit();

       } catch (\Exception $e) {
           DB::rollback();
           echo "Not Updated";
       }

       return redirect()->route('students.index')->with('success', 'Updated Student');



    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function destroy(Student $student)
    {

        DB::beginTransaction();
        try {
        $student->delete();
        User::where('email',$student->email)->delete();
        DB::commit();

    } catch (\Exception $e) {
        DB::rollback();
    }

    return redirect()->route('students.index')->with('success', 'Deleted Student');
    }
}
