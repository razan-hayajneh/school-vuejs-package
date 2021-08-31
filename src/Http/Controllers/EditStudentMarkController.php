<?php

namespace VueSystem\School\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Section;
use App\Models\SectionStudent;
use Inertia\Inertia;

class EditStudentMarkController extends Controller
{
    /**
     *edit on student marks
     *@param int $section_id,$student_id
     *@author Razan hayajneh <razanhasan896@gmail.com>
     *@return \Illuminate\Http\Response
     */
    public function edit($section_id,$student_id)
    {
        $section=Section::find($section_id);
        $student=SectionStudent::where('section_id','=',$section_id)->where('student_id','=',$student_id)->first();
        return Inertia::render('Teacher/Courses/Edit',compact(['student']));

    }
    public function update(Request $request,$section_id,$student_id)
    {
        $studentMark=SectionStudent::where('section_id','=',$section_id)->where('student_id','=',$student_id);
        $studentMark->update([
            'first_mark' => $request['first_mark'],
            'mid_mark' => $request['mid_mark'],
            'final_mark' => $request['final_mark']]);

        return redirect()->route('teacherCourses.show',$section_id)->with('success', 'Updated Student');

    }
}
