<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudentGrade extends Model
{
    protected $fillable = [
        'student_id',
        'subject_class_id',
        'academic_year_id',
        'teacher_id',
        'grade',
        'created_by',
    ];

    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id');
    }

    public function subjectClass()
    {
        return $this->belongsTo(SubjectClass::class, 'subject_class_id');
    }

    public function academicYear()
    {
        return $this->belongsTo(academic_year::class, 'academic_year_id');
    }

    public function teacher()
    {
        return $this->belongsTo(Teacher::class, 'teacher_id');
    }
}
