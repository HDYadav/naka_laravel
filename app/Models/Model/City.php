<?php

namespace App\Models\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;
    protected $table = 'job_cities';

    protected $fillable = ['name', 'name_hindi', 'name_marathi', 'name_punjabi'];
}
