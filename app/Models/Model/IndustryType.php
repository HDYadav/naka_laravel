<?php

namespace App\Models\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IndustryType extends Model
{
    use HasFactory;

   // protected $table = "industries";

    protected $fillable = ['name', 'ind_type_hindi', 'ind_type_marathi', 'ind_type_punjabi'];
}
