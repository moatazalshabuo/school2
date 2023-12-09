<?php

namespace App\Http\Controllers;

use App\Models\Classroom;
use App\Models\Section;
use App\Models\SubjectClass;
use Illuminate\Http\Request;

class AjaxController extends Controller
{
    // Get Classrooms
    public function getClassrooms($id)
    {
        return Classroom::where("Grade_id", $id)->pluck("Name_Class", "id");

    }

    //Get Sections
    public function Get_Sections($id){

        return Section::where("Class_id", $id)->pluck("Name_Section", "id");

    }
    public function Get_Sections_cl($id){
        $class_id = SubjectClass::find($id)->class_room_id;
        return Section::where("Class_id", $class_id)->pluck("Name_Section", "id");

    }
}
