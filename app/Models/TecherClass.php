<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class TecherClass extends Model
{
    use HasFactory;

    protected $table = 'techer_classes';
    protected $fillable = ['subject_class_id','academic_year_id','tech_id', 'section_id', 'id', 'created_at'];

    public function Teacher()
    {
        return $this->belongsTo(Teacher::class, 'tech_id');
    }
    public function Section()
    {
        return $this->belongsTo(Section::class, "section_id");
    }
    public function year()
    {
        return $this->belongsTo(academic_year::class, 'academic_year_id');
    }
    public function subject()
    {
        return $this->belongsTo(SubjectClass::class, "subject_class_id");
    }
}

