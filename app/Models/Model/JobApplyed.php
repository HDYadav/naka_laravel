<?php

namespace App\Models\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobApplyed extends Model
{
    use HasFactory;

    protected $table = "applyed_job";

    protected $fillable = ['user_id', 'job_id', 'isApplyed', 'application_status'];
}
