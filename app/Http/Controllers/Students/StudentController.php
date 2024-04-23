<?php

namespace App\Http\Controllers\Students;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreStudentsRequest;
use App\Models\Student;
use App\Repository\StudentRepositoryInterface;
use Illuminate\Http\Request;

class StudentController extends Controller
{

    protected $Student;

    public function __construct(StudentRepositoryInterface $Student)
    {
        $this->Student = $Student;
    }


    public function index()
    {
       return $this->Student->Get_Student();
    }


    public function create()
    {
        return $this->Student->Create_Student();
    }

    public function store(StoreStudentsRequest $request)
    {
       return $this->Student->Store_Student($request);
    }

    public function show($id){

     return $this->Student->Show_Student($id);

    }


    public function edit($id)
    {
       return $this->Student->Edit_Student($id);
    }


    public function update(Request $request,$id)
    {
        $request->validate(['name_ar' => 'required',
        'name_en' => 'required',
        'email' => 'required|email|unique:students,email,'.$id,
        'gender_id' => 'required',
        'nationalitie_id' => 'required',
        'blood_id' => 'required',
        'Date_Birth' => 'required|date|date_format:Y-m-d',
        'Grade_id' => 'required',
        'Classroom_id' => 'required',
        'section_id' => 'required',]);

        return $this->Student->Update_Student($request);
    }


    public function destroy(Request $request)
    {
        return $this->Student->Delete_Student($request);
    }

    public function Get_classrooms($id)
    {
       return $this->Student->Get_classrooms($id);
    }

    public function Get_Sections($id)
    {
        return $this->Student->Get_Sections($id);
    }

    public function Upload_attachment(Request $request)
    {
        return $this->Student->Upload_attachment($request);
    }

    public function Download_attachment($studentsname,$filename)
    {
        return $this->Student->Download_attachment($studentsname,$filename);
    }

    public function Delete_attachment(Request $request)
    {
        return $this->Student->Delete_attachment($request);

    }

    public function card_stu($id){
        $student = Student::find($id);
        return view('pages.Students.card',compact('student'));
    }

}
