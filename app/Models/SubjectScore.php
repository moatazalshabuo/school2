<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubjectScore extends Model
{
    protected $table = 'subject_scores';
    protected $fillable = ['score'];
    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id');
    }

    public function subject()
    {
        return $this->belongsTo(MainSubjects::class, 'subject_id');
    }
}
