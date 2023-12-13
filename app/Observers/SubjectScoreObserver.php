<?php

namespace App\Observers;

use App\Models\SubjectScore;

class SubjectScoreObserver
{
    /**
     * Handle the SubjectScore "created" event.
     *
     * @param  \App\Models\SubjectScore  $subjectScore
     * @return void
     */
    public function created(SubjectScore $subjectScore)
    {
        //
    }

    /**
     * Handle the SubjectScore "updated" event.
     *
     * @param  \App\Models\SubjectScore  $subjectScore
     * @return void
     */
    public function updated(SubjectScore $subjectScore)
    {
        //
    }

    /**
     * Handle the SubjectScore "deleted" event.
     *
     * @param  \App\Models\SubjectScore  $subjectScore
     * @return void
     */
    public function deleted(SubjectScore $subjectScore)
    {
        //
    }

    /**
     * Handle the SubjectScore "restored" event.
     *
     * @param  \App\Models\SubjectScore  $subjectScore
     * @return void
     */
    public function restored(SubjectScore $subjectScore)
    {
        //
    }

    /**
     * Handle the SubjectScore "force deleted" event.
     *
     * @param  \App\Models\SubjectScore  $subjectScore
     * @return void
     */
    public function forceDeleted(SubjectScore $subjectScore)
    {
        //
    }
}
