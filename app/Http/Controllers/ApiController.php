<?php

namespace App\Http\Controllers;
use App\Traits\ApiResponser;
use Illuminate\Http\Request; 

class ApiController extends Controller
{
    use ApiResponser; 

    public function tokenHeader($accessToken){

      return  $headers = [
            'Content-Type' => 'application/json',
            'Authorization' => $accessToken
            //'Authorization' => 'Bearer ' . $accessToken
        ];
    }

    

}
