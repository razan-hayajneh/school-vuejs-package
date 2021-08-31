<?php
namespace VueSystem\School\Http\Controllers;

use App\Http\Controllers\Controller;

use App\Models\Course;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\Section;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class CourseStudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user=Auth::user();
        $student=Student::where('email','=',$user->email)->first();
        $studentSections=$student->sections()->get();
        $marks = $studentSections;
        $sections = array();

        foreach($studentSections as $section){

            $studentSection = Section::find($section->section_id);
            array_push($sections, $studentSection);
        }
        $courses = Course::all();
        $teachers = Teacher::all();
        return Inertia::render('Student/Index',compact(['sections','courses','marks','teachers']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $section=Section::findOrFail($id);
        $tasks=$section->tasks()->get();

        return Inertia::render('Student/ShowTask',compact(['tasks']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
