<?php

namespace App\Models\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Experience extends Model
{
    use HasFactory;
    protected $table = 'experiences';

    protected $fillable = ['name', 'designation', 'company', 'startDate', 'endDate', 'name_hindi', 'name_marathi', 'name_punjabi'];
}
