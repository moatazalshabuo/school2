<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FeeStudents extends Model
{
    use HasFactory;
    protected $fillable = ['St_id',"Fee_id",'amount'];

    public function student(){
        return $this->belongsTo(Student::class,"St_id");
    }

    public function Fee(){
        return $this->belongsTo(Fee::class,'Fee_id');
    }

}
