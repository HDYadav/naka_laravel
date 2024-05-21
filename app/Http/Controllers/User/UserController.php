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


    public function restore($id)
    {
        $user = User::withTrashed()->find($id);

        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        $user->restore();

        return response()->json(['message' => 'User restored successfully']);
    }
    

    public function softDelete($id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        $user->delete();

        return response()->json(['message' => 'User soft deleted successfully']);
    }


    
}
