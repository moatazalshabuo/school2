<?php

namespace App\Observers;

use App\Models\Fee_invoice;
use App\Models\FeeStudents;

class FeeInvoicesObserver
{
    /**
     * Handle the Fee_invoice "created" event.
     *
     * @param  \App\Models\Fee_invoice  $fee_invoice
     * @return void
     */
    public function created(Fee_invoice $fee_invoice)
    {
        $stu_fee = FeeStudents::where('Fee_id',$fee_invoice->fee_id)->get();
        if(isset($stu_fee[0])){
            $stu_fee[0]->amount -= $fee_invoice->amount;
            $stu_fee[0]->save();
        }
    }

    /**
     * Handle the Fee_invoice "updated" event.
     *
     * @param  \App\Models\Fee_invoice  $fee_invoice
     * @return void
     */
    public function updated(Fee_invoice $fee_invoice)
    {
        $stu_fee = FeeStudents::where('Fee_id',$fee_invoice->fee_id)->get();
        if(isset($stu_fee[0])){
            $stu_fee[0]->amount -= $fee_invoice->amount;
            $stu_fee[0]->save();
        }
    }

    /**
     * Handle the Fee_invoice "deleted" event.
     *
     * @param  \App\Models\Fee_invoice  $fee_invoice
     * @return void
     */
    public function deleted(Fee_invoice $fee_invoice)
    {
        $stu_fee = FeeStudents::where('Fee_id',$fee_invoice->fee_id)->get();
        if(isset($stu_fee[0])){
            $stu_fee[0]->amount += $fee_invoice->amount;
            $stu_fee[0]->save();
        }
    }

    /**
     * Handle the Fee_invoice "restored" event.
     *
     * @param  \App\Models\Fee_invoice  $fee_invoice
     * @return void
     */
    public function restored(Fee_invoice $fee_invoice)
    {
        //
    }

    /**
     * Handle the Fee_invoice "force deleted" event.
     *
     * @param  \App\Models\Fee_invoice  $fee_invoice
     * @return void
     */
    public function forceDeleted(Fee_invoice $fee_invoice)
    {
        //
    }
}
