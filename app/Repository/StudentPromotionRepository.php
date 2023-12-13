<?php


namespace App\Repository;


use App\Models\Grade;
use App\Models\promotion;
use App\Models\Student;
use App\Models\academic_year;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class StudentPromotionRepository implements StudentPromotionRepositoryInterface
{

    public function index()
    {
        $Grades = Grade::all();
        $academic_years = academic_year::all();
        return view('pages.Students.promotion.index',compact('Grades','academic_years'));
    }

    public function create()
    {
        $promotions = promotion::all();
        $academic_years = academic_year::all();
        return view('pages.Students.promotion.management',compact('promotions', 'academic_years'));
    }

    public function store($request)
    {
        DB::beginTransaction();
    
        try {
            // Retrieve successful and unsuccessful students
            $students = DB::table('students as s')
                ->select('s.*')
                ->join('classrooms as c', 'c.id', '=', 's.classroom_id')
                ->join('sections as sec', 'sec.id', '=', 's.section_id')
                ->join('grades as g', 'g.id', '=', 's.grade_id')
                ->join('academic_years as ay', 'ay.id', '=', 's.academic_year_id')
                ->join('subject_scores as ss', 'ss.student_id', '=', 's.id')
                ->where('ss.score', '>', 50)
                ->where('g.id', $request->Grade_id)
                ->where('c.id', $request->Classroom_id)
                ->where('sec.id', $request->section_id)
                ->where('ay.id', $request->academic_year_id)
                ->groupBy('s.id')
                ->havingRaw('COUNT(*) = (SELECT COUNT(*) FROM subject_scores WHERE subject_scores.student_id = s.id)')
                ->get();
                foreach ($students as $student) {
                    $ids = explode(',', $student->id);
                
                    // Check if the destination class is different from the source class
                    $sourceClass = student::find($ids[0])->Classroom_id;
                    if ($request->Classroom_id_new == $sourceClass) {
                        // Display an error message and handle accordingly
                        return redirect()->back()->withErrors(['error' => __('لا يمكن ترقية الطالب الى نفس الصف الدراسي')]);
                    }
                    if ($request->Classroom_id_new < $sourceClass) {
                        // Display an error message and handle accordingly
                        return redirect()->back()->withErrors(['error' => __('لا يمكن ترقية الطالب إلى صف أقل من الصف الحالي')]);
                    }
            foreach ($students as $student) {
                $ids = explode(',', $student->id);
                student::whereIn('id', $ids)
                    ->update([
                        'Grade_id' => $request->Grade_id_new,
                        'Classroom_id' => $request->Classroom_id_new,
                        'section_id' => $request->section_id_new,
                        'academic_year' => $request->academic_year_new,
                    ]);
    
                Promotion::updateOrCreate([
                    'student_id' => $student->id,
                    'from_grade' => $request->Grade_id,
                    'from_Classroom' => $request->Classroom_id,
                    'from_section' => $request->section_id,
                    'to_grade' => $request->Grade_id_new,
                    'to_Classroom' => $request->Classroom_id_new,
                    'to_section' => $request->section_id_new,
                    'academic_year' => $request->academic_year_id,
                    'academic_year_new' => $request->academic_year_new,
                ]);
            }
        }
            DB::commit();
            $successfulCount = $students->count();
            $unsuccessfulCount = DB::table('students as s')
                ->select('s.*')
                ->join('subject_scores as ss', 'ss.student_id', '=', 's.id')
                ->where('ss.score', '<=', 50)
                ->whereIn('s.id', $students->pluck('id'))
                ->count();
    
            if ($successfulCount < 1) {
                return redirect()->back()->with('error_promotions', __('  لاتوجد بيانات في جدول الطلاب او الجميع راسبين'));
            }
            // if ($unsuccessfulCount > 0) {
            //     toastr()->warning(__('لديك طلاب راسبين، يرجى مراجعة النتائج.'));
            // }
            toastr()->success(trans('messages.success') . " - عدد الطلاب الناجحين: $successfulCount - عدد الطلاب الراسبين: $unsuccessfulCount");
            return redirect()->back();
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
    

    public function destroy($request)
    {
        DB::beginTransaction();

        try {

            // التراجع عن الكل
            if($request->page_id ==1){

             $Promotions = Promotion::all();
             foreach ($Promotions as $Promotion){

                 //التحديث في جدول الطلاب
                 $ids = explode(',',$Promotion->student_id);
                 student::whereIn('id', $ids)
                 ->update([
                 'Grade_id'=>$Promotion->from_grade,
                 'Classroom_id'=>$Promotion->from_Classroom,
                 'section_id'=> $Promotion->from_section,
                 'academic_year'=>$Promotion->academic_year,
               ]);

                 //حذف جدول الترقيات
                 Promotion::truncate();

             }
                DB::commit();
                toastr()->error(trans('messages.Delete'));
                return redirect()->back();

            }

            else{

                $Promotion = Promotion::findorfail($request->id);
                student::where('id', $Promotion->student_id)
                    ->update([
                        'Grade_id'=>$Promotion->from_grade,
                        'Classroom_id'=>$Promotion->from_Classroom,
                        'section_id'=> $Promotion->from_section,
                        'academic_year'=>$Promotion->academic_year,
                    ]);


                Promotion::destroy($request->id);
                DB::commit();
                toastr()->error(trans('messages.Delete'));
                return redirect()->back();

            }

        }

        catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }


}
