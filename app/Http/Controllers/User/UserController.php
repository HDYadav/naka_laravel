<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\ApiController;
use App\Helpers\UserData; 
use Symfony\Component\HttpFoundation\Request;
use App\Models\User;

class UserController extends ApiController
{

    public function getUserData(Request $request){
        $user = UserData::getUserFrToken($request);  
        return $user ;
    }


    public function getAllUsers(Request $request)
    {
        $users = User::select('id', 'name', 'email','mobile')->get();
        return response()->json($users);
    }

    
}
