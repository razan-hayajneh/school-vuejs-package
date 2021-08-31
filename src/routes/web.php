<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::group(['namespace'=>'VueSystem\School\Http\Controllers'],function(){

    Route::get('/', HomeController::class)->name('home');

    Route::get('/welcome', function () {
        return Inertia::render('Welcome');
    })->name('welcome');


    Route::prefix('/admin')->middleware(['auth:sanctum', 'verified'])->group(function () {
        Route::get('/dashboard', function () {
            return Inertia::render('Dashboard');
        })->name('dashboard');

        Route::resource('users', UserController::class);
        Route::resource('students', StudentController::class);
        Route::resource('teachers', TeacherController::class);
        Route::resource('courses', CourseController::class);
        Route::resource('courseTask', CourseTaskController::class);
        Route::resource('sections', SectionController::class);
        Route::resource('sectionStudents', StudentSectionController::class);
        Route::resource('teacherCourses', CourseTeacherController::class);
    });
    Route::resource('courseTask', CourseTaskController::class);
    Route::get('files/{section_id}/{url_file}/download', [CourseTaskController::class,'downloadFile'])->name('downloadFile');
    Route::get('/edit-student-mark/{section_id}/{student_id}', [EditStudentMarkController::class,'edit'])->name('editStudentMark');
    Route::put('/edited-student-mark/{section_id}/{student_id}', [EditStudentMarkController::class,'update'])->name('editedStudentMark');
    Route::get('/edit-task/{section_id}/{task_id}', [CourseTaskController::class,'edit'])->name('editTask');
    Route::put('/update-task/{task}', [CourseTaskController::class,'update'])->name('updateTask');
    Route::get('/create-task/{id}', [CourseTaskController::class,'create'])->name('createTask');
    Route::post('/created-task/{id}', [CourseTaskController::class,'store'])->name('createdTask');
    Route::delete('/delete-student/{student_id}/{section_id}', [StudentSectionController::class,'destroy'])->name('deleteStudent');

    Route::post('/created-task', [CourseTaskController::class,'store'])->name('createdTask');
    Route::resource('courseStudent', CourseStudentController::class);
  });


