<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProcessingFee extends Model
{
    protected $fillable = ["id", "date", "student_id", "amount",'fee_id', "description", "created_at"];

    public function student()
    {
        return $this->belongsTo('App\Models\Student', 'student_id');
    }
}
