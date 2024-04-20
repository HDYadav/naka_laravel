<?php

namespace App\Models\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyList extends Model
{
    use HasFactory;

    protected $table = 'company_lists';

    protected $fillable = ['name'];
}
