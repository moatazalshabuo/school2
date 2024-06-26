<?php

use App\Http\Controllers\Students\StudentController;
use App\Http\Controllers\StudentSectionsController;
use Illuminate\Support\Facades\Route;
use MacsiDigital\Zoom\Role;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use App\Http\Controllers\SubjectScoreController;
use App\Http\Controllers\TeacherClassController;
// use SimpleSoftwareIO\QrCode\Facades\QrCode;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Auth::routes();

Route::get('/', 'HomeController@index')->name('selection');

Route::group(['namespace' => 'Auth'], function () {

    Route::get('/login/{type}', 'LoginController@loginForm')->middleware('guest')->name('login.show');
    Route::post('/login', 'LoginController@login')->name('login');
    Route::get('/logout/{type}', 'LoginController@logout')->name('logout');
});
//==============================Translate all pages============================

Route::group([
    'prefix' => LaravelLocalization::setLocale(),
    'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath', 'auth']
], function () {

    //==============================dashboard============================

    Route::get('/dashboard', 'HomeController@dashboard')->name('dashboard');

    //==============================dashboard============================

    Route::group(['namespace' => 'Grades'], function () {
        Route::resource('Grades', 'GradeController');
    });

    //==============================Classrooms============================

    Route::group(['namespace' => 'Classrooms'], function () {
        Route::resource('Classrooms', 'ClassroomController');
        Route::post('delete_all', 'ClassroomController@delete_all')->name('delete_all');
        Route::post('Filter_Classes', 'ClassroomController@Filter_Classes')->name('Filter_Classes');
        Route::get('/Classrooms/{Classroom}/edit', 'ClassroomController@edit')->name('Classrooms.edit');

    });

    //==============================Sections============================

    Route::group(['namespace' => 'Sections'], function () {
        Route::resource('Sections', 'SectionController');
        Route::get('/classes/{id}', 'SectionController@getclasses');
    });

    //==============================parents============================

    Route::view('add_parent', 'livewire.show_Form')->name('add_parent');

    //==============================Teachers============================

    Route::group(['namespace' => 'Teachers'], function () {
        Route::resource('Teachers', 'TeacherController');
    });

    //==============================Students============================

    Route::group(['namespace' => 'Students'], function () {
        Route::resource('Students', 'StudentController');
        Route::resource('online_classes', 'OnlineClasseController');
        Route::get('indirect_admin', 'OnlineClasseController@indirectCreate')->name('indirect.create.admin');
        Route::post('indirect_admin', 'OnlineClasseController@storeIndirect')->name('indirect.store.admin');
        Route::resource('Graduated', 'GraduatedController');
        Route::resource('Promotion', 'PromotionController');
        Route::resource('Fees_Invoices', 'FeesInvoicesController');
        Route::resource('Fees', 'FeesController');
        Route::resource('receipt_students', 'ReceiptStudentsController');
        Route::resource('ProcessingFee', 'ProcessingFeeController');
        Route::resource('Payment_students', 'PaymentController');
        Route::resource('Attendance', 'AttendanceController');
        Route::get('download_file/{filename}', 'LibraryController@downloadAttachment')->name('downloadAttachment');
        Route::resource('library', 'LibraryController');
        Route::post('Upload_attachment', 'StudentController@Upload_attachment')->name('Upload_attachment');
        Route::get('Download_attachment/{studentsname}/{filename}', 'StudentController@Download_attachment')->name('Download_attachment');
        Route::post('Delete_attachment', 'StudentController@Delete_attachment')->name('Delete_attachment');
        Route::get('card-st/{id}',[StudentController::class,'card_stu'])->name('card.st');
    });

    //==============================subjects============================

    Route::group(['namespace' => 'Subjects'], function () {
        Route::resource('subjects', 'SubjectController');
    });

    // =================================================================

    Route::resource('subject', 'MainSubjectsController');

    //==============================Quizzes============================

    Route::group(['namespace' => 'Quizzes'], function () {
        Route::resource('Quizzes', 'QuizzController');
    });

    //==============================questions============================

    Route::group(['namespace' => 'questions'], function () {
        Route::resource('questions', 'QuestionController');
    });

    //==============================Setting============================

    Route::resource('settings', 'SettingController');

    //==============================acadmicYaers============================

    Route::group(['namespace' => 'academic_year'], function () {
        Route::resource('academic_year', 'academic_yearController');
    });


    //==========================================================================
    Route::controller(TeacherClassController::class)->group(function () {
        Route::get('teacher-subject', 'index')->name('teacher_class.index');
        Route::get('teacher-class/create', 'create')->name('teacher_class.create');
        Route::post('teacher-class/store', 'store')->name('teacher_class.store');
        Route::get('teacher-class/{subjectClassId}/show', 'showGrades')->name('teacher_class.show');
        // Route::get('teacher-class/{subjectClassId}/show'), [YourController::class, 'showTeacherClass'])->name('teacher_class.show');


        // Route::controller(SubjectScoreController::class)->group(function (){
        //     Route::get('/subject-scores/create')->name('subject-scores.create')
        // });
        // Route::get('/subject-scores/create', [SubjectScoreController::class, 'create']);
        // Route::post('/subject-scores', [SubjectScoreController::class, 'store']);
        Route::resource('subject-scores', 'SubjectScoreController');

        // Route::post('/subject-get', [SubjectScoreController::class, 'getSubjectsByClassroom']);
        Route::get('/get-subjects-by-classroom/{classroomId}', [SubjectScoreController::class, 'getSubjectsByClassroom'])->name('subjects.by.classroom');
        Route::get('/subject-scores/get-students', [SubjectScoreController::class, 'getStudents']);


        Route::get('teacher-detile/{id}', 'teacher_courses')->name('teacher_courses');
    });

   Route::controller(StudentSectionsController::class)->group(function(){
    Route::get('sec-stu','index')->name('section.student.index');
   });
});
// Route::get("test", function () {
//     return  view('pages.Students.card');
// });