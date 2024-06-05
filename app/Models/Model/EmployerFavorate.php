<?php

namespace App\Models\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployerFavorate extends Model
{
    use HasFactory;

    protected $table = "employer_favorates";

    protected $fillable = ['job_id', 'user_id', 'employer_id', 'isFavourite'];
}
