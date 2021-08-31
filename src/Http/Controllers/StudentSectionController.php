<?php

namespace VueSystem\School\Http\Controllers;

use App\Http\Controllers\Controller;

use App\Models\Course;
use App\Models\SectionStudent;
use App\Models\Student;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Inertia\Inertia;


class StudentSectionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $students= Student::all();
        $courses = Course::all();
        $teachers= Teacher::all();
        $section= $request;
        return Inertia::render('Admin/Section/AddStudent',[
            'students'=>$students,
            'courses'=>$courses,
            'section'=>$section,
            'teachers'=>$teachers,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         $student = SectionStudent::select('student_id')->where('student_id',$request['student_id'])
         ->where('course_id',$request['course_id'])->first();
         if($student==null){
            SectionStudent::create([
                'section_id' => $request['section_id'],
                'student_id' => $request['student_id'],
                 'course_id'=>$request['course_id']]);

            return redirect()->route('sections.index')->with('success', 'Created a new Student');
         }
         else{
            return redirect()->route('sections.index')->with('error', 'Student alredy exist');

         }



    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $section_id = $id;
        $students_id = SectionStudent::select('student_id')->where('section_id',$id)->get();
        $students = array();
        foreach($students_id as $id){

            $student = Student::find($id);
            array_push($students, $student);
        }


        return Inertia::render('Admin/Section/Show',[
            'students' => $students,
            'section_id'=>$section_id

        ]);

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
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($student_id,$section_id)
    {
        SectionStudent::select('id')->where('student_id',$student_id)->where('section_id',$section_id)->delete();
        return redirect()->route('sectionStudents.show',$section_id)->with('success', 'Deleted Section');
    }
}
