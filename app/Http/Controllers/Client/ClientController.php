<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;
use App\Models\Timesheet\Client;

class ClientController extends ApiController
{
    
    public function index(){
        
       return Client::all();

    }
}
