<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\ApiController;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helpers\UserData;


class ProfileController extends ApiController
{
    
    public function index(Request $request){  
        
        $userdata = UserData::getUserFrToken($request);
       // dd($userdata);
        return $this->sucessResponse('Records sucessfully fetch', $userdata, true, 201);
    }
}
