<?php

namespace App\Models\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AadharCard extends Model
{
    use HasFactory;

    protected $table = "aadhar_cards";

    protected $fillable = ['user_id', 'aadharCardNumber', 'name', 'gender', 'dateOfBirth', 'photo', 'status'];
}
