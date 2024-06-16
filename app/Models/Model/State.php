<?php

namespace App\Models\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    use HasFactory; 
    protected $table = 'job_states';
    protected $fillable = ['name', 'name_hindi', 'name_marathi', 'name_punjabi'];
}
