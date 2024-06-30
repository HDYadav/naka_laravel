<?php

namespace App\Models\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PanCard extends Model
{
    use HasFactory;
    protected $table = "pan_cards";

    protected $fillable = ['user_id', 'panCardNumber', 'name', 'gender', 'dateOfBirth', 'photo', 'status', 'category'];

}
