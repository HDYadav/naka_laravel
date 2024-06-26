<?php

namespace App\Models\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    use HasFactory;

    protected $fillable = [
        'id', // Add this line to allow mass assignment of the id field
        'title',
        'jobPosiiton',
        'workPlace',
        'country',
        'state',
        'city',
        'company',
        'education',
        'employeementType',
        'skills',
        'totalVacancy',
        'deadline',
        'minSalary',
        'maxSalary',
        'salaryType',
        'experience',
        'promote',
        'description',
        'isFavourite',
        'created_by'
    ];
    
}
