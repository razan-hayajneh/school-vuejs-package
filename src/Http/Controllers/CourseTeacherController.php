<?php
namespace VueSystem\School\Http\Controllers;

use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Arr;
use App\Models\Teacher;
use App\Models\SectionStudent;

use App\Models\Student;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CourseTeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user=Auth::user();
        $teacher=Teacher::where('email','=',$user->email)->first();

        $sections=$teacher->sections()->get();
        $courses=array([]);

        foreach($sections as $section){

            $courses=Arr::add($courses,$section->id,$section->courses()->first());
        }
        return Inertia::render('Teacher/Courses/Index',compact(['sections','courses']));
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
        $studentMarks = SectionStudent::where('section_id',$id)->get();
        $students = array();
        foreach($studentMarks as $studentMark){
            $students =Arr::add($students, $studentMark->student_id, Student::find($studentMark->student_id));
        }
        return Inertia::render('Teacher/Courses/Show',compact(['students','studentMarks']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function edit($id)
    {


    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
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
