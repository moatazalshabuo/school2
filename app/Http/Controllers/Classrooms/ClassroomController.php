<?php


namespace App\Http\Controllers\Classrooms;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreClassroom;
use App\Http\Requests\UpdateClassroom;
use App\Models\Classroom;
use App\Models\Grade;
use App\Models\MainSubjects;
use App\Models\SubjectClass;
use Dotenv\Exception\ValidationException;
use Illuminate\Http\Request;

class ClassroomController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {

        $My_Classes = Classroom::all();
        $Grades = Grade::all();
        return view('pages.My_Classes.My_Classes', compact('My_Classes', 'Grades'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $Grades = Grade::all();
        $subjects = MainSubjects::all();
        return view('pages.My_Classes.create', compact('Grades', 'subjects'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(StoreClassroom $request)
    {
        try {

            foreach (Classroom::all() as $val) {
                if ($val->Name_Class == $request->Name || $val->Name_Class == $request->Name_class_en) {
                    if (app()->getLocale() == 'ar') {
                        throw new ValidationException('اسم الصف موجود مسبقا');
                    } else {
                        throw new ValidationException('The name of the class already exists');
                    }
                }
            }
            $validated = $request->validated();
            $My_Classes = new Classroom();

            $My_Classes->Name_Class = ['en' => $request->Name_class_en, 'ar' => $request->Name];
            $My_Classes->Periods = $request->Periods;
            $My_Classes->Grade_id = $request->Grade_id;
            $My_Classes->save();

            foreach ($request->subject_id as $val) {
                SubjectClass::create([
                    'main_subject_id' => $val,
                    'class_room_id' => $My_Classes->id
                ]);
            }



            toastr()->success(trans('messages.success'));
            return redirect()->route('Classrooms.index');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }


    /*


    */


    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function edit($id)
{
    $classroom = Classroom::findOrFail($id);
    $Grades = Grade::all();
    $subjects = MainSubjects::all();
    return view('pages.My_Classes.edit', compact('classroom', 'Grades', 'subjects'));
}


    /**
     * Update the specified resource in storage.
     *
     * @param int $id
     * @return Response
     */
   
    

    public function update(StoreClassroom $request, $id)
{
    try {
        $classroom = Classroom::findOrFail($id);

        // Check if the name is already taken by another classroom
        foreach (Classroom::where('id', '!=', $id)->get() as $val) {
            if ($val->Name_Class == $request->Name || $val->Name_Class == $request->Name_class_en) {
                if (app()->getLocale() == 'ar') {
                    throw new ValidationException('اسم الصف موجود مسبقا');
                } else {
                    throw new ValidationException('The name of the class already exists');
                }
            }
        }

        $validated = $request->validated();
        $classroom->Name_Class = ['en' => $request->Name_class_en, 'ar' => $request->Name];
        $classroom->Periods = $request->Periods;
        $classroom->Grade_id = $request->Grade_id;
        $classroom->save();

        // Update the associated subjects
        $existingSubjectIds = $classroom->subject()->pluck('main_subject_id')->toArray();
        $newSubjectIds = $request->subject_id;

        // Detach removed subjects
        $removedSubjectIds = array_diff($existingSubjectIds, $newSubjectIds);
        foreach ($removedSubjectIds as $subjectId) {
            SubjectClass::where('main_subject_id', $subjectId)
                ->where('class_room_id', $classroom->id)
                ->delete();
        }

        // Attach new subjects
        $addedSubjectIds = array_diff($newSubjectIds, $existingSubjectIds);
        foreach ($addedSubjectIds as $subjectId) {
            SubjectClass::create([
                'main_subject_id' => $subjectId,
                'class_room_id' => $classroom->id
            ]);
        }

        toastr()->success(trans('messages.success'));
        return redirect()->route('Classrooms.index');
    } catch (\Exception $e) {
        return redirect()->back()->withErrors(['error' => $e->getMessage()]);
    }
}
    
    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return Response
     */
    public function destroy(Request $request)
    {
        $Classrooms = Classroom::findOrFail($request->id)->delete();
        toastr()->error(trans('messages.Delete'));
        return redirect()->route('Classrooms.index');
    }


    public function delete_all(Request $request)
    {
        $delete_all_id = explode(",", $request->delete_all_id);

        Classroom::whereIn('id', $delete_all_id)->Delete();
        toastr()->error(trans('messages.Delete'));
        return redirect()->route('Classrooms.index');
    }


    public function Filter_Classes(Request $request)
    {
        $Grades = Grade::all();
        $Search = Classroom::select('*')->where('Grade_id', '=', $request->Grade_id)->get();
        return view('pages.My_Classes.My_Classes', compact('Grades'))->withDetails($Search);
    }
}
