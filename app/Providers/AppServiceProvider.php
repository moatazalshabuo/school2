<?php

namespace App\Providers;

use App\Http\Livewire\SubjecScores;
use App\Models\Fee;
use App\Models\Fee_invoice;
use App\Models\Student;
use App\Models\SubjectClass;
use App\Observers\FeeInvoicesObserver;
use App\Observers\FeeObserver;
use App\Observers\StudentsObserver;
use App\Observers\SubjectScoreObserver;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
        Student::observe(StudentsObserver::class);
        Fee::observe(FeeObserver::class);
        Fee_invoice::observe(FeeInvoicesObserver::class);
        // SubjectClass::observe(SubjectScoreObserver::class);
    }
}
