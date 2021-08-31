<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSectionStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('section_students', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('section_id');
            $table->unsignedBigInteger('student_id');
            $table->unsignedBigInteger('course_id');
            $table->integer('first_mark')->unsigned()->nullable(true);
            $table->integer('mid_mark')->unsigned()->nullable(true);
            $table->integer('final_mark')->unsigned()->nullable(true);
            $table->foreign('student_id')->references('id')->on('students')
                ->onUpdate('cascade')->onDelete('cascade');
                $table->foreign('section_id')->references('id')->on('sections')
                ->onUpdate('cascade')->onDelete('cascade');
                $table->foreign('course_id')->references('id')->on('courses')
                ->onUpdate('cascade')->onDelete('cascade');
                $table->timestamps();


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('section_students');
    }
}
