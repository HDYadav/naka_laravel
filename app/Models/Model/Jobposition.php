<?php

namespace App\Models\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jobposition extends Model
{
    use HasFactory;
    
    protected $table = 'job_positions';

    protected $fillable = ['name'];
}
