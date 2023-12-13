<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubjectClass extends Model
{
    use HasFactory;
    protected $table = 'subject_class';
    protected $fillable = ['id','main_subject_id','class_room_id','status'];

    public function main_subject()
    {
        return $this->belongsTo(MainSubjects::class,'main_subject_id');
    }
    public function class_room()
    {
        return $this->belongsTo(Classroom::class,'class_room_id');
    }
}
