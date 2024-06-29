<?php

namespace App\Models\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StaticPage extends Model
{
    use HasFactory;

    protected $table = "static_pages";

    protected $fillable = ['page_name', 'heading', 'descriptions'];

}
