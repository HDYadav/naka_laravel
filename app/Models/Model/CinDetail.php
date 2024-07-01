<?php

namespace App\Models\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CinDetail extends Model
{

  
    use HasFactory;

    protected $table = "cin_details";

    protected $fillable = ['user_id', 'cinNumber', 'companyName', 'companyCategory', 'classOfCompany', 'registeredAddress', 'registrationNumber', 'dateOfIncorporation'];
}
