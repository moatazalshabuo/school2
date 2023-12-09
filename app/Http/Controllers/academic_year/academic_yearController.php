<?php

namespace App\Http\Controllers\academic_year;

use App\Http\Controllers\Controller;
use App\Http\Requests\Storeacademic_year;
use App\Models\academic_year;
use Illuminate\Http\Request;

class academic_yearController extends Controller
{
    public function index()
    {
        $academicYears = academic_year::all();
        return view('pages.academic_year.academic_year', compact('academicYears'));
    }



  /**
   * Store a newly created resource in storage.
   *
   * @return Response
   */
  public function store(Storeacademic_year $request)
  {
    try {
        $validated = $request->validated();
        $academicYear = new academic_year();
        $academicYear->academic_year = ['en' => $request->Name_en, 'ar' => $request->Name_ar];
        $academicYear->start_date = $request->start_date;
        $academicYear->end_date = $request->end_date;
        $academicYear->status = $request->status;
        $academicYear->save();
        toastr()->success(trans('messages.success'));
        return redirect()->route('academic_year.index');
    } catch (\Exception $e) {
        return redirect()->back()->withErrors(['error' => $e->getMessage()]);
    }
}

  /**
   * Update the specified resource in storage.
   *
   * @param  int  $id
   * @return Response
   */
 
 public function update(Request $request, $id)
 {
     try {
         $validated = $request->validate([
             'start_date' => 'required|date',
             'end_date' => 'required|date|after:start_date',
             'status' => 'required|in:0,1',
         ]);
 
         $academicYear = academic_year::findOrFail($id);
         $academicYear->update([
             'start_date' => $request->start_date,
             'end_date' => $request->end_date,
             'status' => $request->status,
         ]);
 
         toastr()->success(trans('messages.Update'));
         return redirect()->route('academic_year.index');
     } catch (\Exception $e) {
         return redirect()->back()->withErrors(['error' => $e->getMessage()]);
     }
 }
 
  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return Response
   */
 
  public function destroy(Request $request)
  {
          $academicYear = academic_year::findOrFail($request->id)->delete();
          toastr()->error(trans('messages.Delete'));
          return redirect()->route('academic_year.index');
      
  }
  
}
