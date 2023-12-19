<?php

namespace App\Observers;

use App\Models\Fee;
use App\Models\FeeStudents;
use App\Models\Student;
use App\Models\SubjectClass;
use App\Models\SubjectScore;
use Helper;

class StudentsObserver
{
    /**
     * Handle the Student "created" event.
     *
     * @param  \App\Models\Student  $student
     * @return void
     */
    public function created(Student $student)
    {
        Helper::studentSubject($student);
        if ($student->academicYear->status == 1) {
            $fee = Fee::where(['year_id' => $student->academicYear->id])->get()->first();
            if ($fee)
                FeeStudents::create([
                    'St_id' => $student->id,
                    'Fee_id' => $fee->id,
                    'amount' => $fee->amount
                ]);
        }
    }

    /**
     * Handle the Student "updated" event.
     *
     * @param  \App\Models\Student  $student
     * @return void
     */
    public function updated(Student $student)
    {
        //
    }

    /**
     * Handle the Student "deleted" event.
     *
     * @param  \App\Models\Student  $student
     * @return void
     */
    public function deleted(Student $student)
    {
        //
    }

    /**
     * Handle the Student "restored" event.
     *
     * @param  \App\Models\Student  $student
     * @return void
     */
    public function restored(Student $student)
    {
        //
    }

    /**
     * Handle the Student "force deleted" event.
     *
     * @param  \App\Models\Student  $student
     * @return void
     */
    public function forceDeleted(Student $student)
    {
        //
    }
}
