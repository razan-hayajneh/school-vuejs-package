<?php

namespace VueSystem\School\Http\Controllers;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Teacher;
use App\Models\Course;
use App\Models\Section;


use Inertia\Inertia;

class SectionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $teachers= Teacher::all();
        $courses = Course::all();
        $queries = ['search'];
        return Inertia::render('Admin/Section/Index', [
            'sections' => Section::filter($request->only($queries))->paginate()->withQueryString(),
            'filters' => $request->all($queries),
            'teachers'=>$teachers,
            'courses'=>$courses,
        ]);



    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {

        $teachers= Teacher::all();
        $courses = Course::all();
        return Inertia::render('Admin/Section/Create',[
            'teachers'=>$teachers,
            'courses'=>$courses,
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

        $section = Section::where('section_number',$request['section_number'])->where('course_id',$request['course_id'])->first();

        if($section==null){

        Section::create([
            'section_number' => $request['section_number'],
            'course_id' => $request['course_id'],
            'teacher_id' => $request['teacher_id']]);

        return redirect()->route('sections.index')->with('success', 'Created a new Student');
        }
        else{
            return redirect()->route('sections.index')->with('error', 'Created a new Student');

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


    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Section $section)
    {
        $teachers= Teacher::all();
        $courses = Course::all();
        return Inertia::render('Admin/Section/Edit',[
            'teachers'=>$teachers,
            'courses'=>$courses,
            'section'=>$section,
        ]);

    }



    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Section $section)
    {

        $sections = Section::where('section_number',$request['section_number'])->where('course_id',$request['course_id'])->first();

        if($sections==null){
        $section->update([
            'section_number' => $request['section_number'],
            'course_id' => $request['course_id'],
            'teacher_id' => $request['teacher_id'],

         ]);
         return redirect()->route('sections.index')->with('success', 'Updated Section');
        }
        else{
            return redirect()->route('sections.index')->with('success', 'Updated Section');

        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Section $section)
    {
        $section->delete();
        return redirect()->route('sections.index')->with('success', 'Deleted Section');

    }
}
