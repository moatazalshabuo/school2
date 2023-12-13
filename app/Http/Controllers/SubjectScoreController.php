<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SubjectScore;
use App\Models\Student;
use App\Models\Classroom;
use App\Models\Section;
use App\Models\Grade;
use App\Models\SubjectClass;
use App\Models\MainSubjects;

class SubjectScoreController extends Controller
{
   
public function index()
{
   
    
    return view('pages.subject_scores.create');
}


    public function store(Request $request)
{
    // تحقق من صحة البيانات المدخلة
    $validatedData = $request->validate([
        'student_id' => 'required|exists:students,id',
        'subject_id' => 'required|exists:main_subjects,id',
        'score' => 'required|numeric|min:0|max:100',
    ]);

    // التحقق مما إذا كان هناك درجة موجودة بالفعل لنفس الطالب ونفس المادة
    $existingScore = SubjectScore::where('student_id', $validatedData['student_id'])
        ->where('subject_id', $validatedData['subject_id'])
        ->first();

    if ($existingScore) {
        return redirect()->back()->withErrors(['error' => 'يوجد بالفعل درجة مسجلة لنفس الطالب في هذه المادة.']);
    }

    // إنشاء سجل درجة جديد
    $subjectScore = new SubjectScore();
    $subjectScore->student_id = $validatedData['student_id'];
    $subjectScore->subject_id = $validatedData['subject_id'];
    $subjectScore->score = $validatedData['score'];
    $subjectScore->save();

    return redirect('/subject_scores/create')->with('success', 'تمت إضافة الدرجة بنجاح.');
}
public function edit($id)
{
    $displayedScore = SubjectScore::find($id);
    return view('pages.subject_scores.edit', compact('displayedScore'));
}

public function update(Request $request, $id)
{
    $this->validate($request, [
        'score' => 'required|numeric|min:0|max:100', // Add validation rules as needed
        // Add other validation rules
    ]);

    $subjectScore = SubjectScore::find($id);
    $subjectScore->update([
        'score' => $request->input('score'),
        // Update other fields as needed
    ]);

    return redirect('/subject-scores')->with('success', 'Subject score updated successfully.');
}
public function destroy($id)
{
    $score = SubjectScore::findOrFail($id);
    // Delete the score
    $score->delete();
    // Redirect back with a success message
    return redirect()->back()->with('success', 'Score deleted successfully');
}
}

