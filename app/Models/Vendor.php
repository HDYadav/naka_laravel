<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vendor extends Model
{
    use HasFactory;
    protected $fillable = [   
        'name',        
        'type',
        'currency_id', 
        'country_id',
        'province_state',
        'created_by'
    ];
}
