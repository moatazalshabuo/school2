<?php

namespace App\Observers;

use App\Models\Fee;
use App\Models\FeeStudents;
use App\Models\Student;

class FeeObserver
{
    /**
     * Handle the Fee "created" event.
     *
     * @param  \App\Models\Fee  $fee
     * @return void
     */
    public function created(Fee $fee)
    {
        $Student = Student::where(['Classroom_id' => $fee->Classroom_id, 'status' => 1])->get();
        foreach ($Student as $val) {
            FeeStudents::create([
                'St_id' => $val->id,
                'Fee_id' => $fee->id,
                'amount' => $fee->amount
            ]);
        }
    }

    /**
     * Handle the Fee "updated" event.
     *
     * @param  \App\Models\Fee  $fee
     * @return void
     */
    public function updated(Fee $fee)
    {
        //
        $fee_student = FeeStudents::where('Fee_id', $fee->id)->get();
        foreach ($fee_student as $val) {
            FeeStudents::find($val->id)->update([
                'amount' => $fee->amount
            ]);
        }
    }

    /**
     * Handle the Fee "deleted" event.
     *
     * @param  \App\Models\Fee  $fee
     * @return void
     */
    public function deleted(Fee $fee)
    {
        $fee_student = FeeStudents::where('Fee_id', $fee->id)->get();
        foreach ($fee_student as $val) {
            FeeStudents::find($val->id)->delete();
        }
    }

    /**
     * Handle the Fee "restored" event.
     *
     * @param  \App\Models\Fee  $fee
     * @return void
     */
    public function restored(Fee $fee)
    {
        //
    }

    /**
     * Handle the Fee "force deleted" event.
     *
     * @param  \App\Models\Fee  $fee
     * @return void
     */
    public function forceDeleted(Fee $fee)
    {
        //
    }
}
