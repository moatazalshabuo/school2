<?php

namespace App\Http\Controllers;

use App\Models\academic_year;
use App\Models\SubjectClass;
use App\Models\Teacher;
use App\Models\TecherClass;
use App\Models\StudentGrade;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TeacherClassController extends Controller
{
    public function index(){

        $year = academic_year::where('status',1)->get()[0]->id;
        
        $Teachers = TecherClass::select('tech_id',DB::raw('min(academic_year_id) as academic_year_id'))->where('academic_year_id',$year)->groupBy('tech_id')->get();
       
        return view('pages.Teachers.TeacherClass',compact('Teachers'));
    }

    public function create(){
        $year = academic_year::where('status',1)->get();
        $subject = SubjectClass::all();
        $Teachers = Teacher::all();
        return view('pages.Teachers.AddTeacherClass',compact('year','subject','Teachers'));
    }

    public function store(Request $request){
        $request->validate([
            'List_Classes.*.teacher'=>'required',
            'List_Classes.*.subject'=>'required',
            'List_Classes.*.class'=>'required',
            'List_Classes.*.academy'=>'required',
        ]);

        // dd($request);die();
        $list = $request->List_Classes;
        foreach($list as $val){
            TecherClass::create([
                'tech_id'=>$val['teacher'], 
                'section_id'=>$val['class'], 
                'subjec_class_id'=>$val['subject'], 
                'academic_year_id'=>$val['academy']
            ]);
        }
        toastr()->success(trans('messages.success'));
        return redirect()->back();
    }

    public function my_courses(){
        return view('pages.Teachers.dashboard.MyCourses');
    }

    public function showGrades($subjectClassId)
    {
        $grades = StudentGrade::where('subject_class_id', $subjectClassId)
            ->with(['student', 'subjectClass', 'academicYear', 'teacher'])
            ->get();

        return view('pages.show_grades', compact('grades'));
    }
}
