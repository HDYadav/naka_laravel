<?php

namespace App\Models\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EducationDetails extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'collageName', 'courseName', 'startDate', 'endDate', 'currentlyPursuing'];
}
