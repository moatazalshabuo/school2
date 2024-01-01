<?php

namespace App\Http\Controllers;

use App\Models\Grade;
use App\Models\Student;
use Illuminate\Http\Request;

class StudentSectionsController extends Controller
{
    public function index()
    {
        $Grades = Grade::all();
        $grade_id = !empty(request('Grade_id')) ? request('Grade_id') : false;
        $class_id = !empty(request('Classroom_id')) ? request('Classroom_id') : false;
        $section_id = !empty(request('section_id')) ? request('section_id') : false;
        $query = Student::query();
        if ($grade_id) {
            $query->where('Grade_id', $grade_id);
        }
        if ($class_id) {
            $query->where('Classroom_id', $class_id);
        }
        if ($section_id) {
            $query->where('section_id', $section_id);
        }
        $students = ($grade_id ==false)?[]:$query->get();
        return view('pages.Students.section-student', compact('students', 'Grades','grade_id','class_id','section_id'));
    }
    //
}
