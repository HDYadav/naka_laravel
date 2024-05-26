<?php

namespace App\Models\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExperianceDetails extends Model
{
    use HasFactory;

    protected $fillable = ['user_id','designation', 'company', 'startDate', 'endDate', 'currentlyWorking'];

}
