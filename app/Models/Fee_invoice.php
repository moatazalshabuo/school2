<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Fee_invoice extends Model
{
    protected $fillable = ['id', 'invoice_date', 'student_id', 'Grade_id', 'Classroom_id', 'fee_id', 'amount', 'description', 'created_at', 'updated_at'];

    public function grade()
    {
        return $this->belongsTo('App\Models\Grade', 'Grade_id');
    }


    public function classroom()
    {
        return $this->belongsTo('App\Models\Classroom', 'Classroom_id');
    }


    // public function section()
    // {
    //     return $this->belongsTo('App\Models\Section', 'section_id');
    // }

    public function student()
    {
        return $this->belongsTo('App\Models\Student', 'student_id');
    }

    public function fees()
    {
        return $this->belongsTo('App\Models\Fee', 'fee_id');
    }
}
