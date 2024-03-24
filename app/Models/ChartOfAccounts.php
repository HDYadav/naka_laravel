<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class ChartOfAccounts extends Model
{
    use HasFactory;

    public $timestamps = true; 

    protected $fillable = [   
        'name',        
        'parent_id',
        'identification_no', 
        'account_currency',
        'customer_id',
        'industry_id',
        'descriptions',
        'created_by',
        'updated_by',
    ];

}
