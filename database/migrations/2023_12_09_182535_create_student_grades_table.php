<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentGradesTable extends Migration
{
    
    public function up()
    {
        Schema::create('student_grades', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('student_id');
            $table->unsignedBigInteger('subject_class_id');
            $table->unsignedBigInteger('academic_year_id');
            $table->unsignedBigInteger('teacher_id');
            $table->double('grade');
            $table->string('created_by');
            $table->timestamps();

            $table->foreign('student_id')->references('id')->on('students');
            $table->foreign('subject_class_id')->references('id')->on('subject_class');
            $table->foreign('academic_year_id')->references('id')->on('academic_years');
            $table->foreign('teacher_id')->references('id')->on('teachers');
            
        });
    }

    /**
     * إلغاء تنفيذ العمليات الوحدة للهجرة.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('student_grades');
    }
}
