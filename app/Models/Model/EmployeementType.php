<?php

namespace App\Models\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeementType extends Model
{
    use HasFactory;

    protected $table = 'employeement_types';

    protected $fillable = ['name', 'emptype_hindi', 'emptype_marathi', 'emptype_punjabi'];
}
