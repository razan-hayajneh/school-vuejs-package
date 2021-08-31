<?php

namespace VueSystem\School\Http\Controllers;

use App\Http\Controllers\Controller;

use App\Models\Teacher;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\TeacherStoreRequest;
use App\Http\Requests\TeacherUpdateRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Inertia\Inertia;

class TeacherController extends Controller
{
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
   public function index(Request $request)
   {
       $queries = ['search'];
       return Inertia::render('Admin/Teacher/Index', [
           'teachers' => Teacher::filter($request->only($queries))->paginate()->withQueryString(),
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
       return Inertia::render('Admin/Teacher/Create');

   }

   /**
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
   public function store(TeacherStoreRequest $request)
   {



    DB::beginTransaction();
    try {
       User::create([
           'name' => $request['full_name'],
           'email' => $request['email'],
           'password' => Hash::make('12345678'),
           'role'=> 'teacher',
       ]);

       Teacher::create([
        'full_name' => $request['full_name'],
        'phone' => $request['phone'],
        'office' => $request['office'],
        'email'=>$request['email']

    ]);


       DB::commit();

   } catch (\Exception $e) {
       DB::rollback();
       dd("fail");
   }
       return redirect()->route('teachers.index')->with('success', 'Created a new teacher');

   }

   /**
    * Display the specified resource.
    *
    * @param  \App\Models\Teacher  $teacher
    * @return \Illuminate\Http\Response
    */
   public function show(Teacher $teacher)
   {
       return Inertia::render('Admin/Teacher/Show', compact('teacher'));

   }

   /**
    * Show the form for editing the specified resource.
    *
    * @param  \App\Models\Teacher  $teacher
    * @return \Illuminate\Http\Response
    */
   public function edit(Teacher $teacher)
   {
       return Inertia::render('Admin/Teacher/Edit', compact('teacher'));
   }

   /**
    * Update the specified resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  \App\Models\Teacher  $teacher
    * @return \Illuminate\Http\Response
    */
   public function update(TeacherUpdateRequest $request, Teacher $teacher)
   {


    DB::beginTransaction();
    try {
        User::where('email',$teacher->email)
         ->update([
           'name' => $request['full_name'],
       ]);

       $teacher->update([
        'full_name' => $request['full_name'],
        'phone' => $request['phone'],
        'office' => $request['office']]);


       DB::commit();

   } catch (\Exception $e) {
       DB::rollback();
   }


           return redirect()->route('teachers.index')->with('success', 'Updated teacher');

   }

   /**
    * Remove the specified resource from storage.
    *
    * @param  \App\Models\Teacher  $teacher
    * @return \Illuminate\Http\Response
    */
   public function destroy(Teacher $teacher)
   {

        DB::beginTransaction();
        try {
        $teacher->delete();
        User::where('email',$teacher->email)->delete();
        DB::commit();

        } catch (\Exception $e) {
            DB::rollback();
        }

       return redirect()->route('teachers.index')->with('success', 'Deleted teacher');
   }
}
