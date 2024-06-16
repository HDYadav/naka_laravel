<?php

namespace App\Models\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Education extends Model
{
    use HasFactory;
    protected $table = 'educations';

    protected $fillable = ['name', 'collageName', 'courseName', 'startDate','endDate', 'name_hindi', 'name_marathi', 'name_punjabi'];
}
