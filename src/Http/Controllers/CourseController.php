<?php
namespace VueSystem\School\Http\Controllers;

use App\Http\Controllers\Controller;

use App\Models\Course;
use Illuminate\Http\Request;
use App\Http\Requests\CourseStoreRequest;
use App\Http\Requests\CourseUpdateRequest;
use Inertia\Inertia;

class CourseController extends Controller
{
      /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $queries = ['search'];

        return Inertia::render('Admin/Course/Index', [
            'courses' => Course::filter($request->only($queries))->paginate()->withQueryString(),
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
        return Inertia::render('Admin/Course/Create');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CourseStoreRequest $request)
    {
        course::create([
            'name' => $request['name'],
            'description' => $request['description'],
        ]);



        return redirect()->route('courses.index')->with('success', 'Created a new course');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function show(Course $course)
    {
        return Inertia::render('Admin/Course/Show', compact('course'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function edit(course $course)
    {
        return Inertia::render('Admin/Course/Edit', compact('course'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function update(CourseUpdateRequest $request, Course $course)
    {

        $course->update([
            'name' => $request['name'],
            'description' => $request['description']]);

            return redirect()->route('courses.index')->with('success', 'Updated course');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function destroy(Course $course)
    {
        $course->delete();

        return redirect()->route('courses.index')->with('success', 'Deleted course');
    }
}
