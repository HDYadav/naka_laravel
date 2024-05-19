<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FavorateJob extends Model
{
    use HasFactory;

    protected $table = "favorate_job";
    public $timestamps = false;

    protected $fillable = [
        'job_id',
        'user_id',
        'isFavourite'
    ];

}
