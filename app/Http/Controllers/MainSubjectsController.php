<?php

namespace App\Http\Controllers;
use App\Models\MainSubjects;
use Dotenv\Exception\ValidationException;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule as ValidationRule;
use Laravel\Ui\Presets\React;

use function PHPUnit\Framework\throwException;

class MainSubjectsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subjects = MainSubjects::all();
        return view('pages.MainSubject.index',compact('subjects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
       
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        try {
            foreach(MainSubjects::all() as $val){
                if($val->name == $request->Name_ar || $val->name == $request->Name_en){
                    if(app()->getLocale() == 'ar'){
                        throw new ValidationException('اسم المادة موجود مسبقا');
                    }else{
                        throw new ValidationException('The name of the material already exists');
                    }  
                }
            }

            $subjects = new MainSubjects();
            $subjects->name = ['en' => $request->Name_en, 'ar' => $request->Name_ar];
            // $subjects->summry = $request->summry;
            $subjects->save();
            toastr()->success(trans('messages.success'));
            
            return redirect()->route('subject.index');
        }
        catch (\Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\MainSubjects  $mainSubjects
     * @return \Illuminate\Http\Response
     */
    public function show(MainSubjects $mainSubjects)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\MainSubjects  $mainSubjects
     * @return \Illuminate\Http\Response
     */
    public function edit(MainSubjects $mainSubjects)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\MainSubjects  $mainSubjects
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MainSubjects $mainSubjects)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MainSubjects  $mainSubjects
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        try {
            MainSubjects::destroy($request->id);
            toastr()->error(trans('messages.Delete'));
            return redirect()->back();
        }

        catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}
