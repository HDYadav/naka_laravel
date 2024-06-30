<?php

namespace App\Models\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GstDetail extends Model
{
    use HasFactory;

    protected $table = "gst_details";

    protected $fillable = ['user_id', 'gstNumber', 'name', 'registerDate', 'status'];

}
