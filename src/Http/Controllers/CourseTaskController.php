<?php

namespace VueSystem\School\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\TaskStoreRequest;
use App\Http\Requests\TaskUpdateRequest;

use Illuminate\Support\Facades\Storage;
use App\Models\Task;
use App\Models\Section;
use App\Models\SectionStudent;
use App\Models\StudentTask;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CourseTaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request,$id)
    {
        $section=Section::findOrFail($id);
        $tasks=$section->tasks()->get();
        return Inertia::render('Teacher/Tasks/Show',compact(['tasks']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $id=$request->id;
        return Inertia::render('Teacher/Tasks/Create',compact(['id']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TaskStoreRequest $request)
    {
        $request->validate([
            'url_file' => 'mimes:pdf,ppt|max:50000'
         ]);
        $section_id=(int)$request['section_id'];
        $task = new Task;
        if($request->file()) {
            $file_name = time().'_'.$request->url_file->getClientOriginalName();
             $request->file('url_file')->storeAs('uploads', $file_name, 'public');
            $task->name = $request['name'];
            $task->description = $request['description'];
            $task->section_id = $request['section_id'];
            $task->url_file = $file_name;
            $task->save();
            $studentMarks = SectionStudent::where('section_id',$request['section_id'])->get();
             Storage::url($file_name);
            foreach($studentMarks as $studentMark){
                StudentTask::create([
                    'student_id' => $studentMark->student_id,
                    'task_id' => $task->id,
                ]);
            }
            return redirect()->route('courseTask.show',$section_id)->with('success', 'Created a new task');

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
        $section=Section::findOrFail($id);
        $tasks=$section->tasks()->get();
        return Inertia::render('Teacher/Tasks/Show',compact(['tasks','id']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($section_id,$task_id)
    {
       $task = Task::where('id',$task_id)->where('section_id',$section_id)->get();
        return Inertia::render('Teacher/Tasks/Edit',[
              'task'=>$task[0],
        ]);

    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(TaskUpdateRequest $request)
    {
        $section_id = $request['section_id'];
        $task = Task::where('id',$request['task_id']);
        $task->update([
            'name' => $request['name'],
            'description' => $request['description'],
            'url_file' => $request['url_file'],
        ]);

        return redirect()->route('courseTask.show',$section_id)->with('success', 'Created a new task');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy( $id)
    {
        $task = Task::where('id',$id)->first();
        $section_id = $task->section_id;
        $task->delete();
        return redirect()->route('courseTask.show',$section_id)->with('success', 'Deleted course');
    }
    /**
     *download file
     *@param string $url_file
     *@author Razan hayajneh <razanhasan896@gmail.com>
     *@return \Illuminate\Http\Response
     */
    public function downloadFile($section_id,$url_file){

        $path =storage_path("app\\public\\uploads\\".$url_file);
        return response()->download($path);
    }
}
