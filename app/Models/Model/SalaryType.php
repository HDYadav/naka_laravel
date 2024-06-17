<?php

namespace App\Models\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalaryType extends Model
{
    use HasFactory;
    protected $table = 'salary_types';

    protected $fillable = ['name','name_hindi', 'name_marathi', 'name_punjabi'];
}
