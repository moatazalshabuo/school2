<?php

namespace App\Http\Livewire;


use App\Models\Student;
use App\Models\Classroom;
use App\Models\Section;
use App\Models\Grade;
use App\Models\SubjectScore as SubScore;

use Livewire\Component;

class SubjecScores extends Component
{
    public $successMessage;
    public $grades, $stages = [], $sections = [], $students = [];
    public $error = [], $check_score = [];
    public $select_grades, $select_stage, $select_section;



    protected $rules = [
        'students.*.subject_score.*.score' => 'required|numeric',
        'check_score.*' => 'required|bool',
    ];
    public function change_grades()
    {
        if (!empty($this->select_grades)) {
            $this->stages = Classroom::where("Grade_id", $this->select_grades)->get();
        }
    }

    public function change_stage()
    {
        if (!empty($this->select_stage)) {
            $this->sections = Section::where("Class_id", $this->select_stage)->get();
        } else {
        }
    }

    public function submitFirst()
    {

        if (!empty($this->select_section)) {
            $this->successMessage = null;
            $this->check_score=[];
            $this->students = Student::where('section_id', $this->select_section)->get();
            foreach($this->students as $k => $v){
                $this->check_score[$k]= false;
            }
        } else {
            array_push($this->error, 'يجب اختيار كل الحقول');
        }
    }

    public function saveScore($id)
    {

        foreach ($this->students[$id]->subject_score as $val) {
            $subjec_score = SubScore::find($val->id);
            $subjec_score->score = $val->score;
            $subjec_score->save();
            $this->check_score[$id]= true;
        }
        // $this->successMessage = trans('messages.success');
        // $this->dispatchBrowserEvent('showToast', ['message' => 'This is a toast message', 'type' => 'success']);
    }
    public function saveall()
    {
        foreach ($this->students as $item)
            foreach ($item->subject_score as $val) {
                $subjec_score = SubScore::find($val->id);
                $subjec_score->score = $val->score;
                $subjec_score->save();
            }
            $this->successMessage = trans('messages.success');
    }
    public function render()
    {
        $this->grades = Grade::all();
        return view('livewire.subjec-scores');
    }
}
