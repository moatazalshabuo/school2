<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class academic_year extends Model
{

    use HasTranslations;
    public $translatable = ['academic_year'];

    protected $fillable=['start_date','end_date','status'];
    protected $table = 'academic_years';
    public $timestamps = true;


}