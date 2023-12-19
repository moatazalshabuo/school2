<?php

use App\Models\Section;
use App\Models\Student;
use App\Models\SubjectClass;
use App\Models\SubjectScore;
use App\Models\TecherClass;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class Helper
{
    public static function generateQrCode($id)
    {
        // You can also customize the QR code further
        return QrCode::size(50)
            ->backgroundColor(255, 255, 255)
            ->generate(strval($id));
    }
    public static function studentSubject(Student $student)
    {
        $subject = SubjectClass::where('class_room_id', $student->Classroom_id)->get();
        foreach ($subject as $key => $value) {
            SubjectScore::create([
                'student_id' => $student->id,
                "subject_id" => $value->id,
                "score" => 0,
            ]);
        }
    }
    public static function countStudentInSection(TecherClass $techerClass){
        return count(Student::join('subject_scores','subject_scores.student_id',"=","students.id")
        ->where('subject_scores.subject_id',$techerClass->subject_class_id)->get());
    }
}
