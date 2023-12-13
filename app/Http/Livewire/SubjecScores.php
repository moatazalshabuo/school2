<?php

namespace App\Http\Livewire;

use App\Models\SubjectScore;
use App\Models\Student;
use App\Models\Classroom;
use App\Models\Section;
use App\Models\Grade;
use App\Models\SubjectClass;
use App\Models\MainSubjects;
use Livewire\Component;

class SubjecScores extends Component
{
    public $grades ,$stages,$sections;


    public function render()
    {
        // $students = Student::all();
        $this->stages = Classroom::all();
        $sections = Section::all();
        $subjects = MainSubjects::all();
        $displayedScores = SubjectScore::with(['student', 'subject'])->get();
        $this->grades = Grade::all();
        return view('livewire.subjec-scores', ['students'=>[],'stages'=>[],

        'sections'=>$sections,
        'subjects'=>$subjects,
        'displayedScores'=>$displayedScores]);
    
    }
    public function change_grades($id){

    }
}
