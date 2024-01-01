<?php

namespace App\Observers;

use App\Models\FeeStudents;
use App\Models\ProcessingFee;

class ProcessingFeeObserver
{
    /**
     * Handle the ProcessingFee "created" event.
     *
     * @param  \App\Models\ProcessingFee  $processingFee
     * @return void
     */
    public function created(ProcessingFee $processingFee)
    {
        $stu_fee = FeeStudents::where('Fee_id',$processingFee->fee_id)->get();
        if(isset($stu_fee[0])){
            $stu_fee[0]->amount -= $processingFee->amount;
            $stu_fee[0]->save();
        }
    }

    /**
     * Handle the ProcessingFee "updated" event.
     *
     * @param  \App\Models\ProcessingFee  $processingFee
     * @return void
     */
    public function updated(ProcessingFee $processingFee)
    {
        $stu_fee = FeeStudents::where('Fee_id',$processingFee->fee_id)->get();
        if(isset($stu_fee[0])){
            $stu_fee[0]->amount -= $processingFee->amount;
            $stu_fee[0]->save();
        }
    }

    /**
     * Handle the ProcessingFee "deleted" event.
     *
     * @param  \App\Models\ProcessingFee  $processingFee
     * @return void
     */
    public function deleted(ProcessingFee $processingFee)
    {
        $stu_fee = FeeStudents::where('Fee_id',$processingFee->fee_id)->get();
        if(isset($stu_fee[0])){
            $stu_fee[0]->amount += $processingFee->amount;
            $stu_fee[0]->save();
        }
    }

    /**
     * Handle the ProcessingFee "restored" event.
     *
     * @param  \App\Models\ProcessingFee  $processingFee
     * @return void
     */
    public function restored(ProcessingFee $processingFee)
    {
        //
    }

    /**
     * Handle the ProcessingFee "force deleted" event.
     *
     * @param  \App\Models\ProcessingFee  $processingFee
     * @return void
     */
    public function forceDeleted(ProcessingFee $processingFee)
    {
        //
    }
}
